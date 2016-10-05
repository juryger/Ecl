<?php

require_once('../app/exceptions/MySqlException.php');

/**
 * Main class for handling DB requests.
 * based on http://www.informit.com/store/advanced-php-programming-9780672325618 (Chapter 12 & book sources)
 */

/**
 * Interface for processing SQL statement.
 */
interface DB_Statement {
    /**
     * Execute SQL statement with applying parameters of query.
     * @return mixed DB_Statement
     */
    public function execute();

    /**
     * Perform parameters binding for query.
     * @param string $key <p>parameter name</p>
     * @param mixed $value <p>parameter value</p>
     * @return mixed
     */
    public function bind_param($key, $value);

    /**
     * Return one row after executing statement.
     * @return mixed
     */
    public function fetch_row();

    /**
     * Return one row as associated arrays after executing query.
     * @return mixed
     */
    public function fetch_assoc();

    /**
     * Return associated arrays of all rows after executing query.
     * @return mixed
     */
    public function fetchall_assoc();
}

/**
 * Interface for connection to Database
 */
interface DB_Connection {
    /**
     * Perform connection to database.
     * @return mixed
     */
    public function connect();

    /**
     * Close connection to database.
     * @return mixed
     */
    public function close();

    /**
     * Create DB_MysqlStatement for executing SQL statement.
     * @param string $query <p>text of SQL statement</p>
     * @return DB_MysqlStatement SQL statement without execution
     */
    public function prepare($query);

    /**
     * Execute SQL statement and return result.
     * @param $query text of SQL statement
     * @return DB_MysqlStatement SQL statement with result of execution
     */
    public function execute($query);

    /**
     * Free database handler.
     * @return mixed
     */
    public function free();
}

/**
 * Class DB_MysqlStatement for processing SQL-statement in context of MySql RDBMS.
 */
class DB_MysqlStatement implements DB_Statement
{
    public $result;
    public $binds;
    public $query;
    public $dbh;

    /**
     * Constructor.
     * @param resource $dbh <p>
     * Database handler
     * </p>
     * @param string $query <p>
     * Sql statement to execute
     * </p>
     * @return mixed instance of class
     * @throws MysqlException if $dbh is not a resource
     */
    public function DB_MysqlStatement($dbh, $query)
    {
        $this->dbh = $dbh;
        $this->query = $query;

        if (!is_resource($dbh)) {
            throw new MysqlException("Not a valid database connection");
        }
    }

    public function bind_param($ph, $pv)
    {
        $this->binds[$ph] = $pv;
        return $this;
    }

    public function execute()
    {
        $binds = func_get_args();
        foreach ($binds as $index => $name) {
            $this->binds[$index + 1] = $name;
        }

        $cnt = count($binds);
        $query = $this->query;
        foreach ($this->binds as $ph => $pv) {
            $query = str_replace(":$ph", "'" . mysqli_escape_string($pv) . "'", $query);
        }

        $this->result = mysqli_query($this->dbh, $query);
        if (!$this->result) {
            throw new MysqlException;
        }

        return $this;
    }

    public function fetch_row()
    {
        if (!$this->result) {
            throw new MysqlException("Query not executed");
        }

        return mysqli_fetch_row($this->result);
    }

    public function fetch_assoc()
    {
        return mysqli_fetch_assoc($this->result);
    }

    public function fetchall_assoc()
    {
        $retval = array();

        while ($row = $this->fetch_assoc()) {
            $retval[] = $row;
        }

        return $retval;
    }
}

/**
 * Class DB_Mysql for connection to Database in context of MySql RDBMS.
 */
class DB_Mysql implements DB_Connection {
    protected $user;
    protected $pass;
    protected $dbhost;
    protected $dbname;
    protected $dbh;
    protected $isConnected;

    /**
     * Constructor.
     * @param string $user <p>user name</p>
     * @param string $pass <p>password of user</p>
     * @param string $dbhost <p>server name</p>
     * @param string $dbname <p>name of database</p>
     * @return mixed instance of class
     */
    public function DB_Mysql($user, $pass, $dbhost, $dbname) {
        $this->user = $user;
        $this->pass = $pass;
        $this->dbhost = $dbhost;
        $this->dbname = $dbname;
    }

    /**
     * Check if connection exists.
     * @return bool true if connection exists, else return false
     */
    public function isConnected()
    {
        if(is_resource($this->dbh)) {
            return true;
        }
        else {
            return false;
        }
    }

    public function connect()
    {
        if(isConnected()) {
            return;
        }

        $this->dbh = mysqli_connect($this->dbhost, $this->user, $this->pass, $this->dbname);
        if(!is_resource($this->dbh)) {
            throw new MysqlException;
        }
    }

    public function close()
    {
        if(!isConnected()) {
            return;
        }

        mysqli_close($this->dbh);
    }

    public function execute($query)
    {
        if(!isConnected()) {
            $this->connect();
        }

        $ret = mysqli_query($this->dbh, $query);
        if(!$ret) {
            throw new MysqlException;
        }

        if(!is_resource($ret)) {
            return TRUE;
        }
        else {
            $stmt = new DB_MysqlStatement($this->dbh, $query);
            $stmt->result = $ret;
            return $stmt;
        }
    }
    public function prepare($query)
    {
        if(!isConnected()) {
            $this->connect();
        }

        return new DB_MysqlStatement($this->dbh, $query);
    }

    public function free()
    {
        mysqli_free_result($this->dbh);
    }
}

?>
<?php

require_once('../app/exceptions/MySqlException.php');

/**
 * Main class for handling DB requests.
 * based on http://www.informit.com/store/advanced-php-programming-9780672325618 (Chapter 12 & book sources)
 */

/**
 * Interface for processing SQL statement.
 */
interface DbStatement {
    /**
     * Execute SQL statement with applying parameters of query.
     * @return mixed DbStatement
     */
    public function Execute();

    /**
     * Perform parameters binding for query.
     * @param string $key <p>parameter name</p>
     * @param mixed $value <p>parameter value</p>
     * @return mixed
     */
    public function BindParam($key, $value);

    /**
     * Return one row after executing query.
     * @return mixed
     */
    public function FetchRow();

    /**
     * Return one row as associated arrays after executing query.
     * @return mixed
     */
    public function FetchAssoc();

    /**
     * Return associated arrays of all rows after executing query.
     * @return mixed
     */
    public function FetchAllAssoc();
}

/**
 * Interface for connection to Database
 */
interface DbConnection {
    /**
     * Perform connection to database.
     * @return mixed
     */
    public function Connect();

    /**
     * Close connection to database.
     * @return mixed
     */
    public function Close();

    /**
     * Create DbMySqlStatement for executing SQL statement.
     * @param string $query <p>text of SQL statement</p>
     * @return DbMySqlStatement SQL statement without execution
     */
    public function Prepare($query);

    /**
     * Execute SQL statement and return result.
     * @param $query text of SQL statement
     * @return DbMySqlStatement SQL statement with result of execution
     */
    public function Execute($query);

    /**
     * Return flag if state of connection is connected to selected database.
     * @return bool
     */
    public function IsConnected();

    /**
     * Return last inserted autoincrement identifier
     * @return int autoincrement identifier.
     */
    public function LastInsertedId();
}

/**
 * Class DbMySqlStatement for processing SQL-statement in context of MySql RDBMS.
 */
class DbMySqlStatement implements DbStatement
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
    public function __construct($dbh, $query)
    {
        $this->dbh = $dbh;
        $this->query = $query;

        if (!$dbh) {
            throw new MysqlException($this->dbh, "Not a valid database connection", -1);
        }
    }

    public function BindParam($ph, $pv)
    {
        $this->binds[$ph] = $pv;
        return $this;
    }

    public function Execute()
    {
        $binds = func_get_args();
        foreach ($binds as $index => $name) {
            $this->binds[$index + 1] = $name;
        }

        $cnt = count($binds);
        $query = $this->query;
        foreach ($this->binds as $ph => $pv) {
            $query = str_replace(":$ph", "'" . mysqli_escape_string($this->dbh, $pv) . "'", $query);
        }

        $this->result = mysqli_query($this->dbh, $query);
        if (!$this->result) {
            throw new MysqlException($this->dbh);
        }

        return $this;
    }

    public function FetchRow()
    {
        if (!$this->result) {
            throw new MysqlException($this->dbh, "Query not executed");
        }

        return mysqli_fetch_row($this->result);
    }

    public function FetchAssoc()
    {
        return mysqli_fetch_assoc($this->result);
    }

    public function FetchAllAssoc()
    {
        $retval = array();

        while ($row = $this->FetchAssoc()) {
            $retval[] = $row;
        }

        return $retval;
    }
}

/**
 * Class DbMySql for connection to Database in context of MySql RDBMS.
 */
class DbMySql implements DbConnection {
    protected $user;
    protected $pass;
    protected $dbhost;
    protected $dbname;
    protected $dbh;

    /**
     * Constructor.
     * @param string $user <p>user name</p>
     * @param string $pass <p>password of user</p>
     * @param string $dbhost <p>server name</p>
     * @param string $dbname <p>name of database</p>
     */
    public function __construct($user, $pass, $dbhost, $dbname) {
        $this->user = $user;
        $this->pass = $pass;
        $this->dbhost = $dbhost;
        $this->dbname = $dbname;
    }

    public function IsConnected()
    {
        if(!$this->dbh) {
            return false;
        }
        else {
            return true;
        }
    }

    public function Connect()
    {
        if($this->IsConnected()) {
            return;
        }

        $this->dbh = mysqli_connect($this->dbhost, $this->user, $this->pass, $this->dbname);
        if(!$this->dbh) {
            throw new MySqlException($this->dbh, "Not a valid database connection", -1);
        }
    }

    public function Close()
    {
        if(!$this->IsConnected()) {
            return;
        }

        mysqli_close($this->dbh);
        unset($this->dbh);
    }

    public function Execute($query)
    {
        if(!$this->IsConnected()) {
            $this->Connect();
        }

        $ret = mysqli_query($this->dbh, $query);
        if(!$ret) {
            throw new MysqlException($this->dbh);
        }

        $stmt = new DbMySqlStatement($this->dbh, $query);
        $stmt->result = $ret;
        return $stmt;
    }

    public function Prepare($query)
    {
        if(!$this->IsConnected()) {
            $this->Connect();
        }

        return new DbMySqlStatement($this->dbh, $query);
    }

    public function LastInsertedId()
    {
        return mysqli_insert_id($this->dbh);
    }
}

class DbMySqlTest extends DbMySql {
    protected $dbhost = "127.0.0.1";
    protected $user   = "root";
    protected $pass   = "";
    protected $dbname = "contest";

    public function __construct() { }
}

class DbMySqlProd extends DbMySql {
    protected $user   = "iuri668sql";
    protected $pass   = "";
    protected $dbhost = "128.199.211.172";
    protected $dbname = "iuri668db";

    public function __construct() { }
}

?>
<?php

class DbConnection
{
    private $rs; // Procedural "handle" or "resource" to database
    private $connectRs;
    private $fetchResult;
    private $DBi;

    private function connectDb($pStrDatabase)
    {
        $this->connectRs = mysqli_connect("localhost", "root", "");
        if (!$this->connectRs) {
            echo "Error connecting to the database server" . mysqli_error($this->connectRs);
            $this->connectRs = -1;
        }
        //else
        //    echo "Connected </br>";
        $dbRs = mysqli_select_db($this->connectRs, $pStrDatabase);
        if (!$dbRs) {
            echo "Error selecting the database" . mysqli_errno($this->connectRs);

        }
        // else
        //     echo "Selected ".$pStrDatabase."</br>";
    }

    public function query($pStrSQL)
    {

        $this->rs = -1;// BAD RECORDSET

        $this->rs = mysqli_query($this->connectRs, $pStrSQL);
        if (!$this->rs) {
            echo "Error running query [$pStrSQL] " . mysqli_error($this->connectRs) . "<br>";
            $this->rs = -1;

        }


    }

    public function lastCount()
    {
        $result = mysqli_num_rows($this->rs);
        return $result;
    }

    public function DbConnection($pStrDatabase)
    {

        $this->connectDb($pStrDatabase);


    }

    public function next()
    {
        $aRow = mysqli_fetch_assoc($this->rs);
        return $aRow;
    }

    public function free()
    {
        mysqli_free_result($this->rs);
    }
}

/*
    // Test Code using Food / Something database
    $aDB = new DBConnection("Something");
 //   $aDB->query("INSERT INTO `Ingredient` (`Name`, `Description`) VALUES ('GARLIC', 'Smelly')");
    $aDB->query("SELECT * FROM user;");
    echo "count is ".$aDB->lastCount()."</br>";

    while($aRow = $aDB->next()){
        echo $aRow['name']."  ".$aRow['password']."</br>";
    }

    $aDB->free();
    //$aDB->query("DELETE FROM INGREDIENT WHERE `Name` = 'GARLIC'");

 //
 */

?>
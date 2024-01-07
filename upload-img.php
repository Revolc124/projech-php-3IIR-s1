<?php  

class Connection2{
    private $sname = "localhost";
    private $uname = "root";
    private $password = "";

    public $conn;
    


    


    function createDatabase($dbName){
        //creating a database with the conn in the class ($this->conn)
        $dbExists = mysqli_select_db($this->conn, $dbName);
        if($dbExists){
            echo "Database '$dbName' already exists";
        } else {
        $sql = "CREATE DATABASE $dbName";
        if (mysqli_query($this->conn, $sql)) {
            echo "Database created successfully";
        } 
        else {
            echo "Error creating database: " . mysqli_error($this->conn);
        }
        }
    }

    

    function createTable($query){
    
        if (mysqli_query($this->conn, $query)) {
            echo "Table Images created successfully";
            } else {
            echo "Error creating table: " . mysqli_error($this->conn);
            }    
    }

}

$connection = new Connection2();

//create an instance of Connection class

//call the createDatabase methods to create database "chap4Db"
$connection->createDatabase('abdo2');







$connection->createTable($query);




?>
<?php  


class Connection{
    private $sname = "localhost";
    private $uname = "root";
    private $password = "";

    public $conn;
    


    public function __construct(){
        $this->conn = mysqli_connect( $this->sname,  $this->uname,  $this->password);

        if (!$this->conn) {
            echo "Connection failed!";
            exit();
        }
    }


    function createDatabase($dbName){
        // Check if the database already exists
        $dbExists = mysqli_select_db($this->conn, $dbName);
        if($dbExists){
            
        } else {
            $sql = "CREATE DATABASE $dbName";
            if (mysqli_query($this->conn, $sql)) {
                echo "Database created successfully";
            } else {
                echo "Error creating database: " . mysqli_error($this->conn);
            }
        }
    }

    function selectDatabase($dbName){
        //select database with the conn of the class, using mysqli_select..
        mysqli_select_db( $this->conn,$dbName);
    }

    function createTable($query){
        // Check if the table already exists
        $tableExists = mysqli_query($this->conn, "DESCRIBE `images`");
        if($tableExists){
            
        } else {
            if (mysqli_query($this->conn, $query)) {
                
            } else {
                echo "Error creating table: " . mysqli_error($this->conn);
            }    
        }
    }
}

//create an instance of Connection class
$connection = new Connection();

//call the createDatabase methods to create database "chap4Db"
$connection->createDatabase('abdo2');


$query = "
CREATE TABLE images (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
image_url TEXT(200)
)
";

// Check if the 'description' column already exists
$result = mysqli_query($connection->conn, "SHOW COLUMNS FROM `images` LIKE 'description'");
$exists = (mysqli_num_rows($result))?TRUE:FALSE;

if(!$exists) {
    // The 'description' column does not exist, so we can add it
    $alterTable = $connection->conn->query("ALTER TABLE images ADD description TEXT");
}


$connection->selectDatabase('abdo2');

$connection->createTable($query);




?>
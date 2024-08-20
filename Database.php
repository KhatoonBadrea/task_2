<?php
class Database {
   
    private $serverName;
    private $userName;
    private $password;
    private $dbName;
    public $conn;
 
    public function __construct($serverName = "localhost", $userName = "root", $password = "", $dbName = "blog_db") {
        $this->serverName = $serverName;
        $this->userName = $userName;
        $this->password = $password;
        $this->dbName = $dbName;

        // إنشاء الاتصال بقاعدة البيانات
        $this->conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);

        // التحقق من نجاح الاتصال
        if ($this->conn->connect_error) {
            die(" Connection failure " . $this->conn->connect_error);
        }
    }

    //  تنفيذ الاستعلامات
    public function executeQuery($query) {

        $result = $this->conn->query($query);

      
         if ($result) {
            return $result; 
        } else {
            die("error " . $this->conn->error);
        }
    }

    //  لجلب النتائج
    public function fetchResults($result) {
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC); 
        } else {
            return [];
        }
    }

    // إغلاق الاتصال بقاعدة البيانات
    public function closeConnection() {
        $this->conn->close();
    }
}

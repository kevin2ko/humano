<?PHP
	date_default_timezone_set('Asia/Manila');
	session_start();
    class connection{
     
        private $host = "localhost";
        private $username = "root";
        private $password = "sierra";
        private $db_name = "humano";
        public $conn;
		
  		public function PDO() {
			
			$this->conn = null;

            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->conn->query("SET NAMES 'utf8'");
				$this->conn->query("SET CHARACTER SET utf8");
				$this->conn->query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");
            }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }

            return $this->conn;
		}
    }
?>
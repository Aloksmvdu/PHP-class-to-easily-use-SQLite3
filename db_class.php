<?php
/*
Version: 1.1.0
Last updated: 2019-09-05
Developer: Alok Yadav(info@alokyadav.in)
*/
?>
<?php
	class DB extends SQLite3 {
		private static $con;
		public $location;
		private $ret;
		private $logEnable;
		public $error;
		public $affected;
		public function db_logEnable($status){
			$this->logEnable = $status;
		}
		private function db_log($msg){
			if($this->logEnable){
				echo $msg."<br>";
			}
		}
		public function __construct($db_location) {
			$this->location = sprintf("%s", $db_location);
			self::$con = $this;
			$this->open($db_location);
		}
		public static function db_open($db_location){
            self::$con = new DB($db_location);
			if(!self::$con) {
				echo self::$con->lastErrorMsg();
			} else {
				$this->db_log("Opened database successfully");
			}
            return self::$con;
		}
		public static function db_close(){
			self::$con->close();
		}
		public function db_exec($sql){
			$this->ret = self::$con->exec($sql);
			if(!$this->ret){
				$this->error = self::$con->lastErrorMsg();
				$this->db_log(self::$con->lastErrorMsg());
			} else {
				$this->affected = self::$con->changes();
				$this->db_log(self::$con->changes()." Row Affected");
				$this->db_log("Query Executed successfully");
			}
			return $this->ret;
		}
		public function db_query($sql){
			$this->ret = self::$con->query($sql);
			if(!$this->ret){
				$this->error = self::$con->lastErrorMsg();
				$this->db_log(self::$con->lastErrorMsg());
			} else {
				$this->affected = self::$con->changes();
				$this->db_log(self::$con->changes()." Row Affected");
				$this->db_log("Query Executed successfully");
			}
			return $this->ret;
		}
		public function db_frameString($string, $qoute){
			if($qoute == '\''){
				$string = str_replace('\'','\'\'',$string);
			}else if($qoute == '"'){
				$string = str_replace('"','""',$string);
			}
			return $string;
		}
		public function db_frameQuery($query){
			return _($query);
		}
	}
?>

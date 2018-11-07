<?php
class mxDb {
	var $qry;	
	var $PARSEPUT = array("string"=>"stringIn", "int"=>"intIn", "blob"=>"stringIn", "date"=>"stringIn", "real"=>"realIn", "datetime"=>"stringIn", "timestamp"=>"stringIn", "time"=>"stringIn", "year"=>"intIn");
	var $PARSEGET = array("string"=>"stringOut", "blob"=>"stringOut");
	var $insertID = 0;
	var $numRows  = 0;
	var $pre  = "mx_";
	var $row  = array();
	var $rows = array();	
	var $affectedRows = 0;
	var $table = "";
	var $cols  = array();
	var $data = array();
	
	private function stringIn($v=""){ if($v) { $v = mysql_real_escape_string($v); } return $v; }
	private function intIn($v="")   { if($v) { $v = sprintf("%d",$v); } return $v; }
	private function realIn($v="") { if($v) { $v = sprintf("%f",$v); } return $v; }
	private function stringOut($v="") { if($v) { $v = stripslashes($v); } return $v; }
	
	function dbReset(){
		$this->insertID = 0;
		$this->numRows  = 0;		
		$this->row  = array();
		$this->rows = array();	
		$this->affectedRows = 0;
		$this->table = "";
		$this->cols  = array();
	}
	
	private function parseIn(){
		global $PARSEPUT; $arrF = array();				
		if($this->data) {
			$qry = mysql_query("SELECT * FROM `$this->table` LIMIT 0");			
			error_log( "ParseIn Query 01: SELECT * FROM `$this->table` LIMIT 0" );
			while ($i < mysql_num_fields($qry)) {																
				$name  = mysql_field_name($qry, $i);				
				if(array_key_exists($name,$this->data)) {
					$type  = mysql_field_type($qry, $i);
					$func  = $this->PARSEPUT[$type];
					$arrF[$name] = $this->{$func}($this->data[$name]);					
				}
				$i++;
			}
			$this->data = $arrF;				
		}				
	}
	
	private function sqlAdd(){
		$sql = "";
		if($this->data){
			$this->parseIn();					
			$fields = implode('`,`',array_keys($this->data));
			$values = implode("','",array_values($this->data));
			$sql  = "INSERT INTO `$this->table` (`$fields`) VALUES ('$values')";
		}	
		return $sql;
	}
	
	private function sqlEdit($where=""){
		$sql = "";
		if($where){
			$this->parseIn();
			$sep = "";
			foreach($this->data as $k=>$v){
				$sql .= "$sep`$k`='$v'";			
				$sep = ",";
			}
			if($sql)
				$sql = "UPDATE `$this->table` SET $sql WHERE $where";
		}
		return $sql;
	}
	
	public function dbQuery($sql){
		if($sql) {
			if($this->qry = mysql_query($sql)) {						
				$this->numRows = @mysql_num_rows($this->qry);
				$this->insertID = mysql_insert_id();			
				$this->affectedRows = @mysql_affected_rows();				
				$sql = "";
				return true;			
			} else {			
				die ($sql."<br>$sql<br>".mysql_error());
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function dbInsert(){
		$sql = $this->sqlAdd();
		if($this->dbQuery($sql))
			return true;		
	}
	
	public function dbUpdate($where){
		$sql = $this->sqlEdit($where);
		if($this->dbQuery($sql))
			return true;
	}
	
	private function setCols(){
		$this->cols = array(); $i =0;
		while ($i < mysql_num_fields($this->qry)) {									
			$type  = mysql_field_type($this->qry, $i);
			$name  = mysql_field_name($this->qry, $i);
			$this->cols[$name] = $type;			
			$i++;
		}	
	}
	
	function parseRow($arr){
		$arrT = array();
		if($arr){
			foreach($arr as $k=>$v){
				if($v){					
					if(array_key_exists($this->cols[$k],$this->PARSEGET)){						
						$func = $this->PARSEGET[$this->cols[$k]];						
						$v = $this->{$func}($v);
					}					
				}
				$arrT[$k] = $v;
			}	
		}
		return $arrT;
	}
	
	public function dbRows($sql){
		$this->row = array();
		if($sql){
			$this->dbReset();			
			$this->dbQuery($sql);
			if($this->numRows > 0) {				
				$this->setCols();
				while($row = mysql_fetch_assoc($this->qry)) {
					$this->rows[] = $this->parseRow($row);
				}				
			}
			mysql_free_result($this->qry);
			return $this->rows;			
		}
	}
	
	public function dbRow($sql){
		$this->row = array();
		if($sql){
			$this->dbQuery($sql);
			if($this->numRows > 0) {
				$this->setCols();				
				$row = mysql_fetch_assoc($this->qry);				
				$this->row = $this->parseRow($row);							
			}
			mysql_free_result($this->qry);
			return $this->row;
		}
	}	
}
?>
<?php
/**
*This class includes all functions used in project
*/
class session
{
	
	function __construct($dbhost, $dbuser, $dbpass, $dbname){
		$this->handle = mysql_connect($dbhost, $dbuser, $dbpass) or die('z³e dane logowania');
		$baza = mysql_select_db($dbname, $this->handle) or die('Database Failure');
	}
	

	function insert($url, $rand){
		mysql_query('insert into URLcut values(null,\''.$url.'\',\''.$rand.'\', '');');
	}

	/*function update()
	{
		mysql_query('update URLcut set used=\''..'\' where ');
	}
	*/
	function selectAll($urlAdress){
		$ret1=mysql_query('SELECT * from URLcut where srcURL = \''.$urlAdress.'\';');
		return $ret1;
	}

	function rand_chars($l, $u = FALSE) {
		for ($i=0; $i < 5; $i++) { 
			$s=$s.chr(rand(65,90));
		}
		return $s; 
 	}
}
?>
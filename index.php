<?php
	require_once 'class.php';
	session_start();

	$sesja = new session('mysql.cba.pl:3306', 'ldoszczeczko', 'zxcvbnm', 'ldoszczeczko_cba_pl');

	if (isset($_GET['q']) && (!empty($_GET['q']))) {
		$res=mysql_query('SELECT * from URLcut where dstURL = \''.$_GET['q'].'\';');
		while ($row = mysql_fetch_assoc($res)) {
			$tmp=$row['srcURL'];
			echo $tmp;
		}
		
		header("Location: ".$tmp."");
	}

	if (isset($_POST['Logout']) && (!empty($_POST['Logout']))) {
		$_SESSION['logged']="0";
		unset($_POST['Logout']);
	}

?>
<html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<LINK REL="stylesheet" HREF="style.css" TYPE="text/css">
</head>
<body>

<div id="banner">
	<a href="">TU BĘDZIE BANNER!</a>
</div>
</br>

<div id="main">

<?php
	if(isset($_GET['id']))
		$page=$_GET['id'];
	else
		$page=1;

	if (!isset($_SESSION['logged']) || $_SESSION['logged']=="0") {
			include "logging.php";
	}
	else{
?>

	<form method="POST" action="index.php">
		<?php
		echo("Tu wklej link:</br> <input type=\"text\" name=\"URL\" size=\"80\" value=\"".$_POST['URL']."\">");
		?>
		</br></br>
		Nazwa: 
		</br>
		<input type="text" name="userRandom" size="30">
		<input type="submit" value="cut" name="cut" id="cut">
	</form>

<?php
	//unset($_POST['cut2']);
	/*echo isset($_POST['cut2']);

	if (isset($_POST['cut2'])){
		echo "string";
		unset($_POST['cut2']);
		echo isset($_POST['cut2']);
	}*/

	if (isset($_POST['cut']) && ($_POST['URL']!=$_SESSION['earlierCut']) && (!empty($_POST['URL']))) {		
		$_SESSION['earlierCut']=$_POST['URL'];
		

		if (!preg_match("#^http(s)?://[a-z0-9-_.]+\.[a-z]{2,4}#",$_POST['URL'])) {
			echo "wrong url";
		} else {

			if (empty($_POST['userRandom'])) {
				$_SESSION['random'] = $sesja->rand_chars(10);	
			}
			else{
				$_SESSION['random'] = $_POST['userRandom'];
			}

			$sesja->insert($_POST['URL'], $_SESSION['random']);
			$result = mysql_query('SELECT * from URLcut where srcURL = \''.$_POST['URL'].'\';');
			
			while ($row = mysql_fetch_assoc($result)) {
				echo ("Skrócony link: </br><input type=\"text\" value=\"http://ldoszczeczko.cba.pl/freedomesProject/index.php?q=".$row['dstURL']."\" size=\"80\">");
			}
		}
		$ret=array();
		unset($_POST['cut']);
	}

	?>
		<form method="POST" action="index.php">
			<input type="submit" name="Logout" value="Logout">
		</form>
	<?php
}
?>
</div>
</body>
</html>



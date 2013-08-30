<?php 
if (isset($_POST['Wyslij'])){
	unset($_POST['Wyslij']);
	$login=array();
	$login = $sesja->find_user($_POST['login']);
	foreach ($login as $t){
		if ($t['password']==$_POST['password']){
			$_SESSION['logged']= "1";
			header("Location: index.php");
		}
	}
}
?>

<form method="post" action="index.php">

	<table style="font-size: 24">

		<tr>
			<td>Login:</td>
			<td><input type="text" name="login"
				value="<?php echo $_POST["login"]; ?>" />
			</td>
		</tr>
		<tr>
			<td>Hasło:</td>
			<td><input type="password" name="password"/>
			</td>
		</tr>
	</table>


	<input type="submit" value="Wyslij" name="Wyslij" />
</form>

<?php
$mysql_info_file=fopen("mysql_info","r");
$mysql_user;
$mysql_user=fgets($mysql_info_file);
$mysql_user=strtok($mysql_user,"\n");
$mysql_passwd;
$mysql_passwd=fgets($mysql_info_file);
$mysql_passwd=strtok($mysql_passwd,"\n");
fclose($mysql_info_file);
$host="localhost";
if(!mysql_connect($host,$mysql_user,$mysql_passwd))
{
        die("cannot connect mysql");
}
mysql_select_db("bbs");
session_start();
if($_SESSION["previlege"]!=1)
	header("Location:main_area.php");
?>

<html>
	<head>
		<title>management</title>
	</head>
	<body>
		<h1>previlege management</h1><br>
		<?php
			$res=mysql_query("select * from user_info");
			while($ans=mysql_fetch_array($res))
			{
				echo "username:".$ans["username"]."<br>";
				echo "previlege:".$ans["previlege"]."<br>";
			}
		?>
		<h3>set previlege</h3><br>
		<form action="set_pre.php" method="post">
			username:<input type="text" name="username" /><br>
			previlege(1-3):<input type="text" name="previlege" />
			<input type="submit" value="submit" /> 
		</form>
	</body>
	
</html>

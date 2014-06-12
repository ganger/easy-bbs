<?php
$user=$_POST["user"];
$passwd=$_POST["passwd"];
$host="localhost";
$mysql_info_file=fopen("mysql_info","r");
$mysql_user;
$mysql_user=fgets($mysql_info_file);
$mysql_user=strtok($mysql_user,"\n");
$mysql_passwd;
$mysql_passwd=fgets($mysql_info_file);
$mysql_passwd=strtok($mysql_passwd,"\n");
fclose($mysql_info_file);
if(!mysql_connect($host,$mysql_user,$mysql_passwd))
{
      echo "cannot connect mysql!";
}
mysql_select_db("bbs");
$str="select * from user_info where username=\"".$user."\"";
$res=mysql_query($str);
if($res==false)
{
	echo $str;
	die("no such user");
}
else
{
	$ans=mysql_fetch_array($res);
	if($ans==false)
	{
		die("no such user");
	}
	else
	{
		if($ans["username"]==$user&&$ans["passwd"]==$passwd) //login successful
		{
			echo "ok";
			session_start();
			$_SESSION["username"]=$user;
			$_SESSION["previlege"]=$ans["previlege"];
			header("Location:main_area.php");
		}
		else
		{
			die("wrong passwd");
		}
	}
}
?>

<?php
$username=$_POST["username"];
$passwd1=$_POST["passwd1"];
$passwd2=$_POST["passwd2"];
if($passwd1!=$passwd2)
{
	die("2 password don't match,please try again!");
	
}
if(strlen($passwd1)<6)
{
	die("password is too short(at least 6)");
}
else
{
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
	else
	{
		mysql_select_db("bbs");
		$str="select username from user_info where username=\"".$username."\"";
		$user_arr=mysql_query($str);
		while($res=mysql_fetch_array($user_arr))
		{
			if($res["username"]==$username)
				die("user exists!");
		}
		$str="insert into user_info values(\"".$username."\",\"".$passwd1."\","."1)";
		if(mysql_query($str))
		{
			echo "successful!!";
		}
	}
	
}
?>

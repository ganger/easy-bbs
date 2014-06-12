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
$previlege=$_POST["previlege"];
$username=$_POST["username"];
if(!($previlege==1||$previlege==2||$previlege==3))
{
	die("previlege must be 1-3");
}
$res=mysql_query("select username from user_info where username=\"".$username."\"");
if($res==false)
{
	die("no such user");
}
else
{
	$ans=mysql_fetch_array($res);
	if($ans["username"]==$username)
	{
		$str="update user_info set previlege=".$previlege." where username=\"".$username."\"";
		mysql_query($str);
		header("Location:manage.php");
	}
	else
		die("no such user");
}
echo "ok";
?>

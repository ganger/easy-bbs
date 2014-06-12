<?php
session_start();
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
      die("cannot connect mysql!");
}
mysql_select_db("bbs");

$user=$_SESSION["username"];
$type=$_GET["type"];
$text=$_POST["text"];
if($user!="guest")
{
	if($type=="comment")
	{
		$content_id=$_GET["content_id"];
		$str="insert into comment values(\"".$user."\",\"".$text."\",\"\",".$content_id.")";
		if(mysql_query($str))
		{
			echo "success!";
			header("Location:comment.php?content_id=".$content_id);
		}
	}
	else if($type="content")
	{
		$title=$_POST["title"];
		$str="insert into content values(\"".$user."\",\"".$text."\",\"\",\"".$title."\")";
		if(mysql_query($str))
		{
			header("Location:main_area.php");
		}
	}
}else
{
	echo "<script>alert(\"you don't have previlege to do this!\")</script>";
	
}
?>

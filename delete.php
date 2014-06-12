<?php
session_start();
$user=$_SESSION["username"];
$previlege=$_SESSION["previlege"];
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
$comment_id=$_GET["comment_id"];
$content_id=$_GET["content_id"];

if($previlege>1)
{
	echo "<script>alert(\"only admin can do this!\")</script>";

}
else
{
	if($comment_id!=0)
	{
		$str="delete from comment where comment_id=".$comment_id;
		mysql_query($str);
		header("Location:comment.php?content_id=".$content_id);
	}
	else
	{
		
		$str1="delete from comment where content_id=".$content_id;
		$str2="delete from content where content_id=".$content_id;
		mysql_query($str1);
		mysql_query($str2);
		header("Location:main_area.php");
	}
}

?>

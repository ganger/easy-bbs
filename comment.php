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
$content_id=$_GET["content_id"];
$user=$_SESSION["username"];
mysql_select_db("bbs");
$res=mysql_query("select * from content where content_id=".$content_id);
$ans=mysql_fetch_array($res);
?>
<html>
	<head>
		<title>comment list</title>
	</head>
	<body>
		<h1>
		<?php
			echo "welcom!".$user;
			
		?>
		</h1>
		<h3>
		<?php
			echo $ans["title"]."<br>";
			echo "Author:".$ans["content_user"];
			echo "<br>";
			echo $ans["content"]."<br>";
			echo "<a href=\"delete.php?comment_id=0&content_id=".$content_id."\">delete content</a><br>";//commment_id=0 means content
			echo "##########comment list#########<br>";
			unset($res);
			$res=mysql_query("select * from comment where content_id=".$content_id);
			unset($ans);
			while($ans=mysql_fetch_array($res))
			{
				echo "Author:".$ans["comment_user"]."<br>";
				echo $ans["comment"]."<br>";
				echo "<a href=\"delete.php?comment_id=".$ans["comment_id"]."&content_id=".$content_id."\">delete comment</a><br>";
				echo "##############################<br>";
			}
		?>
		</h3>
		add comment:<br>
		<form action="submit.php?type=comment&content_id=<?php echo $content_id ?>" method="post">
			Your comment:<input type="text" name="text" />
			<input type="submit" value="submit">
		</form>
	</body>
</html>

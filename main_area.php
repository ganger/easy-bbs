<?php
$mysql_info_file=fopen("mysql_info","r");
$mysql_user;
$mysql_user=fgets($mysql_info_file);
$mysql_user=strtok($mysql_user,"\n");
$mysql_passwd;
$mysql_passwd=fgets($mysql_info_file);
$mysql_passwd=strtok($mysql_passwd,"\n");
fclose($mysql_info_file);
session_start();
$user=$_SESSION["username"];
$host="localhost";
mysql_connect($host,$mysql_user,$mysql_passwd);
mysql_select_db("bbs");
?>
<html>
	<head>
		<title>welcom to our bbs</title>
	</head>
	<body>
		<h2>user:
		<?php
			echo $user;
			echo "   welcom!!";
		?></h2><br>
		<?php
			if($_SESSION["previlege"]==1)
			echo "<a href=\"manage.php\">previlege management</a>";
		?>
		<h1>content list<h1><br>
		<h1>##################################################
		<?php
			$res=mysql_query("select * from content");
			while($ans=mysql_fetch_array($res))
			{
				$content_id=$ans["content_id"];
				echo "<a href=\"comment.php?content_id=".$content_id."\">";
				echo "Title:".$ans["title"]."<br>";
				echo "Author:".$ans["content_user"];
				echo "</a>";
				echo "<br>##########################################<br>";
			}
		?>
		</a><h1>
		<form action="submit.php?type=content" method="post">
			new content:<br>
			title:<input type="text" name="title" \><br>
			content:<input type="text" name="text"\><br>
			<input type="submit" value="submit" \>
		</form>

	</body>
</html>

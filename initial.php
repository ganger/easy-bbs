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
	echo "cannot connect mysql";
}
else
{
	mysql_query("create database  if not exists bbs");
	mysql_select_db("bbs");
	mysql_query("create table if not exists user_info(username char(10) primary key,passwd char(20),previlege int)");	
}
	mysql_query("create table if not exists content(content_user char(10),content text,content_id int(6) not null auto_increment,title char(20),primary key(content_id),foreign key (content_user) references user_info(username))");	
	mysql_query("create table if not exists comment(comment_user char(10),comment text,comment_id int(6) not null auto_increment,content_id int(6),primary key(comment_id),foreign key (comment_user) references user_info(username),foreign key (content_id) references content(content_id))");	
	mysql_query("insert into user_info values(\"admin\",\"123\",1)");
	mysql_query("insert into user_info values(\"guest\",\"123\",3)");
	mysql_query("insert into user_info values(\"testuser1\",\"123\",2)");
	mysql_query("insert into user_info values(\"testuser2\",\"123\",2)");
	mysql_query("insert into content values(\"testuser1\",\"content text1\",\"\",\"title1\")");
	mysql_query("insert into comment values(\"testuser1\",\"comment text1\",\"\",1)");
?>


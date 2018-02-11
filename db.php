<?php
    $dblocation = "localhost"; // Имя сервера
    $dbuser = "john";          // Имя пользователя
    $dbpasswd = "pass";            // Пароль
    $database = "test_db";
    $link = mysql_connect($dblocation, $dbuser, $dbpasswd) 
        or die('dont connect: ' . mysql_error());
    mysql_select_db($database) or die('<br>Cant to applied DB<br>');
	/*
	$dblocation = "localhost"; // Имя сервера
    $dbuser = "john";          // Имя пользователя
    $dbpasswd = "pass";            // Пароль
    $database = "test_db";
    $link = mysql_connect($dblocation, $dbuser, $dbpasswd) 
        or die('dont connect: ' . mysql_error());
//    echo 'Connect OK';
	mysql_select_db($database) or die('<br>Cant to applied DB<br>');
	*/
?>


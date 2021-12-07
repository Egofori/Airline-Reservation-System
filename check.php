<?php
if (file_exists("mainlist.txt")) {
	require_once("linkedlist.php");
session_start();
$s=file_get_contents('mainlist.txt');
$a=unserialize($s);

if ($a->search($_POST['name'],$_POST['refnum']))
	echo "Still reserved";
else
	echo "Does not exist!";
}else
{
	echo "List is empty";
}


?>
<?php
require_once("linkedlist.php");
session_start();
$s=file_get_contents('mainlist.txt');
$a=unserialize($s);

$Login_name=$_POST['user'];
$Login_refnum=$_POST['refnum'];
if ($a->search($Login_name,$Login_refnum)){
	$_SESSION['name']=$Login_name;
	$_SESSION["refnum"]=$Login_refnum;
	echo "manage.html";
}
else
	echo "<br>User name and booking reference does not exist";

?>
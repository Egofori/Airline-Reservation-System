<?php
require_once("linkedlist.php");
session_start();
$s=file_get_contents('mainlist.txt');
$a=unserialize($s);
if ($a->search($_SESSION['name'],$_SESSION['refnum'])) {
	$b=$a->search($_SESSION['name'],$_SESSION['refnum']);
	$b->data['seat']=$_POST['seat'];
	echo "done";
}


$s=serialize($a);
file_put_contents('mainlist.txt', $s);
?>
<?php
if (file_exists("mainlist.txt") ){
require_once("linkedlist.php");
$s=file_get_contents('mainlist.txt');
$a=unserialize($s);
$arr=$a->getList();

echo json_encode($arr);
}
?>
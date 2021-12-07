<?php
if (file_exists("mainlist.txt")) {
require_once("linkedlist.php");
session_start();
$s=file_get_contents('mainlist.txt');
$a=unserialize($s);
if (isset($_POST['yes'])&&$_POST['yes']=='yes') {
	if($a->search($_SESSION['name'],$_SESSION["refnum"]))
	{
		$a->deleteLink($_SESSION["name"],$_SESSION["refnum"]);
		$_SESSION["name"]=NULL;
		$_SESSION["refnum"]=NULL;
		echo "Success!";

		$s=serialize($a);
		file_put_contents('mainlist.txt', $s);
	}else{
		echo "first.html";
	}
}elseif(isset($_POST['delete'])&&$_POST['delete']=='delete'){
	if($a->search($_POST['name'],$_POST['refnum']))
	{
		$a->deleteLink($_POST["name"],$_POST["refnum"]);
		if (isset($_SESSION["name"])&&isset($_SESSION["refnum"])) {
			$_SESSION["name"]=NULL;
			$_SESSION["refnum"]=NULL;
		}
		
		echo "Success!";
		$s=serialize($a);
		file_put_contents('mainlist.txt', $s);
	}
	else{
		echo "Not available!";
	}
}elseif (isset($_POST['cls'])) {
		system("del mainlist.txt");
			
		echo "<center><h3>SUCCESS</h3></center>";
}else
{
	echo "Check again";
}

}else
{
	echo "<h3>List is empty!</h3.";
}
?>
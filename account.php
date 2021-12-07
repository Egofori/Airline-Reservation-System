<?php
	require_once("linkedlist.php");
	
	settype($str,"integer");
	if (!file_exists("mainlist.txt")) {
	$fp=fopen("mainlist","w");
	$Main_list=new LinkList();
	$s=serialize($Main_list);
	file_put_contents('mainlist.txt', $s);
	fclose($fp);
	}
	$s=file_get_contents('mainlist.txt');
	$a=unserialize($s);
	
	

	$fly_from=$_POST['fly_from'];
	$fly_to=$_POST['fly_to'];
	$depart_date=$_POST['depart_date'];
	$return_date=$_POST['return_date'];
	$username=filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$age=$_POST['age'];
	//$refnum=$a->getRef()+1;
	//$refnum=str_pad((string)$refnum,3,"0",STR_PAD_LEFT);
	$full=false;
	switch ($fly_from.$fly_to) {
		case "AccraLagos":
		case "LagosAccra":
		
		if($a->kc<157){
			$a->kc=$a->kc+1;
			$refnum=str_pad((string)$a->kc,3,"0",STR_PAD_LEFT);
			$refnum="K-C45".$refnum;
		}else
			$full=true;
		break;
		case "LomeTokyo":
		case "TokyoLome":
		if($a->aj<157){
			$a->aj=$a->aj+1;
			$refnum=str_pad((string)$a->aj,3,"0",STR_PAD_LEFT);
			$refnum="AJ360".$refnum;
		}else
			$full=true;
		
		break;
		case "CairoLondon":
		case "LondonCairo":
		if($a->xl<157){
			$a->xl=$a->xl+1;
			$refnum=str_pad((string)$a->xl,3,"0",STR_PAD_LEFT);
			$refnum="XL89".$refnum;
		}else
			$full=true;
		break;
		default:
		if($a->sy<157){
			$a->sy=$a->sy+1;
			$refnum=str_pad((string)$a->sy,3,"0",STR_PAD_LEFT);
			$refnum="SY-u34".$refnum;
		}else
			$full=true;
		break;
	}
	
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$class=$_POST['class'];
	$seatnum=NULL;
	

	/*if($arr)
	{
		for ($i=0; $i < count($arr); $i++) { 
			
				if($arr[$i]==$Data)
				{
					$ans=1;
					break;
				}
		}
	}*/

	if (!$full) {
	
		try {
		$arr1=explode("/",$depart_date);
		$arr2=($return_date!="never") ? $arr2=explode("/", $return_date): "never";
		
		$dep=new dateTime($arr1[2]."-".$arr1[0]."-".$arr1[1]);
		if ($arr2!="never") {
			$ret=new dateTime($arr2[2]."-".$arr2[0]."-".$arr2[1]);
		}

		$retVal = ((int)$username) ? false : $username ;
		
		if(filter_var($age, FILTER_VALIDATE_INT)&&$age<=150&&$retVal&&filter_var($email, FILTER_VALIDATE_EMAIL)&&filter_var($phone, FILTER_VALIDATE_FLOAT)&&strlen($phone)==10)
		{

			$Data = array('name'=>$username,'age'=>$age,'email'=>$email,'phone'=>$phone,'fly_from' => $fly_from,'fly_to'=>$fly_to ,'depart_date'=>$depart_date,'return_date'=>$return_date,'class'=>$class,'seat'=>$seatnum,'refnum'=>$refnum,'flight'=>substr($refnum,0,strlen($refnum)-3));

			$arr=$a->getList();
			$ans=0;
			if ($arr) {
				for ($i=0; $i < count($arr); $i++) { 
					if (count(array_intersect_assoc($arr[$i], $Data))>9) {
						$ans=1;
						break;
					}	
				}
				
			}
			if (!$ans) {
			$a->insert($Data);
			echo "Done!<br>Your booking reference is<br>{$refnum}";
			}else{
				echo "<br>Already exists!";
			}
		}else
		{
			echo "<br>Invalid input(s)";
		}
		}catch (Exception $e) {
		echo "<br>Invalid input(s)";
		}
	}else{
		echo "<br>Sorry It's full!";
	}
	$s=serialize($a);
	file_put_contents('mainlist.txt', $s);
	
?>
<?php
$servername = "localhost";
$username = "root";
$password = "raspberry";
$databaseName = "paasmer";

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

$feedname= $_POST['feedname'];
$status= $_POST['status'];
//$feedname = 'control2';
//$status = 'on';
$sql1 = "SELECT feedcontrol1,feedcontrol2,feedcontrol1pin, feedcontrol2pin FROM feeddetails";
$sql2 = $conn->query($sql1);

while($res1 = $sql2->fetch_assoc()){
    $types1[] = $res1;
}


$feedcontrol1 = $types1[0]['feedcontrol1'];
$feedcontrol2 = $types1[0]['feedcontrol2'];
$feedcontrol1pin = $types1[0]['feedcontrol1pin'];
$feedcontrol2pin = $types1[0]['feedcontrol2pin'];

if($feedcontrol1==$feedname)
{
	if($status=="off")
	{
		exec("gpio write $feedcontrol1pin 0");
		$sql3 = "UPDATE feeddetails SET feedcontrol1status = '$status'";
		$sql4 = $conn->query($sql3);
		if($sql4 > 0)
		{
			$c['success']="1";
		}
		else
		{
			$c['success']="0";
		}
	}
	else
	{
		exec("gpio write $feedcontrol1pin 1");
		$sql3 = "UPDATE feeddetails SET feedcontrol1status = '$status'";
		$sql4 = $conn->query($sql3);
		if($sql4 > 0)
		{
			$c['success']="1";
		}
		else
		{
			$c['success']="0";
		}
	}
}
else
{
	if($status=="off")
	{
		exec("gpio write $feedcontrol2pin 0");
		$sql3 = "UPDATE feeddetails SET feedcontrol2status = '$status'";
		$sql4 = $conn->query($sql3);
		if($sql4 > 0)
		{
			$c['success']="1";
		}
		else
		{
			$c['success']="0";
		}
	}
	else
	{
		exec("gpio write $feedcontrol2pin 1");
		$sql3 = "UPDATE feeddetails SET feedcontrol2status = '$status'";
		$sql4 = $conn->query($sql3);
		if($sql4 > 0)
		{
			$c['success']="1";
		}
		else
		{
			$c['success']="0";
		}
	}
	
}
echo json_encode($c);
?>

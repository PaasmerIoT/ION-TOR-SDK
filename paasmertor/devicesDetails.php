<?php
$servername = "localhost";
$username = "root";
$password = "raspberry";
$databaseName = "paasmer"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

$sql1 = "SELECT feedname1,feedname2,feedname3,feedname4,feedcontrol1,feedcontrol2,devicename,feedcontrol1status,feedcontrol2status FROM feeddetails";
$sql2 = $conn->query($sql1);

while($res1 = $sql2->fetch_assoc()){
    $types1[] = $res1;
}
$types = [];
$types[0] = $types1[0]['feedname1'];
$types[1] = $types1[0]['feedname2'];
$types[2] = $types1[0]['feedname3'];
$types[3] = $types1[0]['feedname4'];
$devicename = $types1[0]['devicename'];

$controlname = [];
$controlname[0] = $types1[0]['feedcontrol1'];
$controlname[1] = $types1[0]['feedcontrol2'];

$controlstatus = [];
$controlstatus[0] = $types1[0]['feedcontrol1status'];
$controlstatus[1] = $types1[0]['feedcontrol2status'];

$SensorData = [];
$ControlData = [];

	foreach($types as $key => $value){

		$sql3 = "SELECT feedname,value, time FROM sensordetails Where feedname='$value' order by time desc limit 5";
		$sql4 = $conn->query($sql3);
		$sensors = [];
		
		while($res2 = $sql4->fetch_assoc()){
		   array_push($sensors, $res2);   
		}
	
		$sensortype = $value;
		$graph = [];
		date_default_timezone_set('Asia/Kolkata');
			foreach($sensors as $sensor){
					if($value == $sensor['feedname']){
					   $time = date('h:i:s', strtotime($sensor['time']));
						$graph[$time] = $sensor['value'];
					}
			}
		if($sensortype != null && $sensortype != "")
		{
			$SensorData[] = array('sensor' => $sensortype, 'graph' => $graph);
		}
	}
	
	foreach($controlname as $controlkey => $controlvalue)
	{
		if($controlvalue != null && $controlvalue == $controlname[0])
		{
			$ControlData[] = array('control' => $controlvalue, 'status' => $controlstatus[0]);
			//print_r $controlvalue[];
		}
		else if($controlvalue != null && $controlvalue == $controlname[1])
		{
			$ControlData[] = array('control' => $controlvalue, 'status' => $controlstatus[1]);
		}
	}

	$r['SensorData'] = $SensorData;
	$r['ControlData'] = $ControlData;
	$r['DeviceName']  = $devicename;
	//$r['feeddata'] = $feeddata[];
	//$r['DeviceName'] = $device;
	//echo "hai";
	print json_encode($r);

?> 

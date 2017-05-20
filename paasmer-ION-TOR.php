<?php

include 'config.php';
if($sensor1pin != ""){
	exec("gpio mode $sensor1pin in");
}
if($sensor2pin != ""){
	exec("gpio mode $sensor2pin in");
}
if($sensor3pin != ""){
	exec("gpio mode $sensor3pin in");
}
if($sensor4pin != ""){
	exec("gpio mode $sensor4pin in");
}
if($control1pin != ""){
	exec("gpio mode $control1pin out");
}
if($control2pin != ""){
	exec("gpio mode $control2pin out");
}

$servername = "localhost";
$username = "root";
$password = "raspberry";
$databasename = "paasmer";
//$link = new mysqli()
$link=mysqli_connect($servername,$username,$password ,$databasename);


$sql1 = "select * from feeddetails";
$sql2 = $link->query($sql1);
if($sql2->num_rows > 0){
	$sql3="truncate table feeddetails";
	$sql4 = $link->query($sql3);
}
else{
}

$sql5 = "insert into feeddetails (feedname1,feedname2,feedname3,feedname4,feedcontrol1,feedcontrol2,devicename,feedcontrol1pin,feedcontrol2pin,feedcontrol1status,feedcontrol2status) values('$sensor1name','$sensor2name','$sensor3name','$sensor4name','$control1name','$control2name','$devicename','$control1pin','$control2pin','off','off')";
$sql6 = $link->query($sql5);

for(;;){
	if($sensor1name != ""){
		$sensor1value = exec("gpio read $sensor1pin");
		$sql7 = "insert into sensordetails(feedname,value,time) values('$sensor1name','$sensor1value',now())";
		$sql8 = $link->query($sql7);
	}
	if($sensor2name != ""){
                $sensor2value = exec("gpio read $sensor2pin");
                $sql9 = "insert into sensordetails(feedname,value,time) values('$sensor2name','$sensor2value',now())";
                $sql10 = $link->query($sql9);
        }
	if($sensor3name != ""){
                $sensor3value = exec("gpio read $sensor3pin");
                $sql11 = "insert into sensordetails(feedname,value,time) values('$sensor3name','$sensor3value',now())";
                $sql12 = $link->query($sql11);
        }
	if($sensor4name != ""){
                $sensor4value = exec("gpio read $sensor4pin");
                $sql13 = "insert into sensordetails(feedname,value,time) values('$sensor4name','$sensor4value',now())";
                $sql14 = $link->query($sql13);
        }
	sleep($timedelay);
}
 
?>

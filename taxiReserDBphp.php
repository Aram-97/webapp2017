<?php

$user = "root";
$pass = "";

$serverName = "localhost";
$db = "TaxiReservation";

$connect = new mysqli($serverName, $user, $pass, $db) or die("Unable to connect");

//insert new reservation
$name    = $_POST["customerName"];
$tele    = $_POST["customerTeleNum"];
$time    = $_POST["reserDate"] . " " . $_POST["reserTime"];
$start   = $_POST["startPlace"];
$end     = $_POST["endPlace"];
$vehicle = (int)$_POST["vehicleID"];

echo "<br>Show All Driver<br>"
showAllDriver($connect);

// Make new Reservation
echo "<br>Making new Reservation...<br>";
newReservation($connect, $name, $tele, $time, $start, $end, $vehicle);

////////Function

function newReservation($connect, $customerName, $customerTeleNum, $reserTime
						, $startPlace, $endPlace, $vehicleID){

	$sql = "INSERT INTO reservation (customerName, customerTeleNum, reserTime, startPlace, endPlace, vehicleID)
		VALUES ('$customerName', '$customerTeleNum', '$reserTime', '$startPlace', '$endPlace', '$vehicleID')";

	if($connect->query($sql) === TRUE) {
		echo "<br>New reservation created sucessfully!<br>";
	} else {
		echo "<br>Error: " . $sql . "<br>" . $connect->error;
	}
}


//show all reservation
function showAllReservation($connect){

	$sql = "SELECT * FROM reservation";

	$result = $connect->query($sql);

	// Table header
	echo "<br>" .
	"<table border='1'>
		<tr>
			<th>ID</th>
			<th>Customer Name</th>
			<th>Customer Tel.</th>
			<th>Reservation Time</th>
			<th>Start Destination</th>
			<th>End Destination</th>
			<th>Vehicle ID</th>
			<th>Driver ID</th>
			<th>Check In</th>
			<th>Check Out</th>
		</tr>";

	// Inflate table's rows
	if($result->num_rows > 0){
		while ($row = $result->fetch_assoc()) {
			//change how it is displayed here
			echo
			"<tr>"
				. "<td>" . $row["ID"] . "</td>"
				. "<td>" . $row["customerName"] . "</td>"
				. "<td>" . $row["customerTeleNum"] . "</td>"
				. "<td>" . $row["reserTime"] . "</td>"
				. "<td>" . $row["startPlace"] . "</td>"
				. "<td>" . $row["endPlace"] . "</td>"
				. "<td>" . $row["vehicleID"] . "</td>"
				. "<td>" . $row["driverID"] . "</td>"
				. "<td>" . $row["checkIn"] . "</td>"
				. "<td>" . $row["checkOut"] . "</td>"
			. "</tr>";
		}
	}
	// Close table
	echo "</table>";
}


//show new reservation
function showNewReservation($connect){

	$sql = "SELECT *
			FROM reservation
			WHERE driverID IS NULL";

	$result = $connect->query($sql);

	echo "<br>" .
	"<table border='1'>
		<tr>
			<th>ID</th>
			<th>Customer Name</th>
			<th>Customer Tel.</th>
			<th>Reservation Time</th>
			<th>Start Destination</th>
			<th>End Destination</th>
			<th>Vehicle ID</th>
		</tr>";

	if($result->num_rows > 0){
		while ($row = $result->fetch_assoc()) {
			//change how it is displayed here
			echo
			"<tr>"
				. "<td>" . $row["ID"] . "</td>"
				. "<td>" . $row["customerName"] . "</td>"
				. "<td>" . $row["customerTeleNum"] . "</td>"
				. "<td>" . $row["reserTime"] . "</td>"
				. "<td>" . $row["startPlace"] . "</td>"
				. "<td>" . $row["endPlace"] . "</td>"
				. "<td>" . $row["vehicleID"] . "</td>"
			. "</tr>";
		}
	}
	// Close table
	echo "</table>";
}

//show check in but not check out reservation
function showCheckInReservation($connect){

	$sql = "SELECT *
			FROM reservation
			WHERE checkIn IS NOT NULL AND checkOut IS NULL";

	$result = $connect->query($sql);

	echo "<br>" .
	"<table border='1'>
		<tr>
			<th>ID</th>
			<th>Customer Name</th>
			<th>Customer Tel.</th>
			<th>Reservation Time</th>
			<th>Start Destination</th>
			<th>End Destination</th>
			<th>Vehicle ID</th>
			<th>Driver ID</th>
			<th>Check In</th>
		</tr>";

	if($result->num_rows > 0){
		while ($row = $result->fetch_assoc()) {
			//change how it is displayed here
			echo
			"<tr>"
				. "<td>" . $row["ID"] . "</td>"
				. "<td>" . $row["customerName"] . "</td>"
				. "<td>" . $row["customerTeleNum"] . "</td>"
				. "<td>" . $row["reserTime"] . "</td>"
				. "<td>" . $row["startPlace"] . "</td>"
				. "<td>" . $row["endPlace"] . "</td>"
				. "<td>" . $row["vehicleID"] . "</td>"
				. "<td>" . $row["driverID"] . "</td>"
				. "<td>" . $row["checkIn"] . "</td>"
			. "</tr>";
		}
	}
	echo "</table>";
}

//show check out reservation
function showCheckOutReservation($connect){

	$sql = "SELECT *
			FROM reservation
			WHERE checkOut IS NOT NULL";

	$result = $connect->query($sql);

	echo "<br>" .
	"<table border='1'>
		<tr>
			<th>ID</th>
			<th>Customer Name</th>
			<th>Customer Tel.</th>
			<th>Reservation Time</th>
			<th>Start Destination</th>
			<th>End Destination</th>
			<th>Vehicle ID</th>
			<th>Driver ID</th>
			<th>Check In</th>
			<th>Check Out</th>
		</tr>";

	if($result->num_rows > 0){
		while ($row = $result->fetch_assoc()) {
			//change how it is displayed here
			echo
			"<tr>"
				. "<td>" . $row["ID"] . "</td>"
				. "<td>" . $row["customerName"] . "</td>"
				. "<td>" . $row["customerTeleNum"] . "</td>"
				. "<td>" . $row["reserTime"] . "</td>"
				. "<td>" . $row["startPlace"] . "</td>"
				. "<td>" . $row["endPlace"] . "</td>"
				. "<td>" . $row["vehicleID"] . "</td>"
				. "<td>" . $row["driverID"] . "</td>"
				. "<td>" . $row["checkIn"] . "</td>"
				. "<td>" . $row["checkOut"] . "</td>"
			. "</tr>";
		}
	}
	echo "</table>";
}

//all driver
function showAllDriver($connect){
	$sql = "SELECT *
			FROM driver";

	$result = $connect->query($sql);

	echo "<br>" .
	"<table border='1'>
		<tr>
			<th>ID</th>
			<th>Driver Name</th>
			<th>Driver Tel.</th>
			<th>Reservation ID</th>
		</tr>";

	if($result->num_rows > 0){
		while ($row = $result->fetch_assoc()) {
			//change how it is displayed here
			echo
			"<tr>"
				. "<td>" . $row["ID"] . "</td>"
				. "<td>" . $row["name"] . "</td>"
				. "<td>" . $row["phone"] . "</td>"
				. "<td>" . $row["reservationID"] . "</td>"
			. "</tr>";
		}
	}
}

//check taxi driver to put to work
function checkFreeDriver($connect){
	$sql = "SELECT *
			FROM driver
			WHERE reservationID IS NULL";

	$result = $connect->query($sql);

	if($result->num_rows > 0){
		while ($row = $result->fetch_assoc()) {
			//change how it is displayed here
			echo "<br>" . "id: " . $row["ID"]
			. " - Driver Name: " . $row["name"]
			. " - Driver Phone: " . $row["phone"];
		}
	}
}
//assign a driver to a reservation
function assignDriver2Reser($connect,$driverID, $reserID){
	//update driver
	$sql = "UPDATE driver
			SET reservationID = '$reserID'
			WHERE ID = '$driverID'";

	$result = $connect->query($sql);

	if($connect->query($sql) === true){
		echo "<br/>Update driver's reservation sucessfully";
	} else {
		echo "<br/>Error: " . $sql . "<br>" . $connect->error;
	}
	//update reservation
	$sql = "UPDATE reservation
			SET driverID = '$driverID'
			WHERE ID = '$reserID'";

	$result = $connect->query($sql);

	if($connect->query($sql) === true){
		echo "<br/>Update reservation's driver sucessfully";
	} else {
		echo "<br/>Error: " . $sql . "<br>" . $connect->error;
	}
}

//check in reservation
function checkInReser($connect,$reserID){
	$curDateTime = date('Y-m-d H:i:s');

	$sql = "UPDATE reservation
			SET checkIn = '$curDateTime'
			WHERE ID = '$reserID'";

	if($connect->query($sql) === true){
		echo "<br/>Update reservation's check in sucessfully";
	} else {
		echo "<br/>Error: " . $sql . "<br>" . $connect->error;
	}
}
//check out reservation
function checkOutReser($connect,$reserID){
	$curDateTime = date('Y-m-d H:i:s');

	$sql = "UPDATE reservation
			SET checkOut = '$curDateTime'
			WHERE ID = '$reserID'";

	if($connect->query($sql) === true){
		echo "<br/>Update reservation's check out sucessfully";
	} else {
		echo "<br/>Error: " . $sql . "<br>" . $connect->error;
	}

	//find the driver of this reservation to free
	$sql = "SELECT driverID
			FROM reservation
			WHERE ID = '$reserID'";

	$result = $connect->query($sql);

	if($result->num_rows > 0){
		while ($row = $result->fetch_assoc()) {
			$freeID = $row["driverID"];
		}
	}
	//free driver
	$sql = "UPDATE driver
			SET reservationID = NULL
			WHERE ID = '$freeID'";

	if($connect->query($sql) === true){
		echo "<br/>Update driver's check out sucessfully";
	} else {
		echo "<br/>Error: " . $sql . "<br>" . $connect->error;
	}
}

?>

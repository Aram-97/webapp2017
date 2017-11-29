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

// Make new Reservation
echo "<br>Making new Reservation...<br>";
newReservation($connect, $name, $tele, $time, $start, $end, $vehicle);

echo "<br>All Reservation:<br>";
showAllReservation($connect);

echo "<br>New Reservation:<br>";
showNewReservation($connect);

echo "<br>Check In Reservation:<br>";
showCheckInReservation($connect);

echo "<br>Check Out Reservation:<br>";
showCheckOutReservation($connect);

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
?>

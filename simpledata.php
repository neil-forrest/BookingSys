<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();






$firstname = $_POST['firstName'];
$surname = $_POST['surname'];
/*$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$address3 = $_POST['address3'];
$city = $_POST['city'];
$province = $_POST['province'];
$country = $_POST['country'];
$postCode = $_POST['postCode'];
$phone = $_POST['phone'];*/
$email = $_POST['email'];




    echo 'Guest:' . $firstname . ' ' . $surname;
echo '<br>';

echo 'Contact email: ' . $email;

echo '<br>Booking Dates:<br>';

//enter booking dates with booking id
foreach($_POST['bookings'] as $booking)  
{
echo $booking. '<br>';
}

echo '<a href="index.php">Return to start</a>'
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


include('connection.php');



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

//first check if email address exists

$sql = ("SELECT * FROM guests WHERE email=:email");

$stmt = $pdo->prepare($sql);#
$stmt->bindParam(':email', $email, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchObject();
$total = $stmt->rowCount();

if($total==0){
//create new user if doesn't exist
$stmt = $pdo->prepare("INSERT INTO guests (firstName, surname,  email ) VALUES ( ?, ?, ?)");
echo $email;
    echo $firstname;
    echo $surname;
//address1, address2, address3, city,  province, country, postCode, phone,
$stmt->bindParam(1, $firstname);
$stmt->bindParam(2, $surname);
$stmt->bindParam(3, $email);
/*$stmt->bindParam(3, $address1);
$stmt->bindParam(4, $address2);
$stmt->bindParam(5, $address3);
$stmt->bindParam(6, $city);
$stmt->bindParam(7, $province);
$stmt->bindParam(8, $country);
$stmt->bindParam(9, $postCode);
$stmt->bindParam(10, $phone);*/

$stmt->execute();
  print_r($stmt); 
}
$sql = ("SELECT * FROM guests WHERE email=:email");
$stmt = $pdo->prepare($sql);#
$stmt->bindParam(':email', $email, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchObject();

$roomtype=$_POST['roomtype'];

//enter booking dates with booking id
foreach($_POST['bookings'] as $booking)  
{

$book = $pdo->prepare("INSERT INTO bookings (date, guest_id, roomtype_id) VALUES ( ?, ?, ?)");
   
$book->bindParam(1, $booking);
$book->bindParam(2, $result->id);
$book->bindParam(3, $roomtype);
if (!$book) {
    echo "\nPDO::errorInfo():\n";
    print_r($pdo->errorInfo());
}
$book->execute();
}
header('Location: index.php');

?>
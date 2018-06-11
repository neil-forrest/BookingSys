<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Booking Apps</title>
        
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bookings.css">
   <link rel="stylesheet" href="css/main.css">
 
    </head>
    <body><div class="container">
        <div class="row">
   <div id="header" class="col-12">
       <?php
 @include('includes/header.php');
       ?>
            </div>  </div>
   <div class="row">
   <div id="content" class="col-12">
       
       <h2>Calendar</h2>
    <p>The booking apps I've created below all use my Calendar Class which can be found here <a href="https://github.com/neil-forrest/Calendar-Class">https://github.com/neil-forrest/Calendar-Class</a>. For the sake of ease of testing the demos I've restricted the number of rooms per roomtype to three on the third booking method. Also on all methods I've disabled all but the first name, surname and email fields on the guest details forms. Please remember somebody else may have used the demo or be using it so numbers are not restricted to the bookings you make. </p>
       
<h2>Simple Unlimited Bookings</h2>
<p>A simple booking form that logs the guest details and booking dates but doesn't provide any safeguards against double booking. Possibly useful for generating emails with a booking request to be confirmed by the host.<br><a href="simplebookings.php">Demo: Simple Unlimited Bookings</a></p>
        
<h2>Bookings by Room</h2>
<p>A room booking form that logs the guest details and booking dates for each room.
Useful for use with Boutique hotels where rooms are themed so guests can choose the individual room and check if its available.
    <br><a href="roombooking.php">Demo: Bookings by Room</a></p>      
        
<h2>Booking by Room Type and Number of Rooms </h2>
Allows you to pass roomtype and number of rooms available to the function so that it will only allow bookings for the rooms avalable. For ease of testing I've made the demo roomtypes to have only three rooms of each type.<br><a href="limitedbooking.php">Demo: Booking by Room Type and Number of Rooms </a>
         
       </div></div></div>
    </body>
</html>

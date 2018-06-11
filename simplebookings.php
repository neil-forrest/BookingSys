<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Simple bookings</title>
        
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bookings.css">
   
 
    </head>
    <body>
   <?php
   $date= date('c', mktime(0,0,0,8,1, 2018));
        $date=rtrim($date, 'T00:00:00+00:00');
 
        
    include ('classes/SimpleBookings.php');
      $simplebookings = new SimpleBookings();


$simplebookings->BookingForm();

    ?>
    </body>
</html>

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calendars</title>
        
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bookings.css">
   <link rel="stylesheet" href="css/main.css">
 
    </head>
    <body><div class="container">
 
   <div class="row">
   <div class="col-12">
  <?php  
     include ('classes/RoomBookings.php');
      $calendar = new RoomBookings();


$calendar->GuestsForm();
   
    ?>

  </div></div></div>
</body>
</html>


<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calendars</title>
        

  
<link rel="stylesheet" href="css/bookings.css">
   
 
    </head>
    <body>
<div>
    
  <?php  
     include ('classes/LimitedBookings.php');
      $calendar = new LimitedBookings();


$calendar->GuestsForm();
   
    ?>

 </div>
</body>
</html>
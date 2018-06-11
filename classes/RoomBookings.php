<?php
include('connection.php');
 //THIS CLASS IS TO CREATE UNLIMITED BOOKINGS WITH NO ALLOWANCE FOR ROOMTYPES OR NUMBER OF ROOMS
class RoomBookings{
  
    
//Create a form to pick month and year, pass number of years required
function CreateDatepicker($years){
// Define next four years--Add or deduct depending on the range required
define('year', date('Y',time()));
  

//Create form to choose Year and Month-Add or deduct options depending on number of years required
 echo '<form action='.$_SERVER["PHP_SELF"].' method="post"><select name="years">';
 
 if(isset($_POST['years']))
 {
  echo '<option value="'.$_POST['years'].'">'.$_POST['years'].'</option>';}
 echo '<option value="'.year.'">'.year.'</option>';
 for ($i = 1; ; $i++) {
    if ($i >= $years) {
        break;
    }
$year = year+$i;
       
        
echo '<option value="'.$year.'">'.$year.'</option>';
 }
echo '</select>
<select name="months">';
  if(isset($_POST['months']))
 {
  echo '<option value="'.$_POST['months'].'">';
      
  switch ($_POST['months']) {
    case "1":
        $month="January";
        break;
    case "2":
        $month="February";
        break;
    case "3":
        $month="March";
        break;
    case "4":
        $month="April";
        break;
    case "5":
        $month="May";
        break;
    case "6":
        $month="June";
        break;
    case "7":
        $month="July";
        break;
    case "8":
        $month="August";
        break;
    case "9":
        $month="September";
        break;
    case "10":
        $month="October";
        break;
    case "11":
        $month="November";
        break;
    case "12":
        $month="December";
        break;
}    
      
      
echo $month.'</option>';}

echo '<option value="1">January</option>
  <option value="2">February</option>
  <option value="3">March</option>
  <option value="4">April</option>
  <option value="5">May</option>
  <option value="6">June</option>
  <option value="7">July</option>
  <option value="8">August</option>
  <option value="9">September</option>
  <option value="10">October</option>
  <option value="11">November</option>
  <option value="12">December</option>
</select>
<input type="hidden" value="$year">
<input type="submit" value="Choose Year/Month."></form>';
    
}










//------------------------------------

//Create previous month Calendar so that bookings can be created for periods more than one month
function CreatePreviousMonth($room){

  
if(isset($_POST['years']))
  $year=$_POST['years'];
else 
$year=date( "Y", time());


if(isset($_POST['months']))
{$months=$_POST['months'];}
else
{$months=1;
 $month='January';}
   
    

 if($months==1)  { 
$premonths=12;
 $year=$year-1;    
     }
else {
 $premonths=$months-1; }  
  switch ($premonths) {
    case "1":
        $premonth="January";
        break;
    case "2":
        $premonth="February";
        break;
    case "3":
        $premonth="March";
        break;
    case "4":
        $premonth="April";
        break;
    case "5":
        $premonth="May";
        break;
    case "6":
        $premonth="June";
        break;
    case "7":
        $premonth="July";
        break;
    case "8":
        $premonth="August";
        break;
    case "9":
        $premonth="September";
        break;
    case "10":
        $premonth="October";
        break;
    case "11":
        $premonth="November";
        break;
    case "12":
        $premonth="December";
        break;
} 



$prenum_days=date("t", mktime(0,0,0,$premonths,1,$year));


define('prefirst_day', date("l", mktime(0,0,0,$premonths,1,$year)));

switch (prefirst_day) {
    case "Sunday":
        $prefillers=0;
        $prey=7;
        break;
    case "Monday":
        $prefillers=1;
        $prey=6;
        break;
    case "Tuesday":
        $prefillers=2;
        $prey=5;
        break;
    case "Wednesday":
        $prefillers=3;
        $prey=4;
        break;
    case "Thursday":
        $prefillers=4;
        $prey=3;
        break;
    case "Friday":
        $prefillers=5;
        $prey=2;
        break;
    case "Saturday":
        $prefillers=6;
        $prey=1;
        break;
}

$prerest=$prenum_days - $prey;


		
		echo '<h2>'.$premonth.' - '.$year. '</h2>';
	echo '<table border="1" cellspacing="4">';
		echo '<tr>';
     	echo '<th>Sun</th>';
		echo '<th>Mon</th>';
		echo '<th>Tue</th>';
		echo '<th>Wed</th>';
		echo '<th>Thu</th>';
		echo '<th>Fri</th>';
		echo '<th>Sat</th>';
		echo '</tr><tr>';
echo str_repeat('<td>&nbsp;</td>', $prefillers);
for ($i = 1; ; $i++) {
    if ($i > $prey) {
        break;
    }
    $date= date('c', mktime(0,0,0,$premonths,$i,$year));
        $date=rtrim($date, 'T00:00:00+00:00');
global $pdo;
  
 $sql = ("SELECT * FROM roombookings WHERE date=:date and room_id=:room");
$stmt = $pdo->prepare($sql);#
$stmt->bindParam(':date', $date, PDO::PARAM_INT);
    $stmt->bindParam(':room', $room->id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->rowCount();

if($result>0){
    
    echo '<td width="30" style="background-color:#fe8;">'.$i.'</td>';
}  else {
    
    echo '<td width="30">'.$i.'<input type="checkbox" name="bookings[]" value="'. $date.'"></td>';
    }
}
echo '</tr><tr>';
for ($i = 1; ; $i++) {
    if ($i > $prerest) {
        break;
    }
    $pred=$i + $prey;
     $date= date('c', mktime(0,0,0,$premonths,$pred,$year));
        $date=rtrim($date, 'T00:00:00+00:00');
    
 $sql = ("SELECT * FROM roombookings WHERE date=:date and room_id=:room");
$stmt = $pdo->prepare($sql);#
$stmt->bindParam(':date', $date, PDO::PARAM_INT);
    $stmt->bindParam(':room', $room->id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->rowCount();

if($result>0){

    echo '<td width="30" style="background-color:#fe8;">'.$pred.'</td>';
}  else {
    
    echo '<td>'.$pred.'<input type="checkbox" name="bookings[]" value="'. $date.'"></td>';
    }
    
   
switch ($i) {
    case "7":
        echo '</tr><tr>';
        break;
    case "14":
        echo '</tr><tr>';
        break;
    case "21":
        echo '</tr><tr>';
        break;
    case "28":
        echo '</tr><tr>';
        break;

}

}$presofar=$prefillers + $prenum_days;
if($presofar<= 35)
$preleft=35-$presofar;
else
$preleft=42-$presofar;
echo str_repeat('<td>&nbsp;</td>', $preleft);
   
  if($presofar<= 35)
   {echo '</tr><tr>' . str_repeat('<td>&nbsp;</td>', 7);
   }
    
echo '</tr></table>';

}
//---------------------------------------


//Create Target month Calendar
public function CreateMonth($room){
    
global $pdo;
// Define the year to be used
    
if(isset($_POST['years']))
  $year=$_POST['years'];
else 
$year=date( "Y", time());


if(isset($_POST['months']))
{$months=$_POST['months'];}
else
{$months=1;
 $month='January';}
   

$num_days=date("t", mktime(0,0,0,$months,1,$year));


define('first_day', date("l", mktime(0,0,0,$months,1,$year)));

  switch ($months) {
    case "1":
        $month="January";
        break;
    case "2":
        $month="February";
        break;
    case "3":
        $month="March";
        break;
    case "4":
        $month="April";
        break;
    case "5":
        $month="May";
        break;
    case "6":
        $month="June";
        break;
    case "7":
        $month="July";
        break;
    case "8":
        $month="August";
        break;
    case "9":
        $month="September";
        break;
    case "10":
        $month="October";
        break;
    case "11":
        $month="November";
        break;
    case "12":
        $month="December";
        break;}

switch (first_day) {
    case "Sunday":
        $fillers=0;
        $y=7;
        break;
    case "Monday":
        $fillers=1;
        $y=6;
        break;
    case "Tuesday":
        $fillers=2;
        $y=5;
        break;
    case "Wednesday":
        $fillers=3;
        $y=4;
        break;
    case "Thursday":
        $fillers=4;
        $y=3;
        break;
    case "Friday":
        $fillers=5;
        $y=2;
        break;
    case "Saturday":
        $fillers=6;
        $y=1;
        break;
}


$rest=$num_days - $y;
echo '<h2 >'.$month.' - '.$year. '</h2>';
echo '<table><tr>';
		
		
	
		echo '</tr><tr>';
    	echo '<th>Sun</th>';
		echo '<th>Mon</th>';
		echo '<th>Tue</th>';
		echo '<th>Wed</th>';
		echo '<th>Thu</th>';
		echo '<th>Fri</th>';
		echo '<th>Sat</th>';
		echo '</tr><tr>';
echo str_repeat('<td>&nbsp;</td>', $fillers);
for ($i = 1; ; $i++) {
    if ($i > $y) {
        break;
    }
     $date= date('c', mktime(0,0,0,$months,$i,$year));
        $date=rtrim($date, 'T00:00:00+00:00');
    
 $sql = ("SELECT * FROM roombookings WHERE date=:date and room_id=:room");
$stmt = $pdo->prepare($sql);#
$stmt->bindParam(':date', $date, PDO::PARAM_INT);
    $stmt->bindParam(':room', $room->id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->rowCount();

if($result>0){
    
    echo '<td width="30" style="background-color:#fe8;">'.$i.'</td>';
}  else {
    
    echo '<td width="30">'.$i.'<input type="checkbox" name="bookings[]" value="'. $date.'"></td>';
    }
    
}
echo '</tr><tr>';

for ($i = 1; ; $i++) {
    if ($i > $rest) {
        break;
    }
    $d=$i + $y;
         $date= date('c', mktime(0,0,0,$months,$d,$year));
        $date=rtrim($date, 'T00:00:00+00:00');
    
 $sql = ("SELECT * FROM roombookings WHERE date=:date and room_id=:room");
$stmt = $pdo->prepare($sql);#
$stmt->bindParam(':date', $date, PDO::PARAM_INT);
    $stmt->bindParam(':room',$room->id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->rowCount();

if($result>0){
    
    echo '<td width="30" style="background-color:#fe8;">'.$d.'</td>';
}  else {
    echo '<td>'.$d.'<input type="checkbox" name="bookings[]" value="'. $date.'"></td>';
    }
    
    
    
   
switch ($i) {
    case "7":
        echo '</tr><tr>';
        break;
    case "14":
        echo '</tr><tr>';
        break;
    case "21":
        echo '</tr><tr>';
        break;
    case "28":
        echo '</tr><tr>';
        break;

}

}$sofar=$fillers + $num_days;
if($sofar<= 35)
$left=35-$sofar;
else
$left=42-$sofar;
echo str_repeat('<td>&nbsp;</td>', $left);
   
  if($sofar<= 35)
   {echo '</tr><tr>' . str_repeat('<td>&nbsp;</td>', 7);
   }
    
echo '</tr></table>';

}
    //_______________________________--
 //Create Next Month Calendar so that bookings can be created for periods more than one month
public function CreateNextMonth($room){
    
if(isset($_POST['years']))
  $year=$_POST['years'];
else 
$year=date( "Y", time());


if(isset($_POST['months']))
{$months=$_POST['months'];}
else
{
 $months=1;
 $month='January';
}
   


 if($months==12)  { 
$nextmonths=1;
 $year=$year+1;    
     }
else {
 $nextmonths=$months+1; }
    
  switch ($nextmonths) {
    case "1":
        $nextmonth="January";
        break;
    case "2":
        $nextmonth="February";
        break;
    case "3":
        $nextmonth="March";
        break;
    case "4":
        $nextmonth="April";
        break;
    case "5":
        $nextmonth="May";
        break;
    case "6":
        $nextmonth="June";
        break;
    case "7":
        $nextmonth="July";
        break;
    case "8":
        $nextmonth="August";
        break;
    case "9":
        $nextmonth="September";
        break;
    case "10":
        $nextmonth="October";
        break;
    case "11":
        $nextmonth="November";
        break;
    case "12":
        $nextmonth="December";
        break;
} 



$nextnum_days=date("t", mktime(0,0,0,$nextmonths,1,$year));


define('nextfirst_day', date("l", mktime(0,0,0,$nextmonths,1,$year)));

switch (nextfirst_day) {
    case "Sunday":
        $nextfillers=0;
        $nexty=7;
        break;
    case "Monday":
        $nextfillers=1;
        $nexty=6;
        break;
    case "Tuesday":
        $nextfillers=2;
        $nexty=5;
        break;
    case "Wednesday":
        $nextfillers=3;
        $nexty=4;
        break;
    case "Thursday":
        $nextfillers=4;
        $nexty=3;
        break;
    case "Friday":
        $nextfillers=5;
        $nexty=2;
        break;
    case "Saturday":
        $nextfillers=6;
        $nexty=1;
        break;
}

$nextrest=$nextnum_days - $nexty;
echo '<h2 >'.$nextmonth.' - '.$year. '</h2>';
echo '<table border="1" cellspacing="4"><tr>';
	
	
		echo '</tr><tr>';
  	    echo '<th>Sun</th>';
		echo '<th>Mon</th>';
		echo '<th>Tue</th>';
		echo '<th>Wed</th>';
		echo '<th>Thu</th>';
		echo '<th>Fri</th>';
		echo '<th>Sat</th>';  
		echo '</tr><tr>';
echo str_repeat('<td>&nbsp;</td>', $nextfillers);
for ($i = 1; ; $i++) {
    if ($i > $nexty) {
        break;
    }
       $date= date('c', mktime(0,0,0,$nextmonths,$i,$year));
        $date=rtrim($date, 'T00:00:00+00:00');
    global $pdo;

     $sql = ("SELECT * FROM roombookings WHERE date=:date and room_id=:room");
$stmt = $pdo->prepare($sql);#
$stmt->bindParam(':date', $date, PDO::PARAM_INT);
    $stmt->bindParam(':room', $room->id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->rowCount();

if($result>0){
    
   
    echo '<td width="30" style="background-color:#fe8;">'.$i.'</td>';
}  else {
    
    echo '<td>'.$i.'<input type="checkbox" name="bookings[]" value="'. $date.'"></td>';
    }
  
}
echo '</tr><tr>';
for ($i = 1; ; $i++) {
    if ($i > $nextrest) {
        break;
    }
    $nextd=$i + $nexty;
    $date= date('c', mktime(0,0,0,$nextmonths,$nextd,$year));
        $date=rtrim($date, 'T00:00:00+00:00');
    
 $sql = ("SELECT * FROM roombookings WHERE date=:date and room_id=:room");
$stmt = $pdo->prepare($sql);#
$stmt->bindParam(':date', $date, PDO::PARAM_INT);
    $stmt->bindParam(':room', $room->id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->rowCount();

if($result>0){
    
   
    echo '<td width="30" style="background-color:#fe8;">'.$nextd.'</td>';
}  else {
    

    echo '<td width="30">'.$nextd.'<input type="checkbox" name="bookings[]" value="'. $date.'"></td>';
    }
  
switch ($i) {
    case "7":
        echo '</tr><tr>';
        break;
    case "14":
        echo '</tr><tr>';
        break;
    case "21":
        echo '</tr><tr>';
        break;
    case "28":
        echo '</tr><tr>';
        break;

}

}$nextsofar=$nextfillers + $nextnum_days;
if($nextsofar<= 35)
$nextleft=35-$nextsofar;
else
$nextleft=42-$nextsofar;
echo str_repeat('<td>&nbsp;</td>', $nextleft);

  if($nextsofar<= 35)
   {echo '</tr><tr>' . str_repeat('<td>&nbsp;</td>', 7);
   }

echo '</tr></table>';

}
 //THis functions brings the three month calendars and the date picker together under one function. Css needs to be applied.
function BookingForm()
{
 global $pdo;  
   
$calendar = new RoomBookings();
    
echo '<div class="row">';
    
   echo '<div class="col-md-4"><form method="post" action="'. $_SERVER['PHP_SELF'].'"> 
            <input type="hidden" name="delete" value="delete">
            <input type="submit" value="Clear Bookings">
        </form>  </div><div class="col-md-4"><h2>Select Room</h2>';
 
$sql = ("SELECT * FROM rooms");
$stmt = $pdo->prepare($sql);#
$stmt->execute();
$rooms= $stmt->fetchAll();
 foreach($rooms as $room) 
{ 
       
  echo '<form action='.$_SERVER["PHP_SELF"].' method="post">      
<input type="hidden" name="room" value="' .$room['id'].'">
<input type="submit" value="'.$room['room'].'"></form>';
 }
echo '</div></div>';
 
      
if(isset($_POST['room']))
{$room=$_POST['room'];}
else
{$room=1;
}
$sql = ("SELECT * FROM rooms WHERE id=:id");
$stmt = $pdo->prepare($sql);#
$stmt->bindParam(':id', $room, PDO::PARAM_INT);
$stmt->execute();
$room = $stmt->fetchObject();
echo '<h2>' . $room->room . '</h2>';

$calendar->CreateDatepicker(10);
echo'<form action="rbdetails.php" method="POST">
<input type="hidden" name="room" value="' .$room->id .'">
<div id="CreatePreviousMonth" class="col-md-4">';
$calendar->CreatePreviousMonth($room);
echo'</div><div id="CreateMonth" class="col-md-4">';
$calendar->CreateMonth($room);
echo'</div><div id="CreateNextMonth" class="col-md-4">';
$calendar->CreateNextMonth($room);
echo'</div><input type="submit" value="Book Room"></form></div>';
}

    
    
    
    
  //guest details form  
    
    function GuestsForm() {
        
 if(isset($_POST['bookings']))
{
$bookings= $_POST['bookings'];
}
else
{
   
    die("Please go back and choose some dates <a href='index.php'>Return</a>");
    
}
        
  echo   '<table>
<form action="roomsdatabase.php" method="POST">
<tr><td> First Name:</td><td><input type="text" name="firstName" value=""></td></tr>
<tr><td>Surname:  </td><td>  <input type="text" name="surname" value=""></td></tr>
<tr><td>Email: </td><td> <input type="text" name="email" value="" ></td></tr>
<tr><td>Telephone:  </td><td><input type="text" name="phone" value=""  disabled></td></tr>    
<tr><td>Address (line 1): </td><td> <input type="text" name="address1" value=""  disabled></td></tr>
<tr><td>Address (line 2):</td><td><input type="text" name="address2" value=""  disabled></td></tr>
<tr><td>Address (line 3):</td><td><input type="text" name="address3" value=""  disabled></td></tr>
<tr><td>Town\City: </td><td><input type="text" name="city" value=""  disabled></td></tr>
<tr><td>Province: </td><td><input type="text" name="province" value=""  disabled></td></tr>
<tr><td>PostCode:</td><td><input type="text" name="postCode" value=""  disabled></td></tr>
<tr><td>Country: </td><td><select name="country"  disabled>
<option value="">Country...</option>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D\'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select></td></tr>';
      foreach($bookings as $booking)
                                 { 
      echo '<input type="hidden" name="bookings[]" value="' .$booking.'">'; 
                                   } 
$room= $_POST['room'];
echo '<input type="hidden" name="room" value="' .$room.'">';
     echo '<tr><td><input type="submit" value="Send Details"></td><td></td></tr></form></table>';
    }
    
} 
?>
<?php 

    // session to get variables from index page
    session_start();
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
    
    <!-- font awsome link -->
    <script src="https://kit.fontawesome.com/bd91402b94.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="available_vehicle_styling.css">
    <!-- <link rel="stylesheet" href="new_index_styling.css"> -->
    <title>Advance Booking</title>
    
    <!-- styling for nav bar -->
    <style>  
      
      /* nav bar styling */
      .nav-bar {
          width: 100%;
      }
      
      .nav-bar .nav-items {
          float: right;
          margin: .5rem 0;
      }
      
      .nav-bar .nav-items ul {
          display: inline;
          padding-inline: 1rem;
      }
      
      .nav-bar .nav-items a {
          text-decoration: none !important;
          font-size: 1.5rem;
          color: #000;
          display: inline;
      }
      
      .nav-bar .nav-items ul i {
          font-size: 1.7rem;
      } 

      /* for results */
      .result{
        width: 100%;
        height: auto;
        box-shadow: 0 0 20px 0 rgba(218, 213, 215, 0.938);
        padding: 1rem;
        line-height: 1.6;
        letter-spacing: 1.3px;
        color: blue;
        margin-bottom: 3rem;
      }

      .result h1{
        font-size: 2.5rem;
        font-weight: 300;
      }

      .result h2{
        font-size: 2rem;
        font-weight: 250;
      }

      /* footer styling */

      footer {
          width: 100%;
          /* display: flex;
          flex-direction: row; */
          padding: 2rem;
          line-height: 4rem;
          letter-spacing: 2px;
          display: grid;
          grid-template-columns: 2fr 2fr 2fr;
          grid-template-rows: 1fr;
      }
      
      footer h3 {
          font-size: 2.5rem;
          font-weight: 500;
          margin-bottom: 2rem;
      }
      
      footer h4 {
          font-size: 1.5rem;
          font-weight: 400;
      }
      
      footer i {
          font-size: 1.5rem;
      }
      
      @media (max-width: 500px) {
          .instructions div button {
              font-size: 1.2rem;
          }
      
          footer div h3 {
              font-size: 1.8rem;
          }
      
          footer div h4,
          footer div i {
              font-size: 1rem;
          }
      }  
        
</style>

</head>
<body>

<div class="nav-bar">
        <div class="nav-items">
            <ul><i class="fa-solid fa-house-user fa-fade"></i> <a href="index.html">Home</a></ul>
            <ul><i class="fa-solid fa-phone fa-fade"></i> <a onclick="window.location = '#footer'">Reach us</a></ul>
            <ul><i class="fa-solid fa-lock fa-fade"></i> <a href="privacy_statements.html">Privacy Statements</a></ul>
            <ul><i class="fa-solid fa-circle-info fa-fade"></i> <a href="company_info.html">Company info</a></ul>
        </div>
    </div>

<!-- PHP code to fetch availability of vehicles from DB -->
<?php

// get user requirements from the index page
$rent_datetime = $_POST['rental-datetime'];
$return_datetime = $_POST['return-datetime'];
$vehicle_type = $_POST['vehicle-type'];

// in-case of empty input
if($rent_datetime == false || $return_datetime == false || $vehicle_type == false)
{
    echo "<script>
            alert('Please Choose Dates or Vehicle type');
            location.href = 'index.html';
         </script>";
}

// set the timezone first
if(function_exists('date_default_timezone_set'))
 {
    date_default_timezone_set("Asia/Kolkata");
 }

// if user chooses start date as a past date compared to todays / current date
$current_datetime = date("Y-m-d H:i:s");  // get curr date and time..
 
// include data_base connectivity single file
include("database_connection.php");

// query to get the user_id who returned the vehicle and delete from all tables to make the vehicle for futher use
$sql_query = "select user_id from booked_vehicles where recovery_date <= '$current_datetime';";
$response = $conn->query($sql_query);

while($row = $response->fetch_assoc()) // or $result->fetch_assoc()
{
    $user_id = $row['user_id'];  // got user_id delete related data from all the tables
    
    // query to delete from booked_vehicles
    $sql_query = "delete from booked_vehicles where user_id = '$user_id';";
    $a = $conn->query($sql_query);

    //query to delete from user_info
    $sql_query = "delete from user_info where user_id = '$user_id';";
    $a = $conn->query($sql_query);
    
    //query to delete from payment_details
    $sql_query = "delete from payment_details where user_id = '$user_id';";
    $a = $conn->query($sql_query);

}

if($rent_datetime < $current_datetime)
{
   echo "<script>
            alert('Past TimeLapse Never Came Back!..');
            location.href = 'index.html';
         </script>";
}

// if user choose rent date > recovery date
if($rent_datetime > $return_datetime){
  echo "<script>
            alert('Im-Proper Dates Selection!...');
            location.href = 'index.html';
         </script>";
}

// if user want vehicle for rent more than 7 days will be restricted
$start = new DateTime($rent_datetime);
$end = new DateTime($return_datetime);

// calculate diff between two time laps
$interval = $start->diff($end);

// calculates years and  days
$rent_year = $interval->format('%y');
$rent_days = $interval->format('%D');

// echo $rent_year."<br>";
// echo $rent_days;

if($rent_year >= 1 || $rent_days > '7')
{
       echo "<script>
             swal({
                title: 'Exceed TimeLapse',
                icon: 'warning',
                text: 'Service Limited to 7 days',
                }).then(function() {
                history.back();
                });
              </script>";
}

// create session vaiables
$_SESSION['rent_datetime'] = $rent_datetime;
$_SESSION['return_datetime'] = $return_datetime;

// include file having all images of vehicles
include('vehicle_images.php');

// query to fetch available vehicles as per required date and time

$sql_query = " with vehicle_type as 
                  (select * from booked_vehicles where vehicle_id like '$vehicle_type%'),
               unavailable_vehicles(vehicle_id, rental_date, recovery_date) as 
                  (select vehicle_id, rental_date, recovery_date from vehicle_type
                       where ('$rent_datetime' between rental_date and recovery_date) or
                       ('$return_datetime' between rental_date and recovery_date) or 
                       ('$rent_datetime' <= rental_date and '$return_datetime' >= recovery_date)),
               filtered_vehicle_info as 
                  (select * from vehicle_info where vehicle_id like '$vehicle_type%')

        select vi.vehicle_id as vehicle_id, vi.vehicle_name as vehicle_name, 
               vi.cost_hr as cost_hr, vi.cost_day as cost_day from 
               (unavailable_vehicles uv right join filtered_vehicle_info vi
               on uv.vehicle_id = vi.vehicle_id)
               where uv.vehicle_id is null ";

// execute the query
$response = $conn->query($sql_query);

// if no such vehicle found in that particular time travel
if($response->num_rows < 1)
{
  echo "<div class='result'>
        <h1> We are sorry!...</h1>
        <h2> No vehicle is available for your trip!...</h2>
        <h2> Please!..Try with some other time intervals!...</h2></div>";
}

echo "<div class = 'result'>
      <h1> GAADi ready!..</h1>
      <h2> Now book your GAADi and make a trip!..</h2> 
      </div> ";

// else there are vehicles for that interval
echo "<form action='user_info.php' method='post' class='available-vehicles'>";

while($row = $response->fetch_assoc()) // or $result->fetch_assoc()
{
    $image = $row['vehicle_id'];
    $vehicle_id = $image;
    $vehicle_name = $row['vehicle_name'];
    $cost_hr = $row['cost_hr'];
    $cost_day = $row['cost_day'];
    $i = $$image;

       echo" <div class='vehicle'>
               <img src=$i alt='Loading..' class='vehicle-img'>
                 <div class='vehicle-data'>
                   <h1>$vehicle_name</h1>
                   <h2>Rs.$cost_hr/hr</h2>
                   <h2>Rs.$cost_day/day</h2>
                   <button type='submit' name='vehicle_id' value=$vehicle_id >Book now</button>
                 </div>
             </div> ";

    //  $image = $row['vehicle_id'].' ';
    //  echo $row['vehicle_name'].' ';
    //  echo $row['cost_hr'].' ';
    //  echo $row['cost_day']. "<br> <br>";
    //  echo "";
}

echo "<form>";
?>

<footer id="footer">
        <div class="social-media">
            <h3>Follow us on</h3>
            <h4><i class="fa-brands fa-instagram fa-bounce"></i> Instagram</h4>
            <h4><i class="fa-brands fa-google fa-bounce"></i> Google</h4>
            <h4><i class="fa-brands fa-facebook-f fa-bounce"></i> facebook</h4>
            <h4><i class="fa-brands fa-youtube fa-bounce"></i> YouTube</h4>
            <h4><i class="fa-brands fa-twitter fa-bounce"></i> twitter</h4>
            <h4><i class="fa-brands fa-telegram fa-bounce"></i> telegram</h4>
        </div>
        <div class="about-us">
            <h3>About us</h3>
            <h4>Book your GAADi</h4>
            <h4>started in 2023</h4>
            <h4>we provide you </h4>
            <h4>fast and best serve</h4>
            <h4>expansional buniness</h4>
            <h4>trusted and most reviewed company</h4>
        </div>
        <div class="partners">
            <h3>Our partners</h3>
            <h4>TATA motors pvt.ltd</h4>
            <h4>A1 automobiles pvt.ltd</h4>
            <h4>ABC finance limiteds.</h4>
            <h4>XYZ automobile service providers..</h4>
        </div>
    </footer>
</body>
</html>
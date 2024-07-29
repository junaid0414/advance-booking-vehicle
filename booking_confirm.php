<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
</head>
<body>
</body>

<?php 
// start session
session_start();

// get data user data from sessions
$user_name = $_SESSION['user-name'];
$user_age = $_SESSION['user-age'];
$user_phno = $_SESSION['user-phno'];
$user_mail = $_SESSION['user-mail'];
$user_lisence = $_SESSION['user-lisence'];
$user_govtdoc = $_SESSION['govt-doc'];

// get db connection
include('database_connection.php');

// get back the vehicle id and the total paying amount from session
$vehicle_id = $_SESSION['vehicle_id'];
$total_amount = $_SESSION['total_amount'];
$rent_datetime = $_SESSION['rent_datetime'];
$return_datetime = $_SESSION['return_datetime'];

// let's create a user identity
$user_id = rand(10000, 99999);  // generates random integer it is consider as user_id

// insert user_id, vehicle_id, rental, recovery times into booked_vehicles table..
$sql_query = "insert into booked_vehicles(user_id, vehicle_id, rental_date, recovery_date) 
              values('$user_id', '$vehicle_id', '$rent_datetime', '$return_datetime')";

$conn->query($sql_query);  // to execute the query...

// insert user data into user_info table
$sql_query = "insert into user_info(user_id, user_name, user_age, user_phno, user_mail, user_lisence, user_govtdoc)
              values('$user_id', '$user_name', '$user_age', '$user_phno', '$user_mail', '$user_lisence', '$user_govtdoc')";

//excuete the query
$conn->query($sql_query);

// get card details for payment verification
$penalty = $total_amount * 0.0;
$card_name = $_POST['card-name'];
$card_number = $_POST['card-number'];
$card_month = $_POST['card-month'];
$card_year = $_POST['card-year'];
$card_cvv = $_POST['card-cvv'];

// insert payment related data into payment_details table..
$sql_query = "insert into payment_details(user_id, vehicle_id, card_name, card_number, card_month, card_year, card_cvv, total_amount, penalty, total_paid, payment_status)
              values('$user_id', '$vehicle_id', '$card_name', '$card_number', '$card_month', '$card_year', '$card_cvv', '$total_amount', '$penalty', '$total_amount' + '$penalty', '1')";

// execute the following query
$conn->query($sql_query);

echo "<script>
               swal({
                    title:'Payment Done!',
                    text: 'Thank you for Booking!.. Happy Journey!..',
                    icon: 'success',
                  }).then(function(){
                    window.location = 'index.html';
                  });
     </script>"; 
?>
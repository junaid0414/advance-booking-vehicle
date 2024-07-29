<?php 
// start session
session_start();

// get data from html form and create sesssion to them
$_SESSION['user-name'] = $_POST['user-name'];
$_SESSION['user-age'] = $_POST['user-age'];
$_SESSION['user-phno'] = $_POST['user-phno'];
$_SESSION['user-mail'] = $_POST['user-mail'];
$_SESSION['user-lisence'] = $_POST['user-lisence'];
$_SESSION['govt-doc'] = $_POST['govt-doc'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
  <link rel="stylesheet" href="style.css">

  <title>Advance Booking</title>
  <!-- script function to pop up the sweet alert on success booking -->
  <!-- <script>

    function book_now() { 

      // php insert all the data into the booked and payment details too 
    

    //   // start session
    //   session_start();

    //   // get data from html form
    //   $name = $_POST['user-name'];
    //   $age = $_POST['user-age'];
    //   $phno = $_POST['user-phno'];
    //   $mail = $_POST['user-mail'];
    //   $lisence = $_POST['user-lisence'];
    //   $govt_doc = $_POST['govt-doc'];
      
    //   // get db connection
    //   include('database_connection.php');
      
    //   // get back the vehicle id and the total paying amount
    //   $vehicle_id = $_SESSION['vehicle_id'];
    //   $total_amount = $_SESSION['total_amount'];
    //   $rent_datetime = $_SESSION['rent_datetime'];
    //   $return_datetime = $_SESSION['return_datetime'];

    //   // let's create a user identity
    //   $user_id = rand(10000, 99999);  // generates random integer it is consider as user_id
       
    //   // insert user_id, vehicle_id, rental, recovery times in booked_vehicles table
    //   $sql_query = "insert into booked_vehicles(user_id, vehicle_id, rental_date, recovery_date) 
    //                             values('$user_id', '$vehicle_id', '$rent_datetime', '$return_datetime')";
      
    //   $conn->query($sql_query);  // to execute the query...
      
    //   // get card details for payment verification
    //   $penalty = $total_amount * 0.0;
    //   $card_name = $_POST['card_name'];
    //   $card_number = $_POST['card_number'];
    //   $card_month = $_POST['card_month'];
    //   $card_year = $_POST['card_year'];
    //   $card_cvv = $_POST['card_cvv'];
      
    //   // query to store the payment details
    //   $sql_query = "insert into payment_details(user_id, vehicle_id, card_name, card_number, card_month, card_year, card_cvv, total_amount, penalty, total_payable, payment_status)
    //                        values('$user_id', '$vehicle_id', '$card_name', '$card_number', '$card_month', '$card_year', '$card_cvv', '$total_amount', '$penalty', '$total_amount' + '$penalty', '1')";
      
    //   // execute the following query
    //   $conn->query($sql_query);

      ?>
      
      // to notify user on success booking 
      swal({
        title:"Payment Done!",
        text: "Thank you for Booking!.. Happy Journey!..",
        icon: "success",
      }).then(function () {
        window.location = 'index.html';
      });

    } 
  </script> -->
</head>
<body>

<!-- payment -->
<div class="container"> 
    <form action="booking_confirm.php" method ="post">
        <div class="row">
            <!-- <div class="col">

                <h3 class="title">billing address</h3>

                <div class="inputBox">
                    <span>full name :</span>
                    <input type="text" placeholder="john deo">
                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" placeholder="example@example.com">
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" placeholder="room - street - locality">
                </div>
                <div class="inputBox">
                    <span>city :</span>
                    <input type="text" placeholder="mumbai">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>state :</span>
                        <input type="text" placeholder="india">
                    </div>
                    <div class="inputBox">
                        <span>zip code :</span>
                        <input type="text" placeholder="123 456">
                    </div>
                </div>

            </div> -->
            <div class="col">
                <h3 class="title">payment</h3>
                <div class="inputBox">
                    <span>cards accepted :</span>
                    <img src="images/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>name on card :</span> 
                    <input type="text" name="card-name" placeholder="mr. ganesh reddy">
                </div>
                <div class="inputBox">
                    <span>credit card number :</span>
                    <input type="number" name="card-number" placeholder="1111-2222-3333-4444">
                </div>
                <div class="inputBox">
                    <span>exp month :</span>
                    <input type="text" name="card-month" placeholder="january">
                </div>
                <div class="flex">
                    <div class="inputBox">
                        <span>exp year :</span>
                        <input type="number" name="card-year" placeholder="2022">
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" name="card-cvv" placeholder="XXX">
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" value="pay now" class="submit-btn">
        <input type="button" value="Cancel" class="submit-btn" style="float:right" onclick = "history.back()">
    </form>

</div>

</body>
</html>

      <!-- php insert all the data into the booked and payment details too

    //   // start session
    //   session_start();

    //   // get data from html form
    //   $name = $_POST['user-name'];
    //   $age = $_POST['user-age'];
    //   $phno = $_POST['user-phno'];
    //   $mail = $_POST['user-mail'];
    //   $lisence = $_POST['user-lisence'];
    //   $govt_doc = $_POST['govt-doc'];
      
    //   // get db connection
    //   include('database_connection.php');
      
    //   // get back the vehicle id and the total paying amount
    //   $vehicle_id = $_SESSION['vehicle_id'];
    //   $total_amount = $_SESSION['total_amount'];
    //   $rent_datetime = $_SESSION['rent_datetime'];
    //   $return_datetime = $_SESSION['return_datetime'];
      
    //   // let's create a user identity
    //   $user_id = rand(10000, 99999);  // generates random integer it is consider as user_id
      
    //   // insert user_id, vehicle_id, rental, recovery times in booked_vehicles table
    //   $sql_query = "insert into booked_vehicles(user_id, vehicle_id, rental_date, recovery_date) 
    //                             values('$user_id', '$vehicle_id', '$rent_datetime', '$return_datetime')";
      
    //   $conn->query($sql_query);  // to execute the query...
      
    //   // for late hand overing the vehicle...
    //   $penalty = $total_amount * 0.0;
      
    //   // query to store the payment details
    //   $sql_query = "insert into payment_details(user_id, vehicle_id, total_amount, penalty, total_payable, payment_status)
    //                        values('$user_id', '$vehicle_id', '$total_amount', '$penalty', '$total_amount' + '$penalty', '1')";
      
    //   // execute the following query
    //   $conn->query($sql_query);
    //   $conn->close(); // close the connections.. 
      
    //   echo "<script> alert('sotred!..') </script>;";

      // send a confirmatio mail to user
      // $subject = "Booking Confirmation";
      // $msg = "Thank You for booking!...Have a great ride!..";
      // $from = "ganeshreddy0616@gmail.com";
      // $headers = "From:".$from;
      
      // mail($mail, $subject, $msg, $headers);
      ?> -->
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
    <title>Advance Booking</title>

    <!-- font awsome link -->
    <script src="https://kit.fontawesome.com/bd91402b94.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="user_info_styling.css">

    <!-- js form form_validation -->
    <script>

        // function for valid
        function valid() {
            return is_valid;
        }

        //global variable
        is_valid = true;

        function form_validation() {
            // get values of inputs using id's..
            var name = document.getElementById('user-name').value;
            var age = document.getElementById('user-age').value;
            var phno = document.getElementById('user-phno').value;
            var mail = document.getElementById('user-mail').value;
            var lisence = document.getElementById('user-lisence').value;
            // alert(name + age + phno, lisence);

            // regular expressions..
            var namecheck = name.match(/^[A-Za-z ]{3,20}$/);
            var phnocheck = phno.match(/^(6|7|8|9)\d{9}$/);
            var mailcheck = mail.match(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/);
            var agecheck = age.match(/^[0-9]{2,3}$/);
            var lisencecheck = lisence.match(/^[a-zA-Z]{4,}$/);

            // disable the proceed at first
            document.getElementById('proceed-btn').disabled = true; // in form it self we can disable

            // test for validation..
            if (!namecheck) {
                document.getElementById('user-name-error').innerHTML = "**In valid value for NAME. (min-3 chars)";
                document.getElementById('success-msg').src = "error-msg.jpg";
                document.getElementById('success-msg').style = "width:2rem; height: 2rem";
                return false;
            } else {
                document.getElementById('user-name-error').innerHTML = "";
            }

            if (age < 18 || !agecheck || age > 120) {
                document.getElementById('user-age-error').innerHTML = "**In valid vlaue for AGE. (18 <= age <= 70)";
                document.getElementById('success-msg').src = "error-msg.jpg";
                document.getElementById('success-msg').style = "width:2rem; height: 2rem";
                return false;
            } else {
                document.getElementById('user-age-error').innerHTML = "";
            }

            if (!phnocheck) {
                document.getElementById('user-phno-error').innerHTML = "**In valid value for PH-No.";
                document.getElementById('success-msg').src = "error-msg.jpg";
                document.getElementById('success-msg').style = "width:2rem; height: 2rem";
                return false;
            } else {
                document.getElementById('user-phno-error').innerHTML = "";
            }

            if (!mailcheck) {
                document.getElementById('user-mail-error').innerHTML = "**In valid mail entry.";
                document.getElementById('success-msg').src = "error-msg.jpg";
                document.getElementById('success-msg').style = "width:2rem; height: 2rem";
                return false;
            } else {
                document.getElementById('user-mail-error').innerHTML = "";
            }

            if (!lisencecheck) {
                document.getElementById('user-lisence-error').innerHTML = "**In valid value for LISENCE.";
                document.getElementById('success-msg').src = "error-msg.jpg";
                document.getElementById('success-msg').style = "width:2rem; height: 2rem";
                return false;
            } else {
                document.getElementById('user-lisence-error').innerHTML = "";
            }

            if (is_valid) {  // if validated

                document.getElementById('success-msg').src = "success-msg.png"; // on valid info
                document.getElementById('success-msg').style = "width:3rem; height: 3rem";
                document.getElementById('proceed-btn').disabled = false; // now he can proceed
                return true;

            }
            else {
                document.getElementById('success-msg').innerHTML = '**';
                document.getElementById('proceed-btn').disabled = true;
                return false;
            }
        }

    </script>

    <!-- styling for payment display -->
    <style>
        .amount{
          box-shadow: 0 0 20px 0 rgba(200, 200, 200, 0.7);
          width: max-content;
          margin: 2rem;
          padding: 1rem;
          margin-top: 4rem;
        }

        .amount:hover{
           box-shadow: 0 0 20px 0 rgba(200, 200, 200, 0.99);
        }
        
        .amount h1{
          font-weight: 500;
          font-size: 2.5rem;
          margin:.4rem;
          color: #fff;
        }

        .amount h2{
            font-weight: 900;
            font-size: 3rem;
            margin:1rem;
            color: #fff;
        }

        /* footer styling */

       footer {
           width: 100%;
           /* color: #fff; */
           /* display: flex;
           flex-direction: row; */
           background: #fff;
           padding: 2rem;
           margin-top: 2rem;
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

    <!-- php file for calculating amount -->

    <?php 
    //  // inlcude sytling file
    //  echo "<link rel='stylesheet' href='user_info_styling.css'>";

     // include data-base connections
     include('database_connection.php');

     // vehicle id that user selected for booking
     $vehicle_id = $_POST['vehicle_id'];

     // query to get the vehicle name, price/hr, price/day
     $sql_query = "select vehicle_name, cost_hr, cost_day from vehicle_info 
                          where vehicle_id = '$vehicle_id'";
     
     // execute query
     $response = $conn->query($sql_query);
     $row = $response->fetch_assoc();
     
     // query response result
     $vehicle_name = $row['vehicle_name'];
     $cost_hr = $row['cost_hr'];
     $cost_day = $row['cost_day'];

     // get back rental and recovery date from session variables..
     $rent_datetime = $_SESSION['rent_datetime'];
     $return_datetime = $_SESSION['return_datetime'];
     
     $rent_datetime = new DateTime($rent_datetime);
     $return_datetime = new DateTime($return_datetime);

     $interval = $rent_datetime->diff($return_datetime);
    
    //  echo $interval->format('%Y years %m months %d days %H hours %i minutes %s seconds');

     $rent_days = $interval->format('%D');
     $rent_hrs = $interval->format('%H');
     $rent_min = $interval->format('%i');
     
    //  echo "days = ".$rent_days."<br>";
    //  echo "hrs = ".$rent_hrs."<br>";
    //  echo "min = ".$rent_min."<br>";

     if($rent_days < 1)
        $total_amount =  ($rent_hrs + $rent_min / 60) * $cost_hr;
     
     else
        $total_amount = ($rent_days + $rent_hrs / 24 + $rent_min / (24 * 60)) * $cost_day;
     
    
     // create session and store the vehicle id and total amount
     $_SESSION['vehicle_id'] = $vehicle_id;
     $_SESSION['total_amount'] = round($total_amount, 2);

     echo "<div class='amount'>
           <h1> Vehicle Model : $vehicle_name </h1>
           <h2> Total Charge : $total_amount /- </h2> </div>";
     
    ?>

     <!-- user basic information -->
     
     <div class="user-info-form">
            <!-- <img src="car-formalities.jpeg" alt="Loading.."> -->
            <div class="label">
                <p>Provide basic details and then proceed for booking</p>
            </div>
    
            <form action="payment.php" method="post">
                <label for="user-name">Name</label>
                <input type="text" name="user-name" id="user-name">
                <span id="user-name-error" class="text-danger"></span>

                <label for="user-age">Age</label>
                <input type="number" name="user-age" id="user-age">
                <span id="user-age-error" class="text-danger"></span>

                <label for="user-phno">Ph-no</label>
                <input type="tel" name="user-phno" id="user-phno">
                <span id="user-phno-error" class="text-danger"></span>

                <label for="user-mail">E-mail</label>
                <input type="email" name="user-mail" id="user-mail">
                <span id="user-mail-error" class="text-danger"></span>

                <label for="user-lisence">Lisence Id</label>
                <input type="text" name="user-lisence" id="user-lisence">
                <span id="user-lisence-error" class="text-danger"></span>

                <label for="govt-doc">Valid govt.doc</label>
                <input type="file" name="govt-doc" id="govt-doc">

                <div class="back-validate-btn">
                    <button onclick="history.go(-1)" id="back-btn">BACK</button>
                    <div class="span-validate-btn">
                        <!-- <span id="success-msg"></span> -->
                        <img src="error-msg.jpg" alt="Loading.." style="width:2rem; height:2rem" id="success-msg">
                        <button onclick="return form_validation();" id="validate-btn" type="button">VALIDATE</button>
                    </div>
                </div>
                <button type="submit" id="proceed-btn" disabled="disabled">PROCEED FOR PAYMENT</button>
                <!-- <input type="button" value="PROCEED FOR PAYMENT" id="proceed-btn"> -->
            </form>
        </div>
       
    </div>

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
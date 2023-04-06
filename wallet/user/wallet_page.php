<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./wallet_page.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title>Wallet</title>
  <!-- <script type="text/javascript" src="./script.js"></script> -->
</head>

<body>

  <?php
  $user_email = $_SESSION['email'];

  $conn = mysqli_connect("localhost:3306", "root", "", "wallet");
  $sql = "SELECT email,name,pin from user_details where email = '$user_email'";
  $result = mysqli_query($conn, $sql);

  $amount = "<div id='demo'></div>";
  $pin = '';
  $name = '';

  while ($info = mysqli_fetch_array($result)) {
    $pin = $info["pin"];
    $name = $info["name"];
  }

  if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
  } else {

    $stmt = $conn->prepare("insert into transactions(name, email, balance, pin) value(?,?,?,?)");


    $stmt->bind_param("ssii", $name, $user_email, $amount, $pin);
    $execval = $stmt->execute();
    // echo $execval;
    $stmt->close();
    $conn->close();
  }
  ?>

  <script>
    function widraw() {
      var a = document.getElementById("current_amount").textContent;
      var pin = prompt("Enter PIN");
      var user_pin = <?php echo "$pin" ?>;
      if (pin == user_pin) {
        var b = prompt("Enter Amount");
        a = parseInt(a);
        if (b <= a) {
          var d = parseInt(a) - parseInt(b);
          document.getElementById("current_amount").innerHTML = d;
          document.getElementById("demo").innerHTML = d;

          confirm("Transaction Sucessfull!");
        } else {
          alert("Enter Valid Amount!!");
        }
      } else {
        alert("Enter Valid Pin!!");
      }
    }

    function add() {
      var a = document.getElementById("current_amount").textContent;
      var pin = prompt("Enter PIN");
      var user_pin = <?php echo "$pin" ?>;
      if (pin == user_pin) {
        var b = prompt("Enter Amount");
        if (b < 1000000) {
          var d = parseInt(a) + parseInt(b);
          document.getElementById("current_amount").innerHTML = d;
          document.getElementById("demo").innerHTML = d;

          confirm("Transaction Sucessfull!");
        } else {
          alert("Enter Valid Amount!!");
        }
      } else {
        alert("Enter Valid Pin!!");
      }
    }
  </script>
  <div class="main_wallet">
    <div class="row">
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">Stark Wallet</a>
          </div>
          <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="#"><i class="glyphicon glyphicon-info-sign"></i> About Us</a>
            </li>
            <li>
              <a href="#"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="row">
      <div class="col-lg-4 profile">
        <div class="profile_head">
          <h3>USER</h3>
          <hr id="p_hr">
        </div>
        <div class="username">
          <img src="./../a.png" alt="">
          Tony Stark
        </div>
        <div class="details">
          <h4>Details</h4>
          <hr id="d_hr">
          <span>Email:</span>
          <span>Phone Number:</span>
          <span>DOB:</span>
          <span>Address:</span>
        </div>
        <div class="edit_btn">
          <button class="button" id="edit_button">EDIT</button>
        </div>
      </div>
      <div class="col-lg-7 wallet_balance">
        <span>
          <h3>BALANCE <?php $pin ?></h3>
        </span>
        <hr>
        <div class="balance">
          <span> Amount Avaliable </span>
          <div class="amount">
            <span>₹</span><span id="current_amount">70000</span>
          </div>
        </div>
        <div class="balance_buttons">
          <button class="button" onclick="widraw()"> Widraw Money</button>
          <button class="button" onclick="add()"> Add Money</button>

        </div>
      </div>
    </div>
    <div class="row">
      <div class="footer col-lg-12"> ©2023 Stark Wallet
      </div>
    </div>
  </div>
</body>

</html>
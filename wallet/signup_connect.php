<?php

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];
    $dob = $_POST['dob'];
    $pin = $_POST['pin'];
    $address = $_POST['address'];

    $conn = mysqli_connect("localhost:3306","root","","wallet");
    $sql = "select email from user_details where email = '$email'";
    $result = mysqli_query($conn,$sql);

    if($conn -> connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ".$conn->connect_error);
    }
    if(mysqli_num_rows($result)>0){
        echo "Email Already taken";
    }
    else{
        $stmt = $conn->prepare("insert into user_details(name,email,password,phone_no,dob,pin,address) value(?,?,?,?,?,?,?)");
        $stmt -> bind_param("sssisis",$name,$email,$password,$phone_number,$dob,$pin,$address);
        $execval = $stmt->execute();
        echo $execval;
        header("location: signin.html");
        $stmt->close();
        $conn->close();
    }
?>
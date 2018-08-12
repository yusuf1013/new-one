<?php
$servername = "localhost";
$username = "root";
$password = 12345;
$db="chat";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());

  
}
// let creat a message to display
$mess="";
//now that it connect let check the user input
if (isset($_POST["submit"])) {
//let get the input
$userfirst= mysqli_real_escape_string($conn, $_POST['first_name']);
$userlast= mysqli_real_escape_string($conn,$_POST['last_name']);
$userpass= mysqli_real_escape_string($conn,$_POST['password']);
$usermail= mysqli_real_escape_string($conn,$_POST['email']);
//let check if all the fill are set
if (empty($userfirst) || empty($userlast) || empty($userpass) || empty($usermail) ) {
     $mess="all the field have to be full";
     header("location:sigin.php");
     exit();
     //now let see if the first_name and the last name are correct
}else {
    if (!preg_match("/^[a-zA-Z ]*$/",$userfirst && !preg_match("/^[a-zA-Z ]*$/",$last_name))) {  
           $mess='firstname and last name can only be a letters';
        header("location:sigin.php");
     exit();
     //let check the email
    } else {
     if (!filter_var($usermail, FILTER_VALIDATE_EMAIL)) {
        $mess="please Enter a correct Email";
        header("location:Sig_up.php");
        exit();
     }else{
         //let hash the password
         $userpw= password_hash($userpass, PASSWORD_DEFAULT);
         //let put them in the table
         $query="INSERT INTO box(FirstName,LastName,Email,Password1) VALUES('$userfirst','$userlast','$usermail','$userpw')";
         if (mysqli_query($conn, $query)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        mysqli_close($conn);
     }
    }
    
}
}
?>
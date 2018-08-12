
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
         <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
  
    <?php include 'nav.php';?> 
    <!--my php-->
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
// let creat a message variable
$mess="";
//now that it connect let check the user input
if(filter_has_var(INPUT_POST, 'submit')) {
//let get the input
$userfirst= mysqli_real_escape_string($conn,$_POST["first"]);
$userlast= mysqli_real_escape_string($conn,$_POST['last']);
$userpass= mysqli_real_escape_string($conn,$_POST['password']);
$usermail= mysqli_real_escape_string($conn,$_POST['email']);
//let check if all the fill are set
if (empty($userfirst) || empty($userlast) || empty($userpass) || empty($usermail) ) {
     $mess="all the field have to be full";
     /*header("location:sigin.php");
     exit();*/
     //now let see if the first_name and the last name are correct
}else {
    if (!preg_match("/^[a-zA-Z ]*$/",$userfirst) && !preg_match("/^[a-zA-Z ]*$/",$lastname)) {  
           $mess='firstname and last name can only be a letters';
      /*  header("location:sigin.php");
     exit();*/
     //let check the email
    } else {
     if (!filter_var($usermail, FILTER_VALIDATE_EMAIL)) {
        $mess="please Enter a correct Email";
       /* header("location:sigin.php");
        exit();*/
     } else {
       //let see if there is someone who alredy use this username
       $query="SELECT * FROM box WHERE Email ='$usermail'";
		            $result=mysqli_query($conn,$query);
		            $resultchek=mysqli_num_rows($result);
		              //when we have alredy the uses
		             if ($resultchek>0) {
                   $mess='Someone alredy have this usermane';
                 }
			         
    
     else{
         //let hash the password
         //$userpw= password_hash($userpass, PASSWORD_DEFAULT);
         //let put them in the table
         $query="INSERT INTO box(FirstName,LastName,Email,Password1) VALUES('$userfirst','$userlast','$usermail','$userpass')";
         if (mysqli_query($conn, $query)) {
           header('Location:login.php');
           exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        mysqli_close($conn);
     }
    }
    
}
}
}
?>

    <!--endof php-->


     <!--sigin-->
      <div class="container">
        <div class="row"> 
    <div class="col s12 m12 l12 xl12">
      <div class="card ">

        <div class="card-image">
          <img  width="200" src="yusuf/hello.jpg">
          <h4 class="card-title"><span class="blue">SIGIN</span></h4>
        </div>
        <div class="card-content">
          
  <div class="row">
    <form class="col s12" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
   
      <div class="row">
        <div class="input-field col s12">
          <input  id="first_name" type="text" class="blue" name="first">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s12">
          <input id="last_name" type="text" class="blue" name="last">
          <label for="last_name">Last Name</label>
        </div>
      </div>
    
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="blue" name="password">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="blue" name="email">
          <label for="email">Email</label>
        </div>
      </div>
      
      </div>
      <?php if (!$mess==''):?>
    <h5 class="red-text"> <?php echo $mess;?> </h5>
      <?php endif; ?></br>
          <button class=" btn waves-effect blue"  name="submit">Submit
    <i class="material-icons right">send</i>
      </button>
        
    </form>
  </div>
 
        
      
      </div>
    </div>
  </div>
</div>
 

  
  <!--endofsigin-->
  <?php include "footer.php";?>

    
    </body>
  </html>
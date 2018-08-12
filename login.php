
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
<?php include "nav.php";?>
<!-- my php-->
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

//now that it connected let check the user input
//the message wchich will be display
$mess='';
if(filter_has_var(INPUT_POST, 'submit')) {
//let get the input
$userpass= mysqli_real_escape_string($conn,$_POST['password']);
$usermail= mysqli_real_escape_string($conn,$_POST['email']);
//now let see if there existe in the database
  
$query="SELECT * FROM box WHERE Email='$usermail' And Password1='$userpass'";
$result=mysqli_query($conn, $query);
if ($row=$result->fetch_assoc()) {
   header('Location:index.php');
   exit();
}
else{
	$mess='your password or username is wrong';}



}
?>


<!---endof php-->

      <div class="container" id="there"  >
        <div class="row"> 
    <div class="col s12 m4 l8">
      <div class="card ">
        <div class="card-image">
          <img  width="200" src="yusuf/hello.jpg" class="responsive-img">
          <h4 class="card-title"><span class="blue">LOGIN</span></h4>
        </div>
        <div class="card-content">
          
  <div class="row">
    <form class="col s12"  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="blue" name='email'>
          <label for="email">Email</label>
        </div>
      </div>
      
      </div>
    
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="blue"  name="password" >
          <label for="password">Password</label>
        </div>
      </div>
      
      <?php if (!$mess==''):?>
    <h5 class="red-text"> <?php echo $mess;?> </h5>
      <?php endif; ?></br>

          <button class="btn waves-effect blue  btn-small" type="submit" name="submit">Submit
    <i class="material-icons right">send</i>
  </button>
        
    </form>
  </div>
 
        
      
      </div>
    </div>
  </div>
</div>
 
<?php include "footer.php";?>
  


  
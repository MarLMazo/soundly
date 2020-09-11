<?php include 'view/header.php'; 

  require_once "Models/Database.php";
  require_once "Models/logregModels/Account.php";

  //connect to db and initialize class
  $dbconn = Database::getDb();
  $app = new Account();

  $id = $_SESSION['id'];
  //grab user details
  $user = $app->UserDetails($_SESSION['id']); 
  //$user = $app->UserDetails($id, $dbconn); // get user details


    if($user){
         //echo "Got user info!";
    } else {
        // echo "Problem getting user";
    }

?>


        <h1 class="hidden">Main Page</h1>

      <div class="row row-main">

        <div class="col-md-12">
          <img class="img-fluid" src="images/banner-top.jpg" alt="Banner">
          <div class="carousel-caption">
            <h2>Hey <?php echo $user->first_name . " " . $user->last_name ?>!</h2>
            <h3>Welcome to Soundly!</h3>
          </div>
        </div>
      </div>
      <div class="row row-main">
        <div class="row-main-col">
          <img src="images/banner-left.jpg" alt="">
          <h3>my Music Library</h3>
        </div>
        <div class="row-main-col">
          <img src="images/banner-right.jpg" alt="">
          <h3>my Music Library</h3>
        </div>
      </div>
      
      <br>View <a href="userProfile.php"> Profile</a>


<?php include 'view/footer.php'; ?>

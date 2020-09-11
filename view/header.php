<?php require_once "./Models/Database.php";
      require_once "./Models/Album.php";


    //starts session for website
    session_start();


    //when user clicks the logout button the session is unset and they are redirected to main page
    if (isset($_POST['logoutbutton'])) {

      // Destroys user session
      unset($_SESSION['id']);

      // Redirect to login index.php page
      header("Location: index.php");

  }


  //if the username is not set then it redirects to the login/index page. REGISTRATION AND LOGIN IS REQUIRED.
  if (!isset($_SESSION['id'])) {

    header("Location: index.php");

  }


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Soundly</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.css" rel="stylesheet"/>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/player.css">
  <link rel="shortcut icon" href="images/favicon.ico" />

</head>

<body>
  <!-- Vertical navigation -->
  <nav id="sidebar" class="vertical-nav">
    <div class="logo py-4 px-20 mb-4">
      <div class="">
        <a href="main.php">
          <img src="images/logo-green.png" alt="Logo" class="mr-3">
        </a>
        <h4>Dashboard</h4>
      </div>
    </div>
    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="main.php" class="nav-link text-dark bg-light img-fluid">
          <img src="images/icon-1.png" alt="Main icon" />
          <span class="text-padding">Main</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="library.php" class="nav-link text-dark bg-light img-fluid">
          <img src="images/icon-2.png" alt="Main icon" />
          <span class="text-padding">Music Library</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="playlists.php" class="nav-link text-dark bg-light img-fluid">
          <img src="images/icon-3.png" alt="Main icon" />
          <span class="text-padding">Playlists</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="albums.php" class="nav-link text-dark bg-light img-fluid">
          <img src="images/icon-4.png" alt="Main icon" />
          <span class="text-padding">Albums</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="lyrics.php" class="nav-link text-dark bg-light img-fluid">
          <img src="images/icon-5.png" alt="Main icon" />
          <span class="text-padding">Lyrics</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="account.php" class="nav-link text-dark bg-light img-fluid">
          <img src="images/icon-6.png" alt="Main icon" />
          <span class="text-padding">My Account</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="subscribe.php" class="nav-link text-dark bg-light img-fluid">
          <img src="images/icon-7.png" alt="Main icon" />
          <span class="text-padding">Subscribe</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="feedback.php" class="nav-link text-dark bg-light img-fluid">
          <img src="images/icon-8.png" alt="Main icon" />
          <span class="text-padding">Feedback</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="contact.php" class="nav-link text-dark bg-light img-fluid">
          <img src="images/icon-9.png" alt="Main icon" />
          <span class="text-padding">Contact Us</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="faq.php" class="nav-link text-dark bg-light img-fluid">
          <img src="images/icon-10.png" alt="Main icon" />
          <span class="text-padding">FAQ</span>
        </a>
      </li>
    </ul>
  </nav>

  <!-- header -->


  <header id="header">
    <div class="wrapper page-wrapper">





      <!-- <div class="">
        <div class="col-md-offset-5 profile-pic">
          <img src="images/profile-picture.png" alt="Profile Picture">
        </div>
        <div class="float-right profile-user">
          <a href="#"><span>Emma Rae</span></a>
          <a href="#">Premium User</a>
        </div>
      </div> -->
      <!-- Toggle button -->
      <button id="sidebarCollapse" type="button" class="btn btn-success px-4 mb-4">
        <i class="fa fa-chevron-left"></i>
      </button>
      <div class="w-25 form-group" id="searchbar">
        <form action="" method="post">
          <span class="image-inside"><img class="" id="search" src="images/search.png" alt="Search"></span>
          <input class="search-box form-control" type="text" name="search" placeholder="Search for music here ...">
          <input class="d-none" type="submit" name="submitSearch">
        </form>

        <!--LOGOUT BUTTON-->
        <form action="" method="POST">
          <button class="btn btn-success" id="logoutbutton" type="submit" name="logoutbutton" value="logoutbutton" >Logout</button>
        </form>

      </div>
    </div>
    </header>


    <main>
      <div class="wrapper page-wrapper">
      <section class="container-fluid">

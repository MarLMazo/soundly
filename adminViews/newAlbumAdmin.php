<?php include 'adminView/header.php';
// link the classes inside the models folder to be initialized
  require_once "../Models/Database.php";
  require_once "../Models/Album.php";
  // initialize the database connection
    $dbconn = Database::getDb();
    // initialize an album object
    $album = new Album();
    //create variables for user details
    $title = $artist = $genre = $year_published = "";

    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $artist = $_POST['artist'];
        $genre = $_POST['genre'];
        $year_published = $_POST['year'];
        $cover_path = 'images/covers/'.$title.'.jpg';


        //check if variables are empty
        //do more validation later
        // if($title == "" || $artist == "" || $genre == "" || $year_published == ""){
        //     echo "The field is required";
        // }
        // //if okay add to table
        // else{

            $newAlbum = $album->addAlbum($title, $artist, $genre, $cover_path, $year_published, $dbconn);
            if($newAlbum){
              echo '<h3>Added to the db</h3>';
            }else{
              echo '<h3>Problem </h3>';
            }
        // }
      }
?>
<h1>New<small> Album</small></h1>
<div class="form-group w-50">

  <form action="" method="post">
    <label for="title">Title:</label>
    <input class="form-control mt-3" type="text" name="title" id="title">
    <label for="artist">Artist:</label>
    <input class="form-control mt-3" type="text" name="artist" id="artist">
    <label for="year">Year Published:</label>
    <input class="form-control mt-3" type="text" name="year" id="year">
    <label for="genre">Genre:</label>
    <input class="form-control mt-3" type="text" name="genre" id="genre">

    <button class="btn btn-default rounded-btn my-5" type="submit" name="submit">+ Add</button>
  </form>

</div>




<?php include 'adminView/footer.php'; ?>

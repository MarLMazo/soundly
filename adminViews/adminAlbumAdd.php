<?php ob_start(); ?>
<?php include 'adminView/header.php'; ?>
<?php
// link the classes inside the models folder to be initialized
  require_once "../Models/Database.php";
  require_once "../Models/Album.php";
  require_once "../Models/Artist.php";
  require_once "../Models/Genre.php";
  // initialize the database connection
    $dbconn = Database::getDb();
    // initialize an album object
    $album = new Album();
    //initialize the artist object
    $artist = new Artist();
    //initialize the genre object
    $genre = new Genre();

    $artists = $artist->listArtists($dbconn);
    $genres = $genre->listGenres($dbconn);
    //create variables for user details
    $title = $artist = $genre = $year_published = "";

    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $artist = $_POST['artist'];
        $genre = $_POST['genre'];
        $year_published = $_POST['year'];
        $cover_path = 'images/covers/'.$title.'.jpg';


        // check if variables are empty
        // do more validation later
        if($title == "" || $artist == "" || $genre == "" || $year_published == ""){
            echo "The field is required";
        }
        //if okay add to table
        else{
          $newAlbum = $album->addAlbum($title, $artist, $genre, $cover_path, $year_published, $dbconn);
          header('Location: adminAlbumList.php');
        }
      }
?>

<h1>New<small> Album</small></h1>
<div class="form-group w-50">

  <form action="" method="post">
    <div class="row">
      <div class="col-lg-12">
        <label for="title">Title:</label>
        <input class="form-control mt-3" type="text" name="title" id="title">
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="artist">Artist:</label>
          <select class="form-control" id="artist" name="artist">
            <?php foreach ($artists as $artist): ?>
              <option value="<?= $artist->id; ?>"><?= $artist->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="genre">Genre:</label>
          <select class="form-control" id="genre" name="genre">
            <?php foreach ($genres as $genre): ?>
              <option value="<?= $genre->id; ?>"><?= $genre->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-lg-12">
        <label for="year">Year Published:</label>
        <input class="form-control mt-3" type="text" name="year" id="year">
      </div>
    </div>

    <button class="btn btn-default rounded-btn my-5" type="submit" name="submit">+ Add</button>
  </form>

</div>
<div class="mt-4">
    <a href="adminAlbumList.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to Albums</a>
</div>




<?php include 'adminView/footer.php'; ?>

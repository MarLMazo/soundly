<?php include 'adminView/header.php';
// link the classes inside the models folder to be initialized
  require_once "../Models/Database.php";
  require_once "../Models/Album.php";
// initialize the database connection
  $dbconn = Database::getDb();
  // initialize an album object
  $album = new Album();
// if the user searches using the serahc bar at the top
  if(isset($_POST['submitSearch'])){
    // save the search query in a format to be used in the query
    $searchKey = "%{$_POST['search']}%";
    // trigger relevant data using the function below
    $albums =  $album->searchAlbums($searchKey, $dbconn);
    // if not, list all of the albums
  }else{
    $albums =  $album->getAlbums($dbconn);
  }

 ?>
<h1>Discover <small>Albums</small></h1>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
<!-- loop through the albums and get data from the database -->
  <?php foreach($albums as $album){ ?>
    <div class="col mb-4">
      <!-- url of the requested album to get the details of it -->
      <a href="../album.php?id=<?= $album->id ?>">
        <div class="card card-cover shadow-lg">
          <!-- image path for the covers based on the path saved in the database -->
          <img src="<?= '../'.$album->cover_path ?>" class="card-img-top" alt="Cover image"/>
          <div class="card-body">
            <h5 class="card-title"><?= $album->title ?></h5>
            <p class="card-text"><?= $album->artist ?></p>
          </div>
        </div>
      </a>
    </div>
  <?php } ?>

</div>
<?php include 'adminView/footer.php'; ?>

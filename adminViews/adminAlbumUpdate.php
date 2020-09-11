<?php ob_start(); ?>
<?php
    require_once '../Models/Database.php';
    require_once '../Models/Album.php';
    require_once '../Models/Artist.php';
    require_once '../Models/Genre.php';
    require_once 'adminView/header.php';

if(isset($_GET['id'])){
  // initialize the database connection
    $dbconn = Database::getDb();
    // initialize an album object
    $al = new Album();
    //initialize the artist object
    $ar = new Artist();
    //initialize the genre object
    $ge = new Genre();
    //Get the id in get request
    $id = $_GET['id'];

    //for selected artists and $genres
    $selectedAlbum = $al->getAlbum($id, $dbconn);
    $artistId = $selectedAlbum->artist;
    $genreId = $selectedAlbum->genre;

    $selectedArtist = $ar->getArtist($dbconn,$artistId);
    $selectedGenre = $ge->getGenre($dbconn, $genreId);


    $albumId = $al->getAlbumById($id, $dbconn);
    $artists = $ar->listArtists($dbconn);
    $genres = $ge->listGenres($dbconn);

    //User clicks the submit button in Update
    if(isset($_POST['submit'])){

        $title = $_POST['title'];
        $artist = $_POST['artist'];
        $genre = $_POST['genre'];
        $year_published = $_POST['year'];
        $cover_path = 'images/covers/'.$title.'.jpg';

        $al->updateAlbum($id, $title, $artist, $genre, $cover_path, $year_published, $dbconn);
        header('Location: adminAlbumList.php');
    }
}
?>

    <h1>Update<small> Album</small></h1>
    <div class="form-group w-50">

      <form action="" method="post">
        <div class="row">
          <div class="col-lg-12">
            <label for="title">Title:</label>
            <input class="form-control mt-3" type="text" name="title" id="title" value="<?= $albumId->title; ?>">
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="artist">Artist:</label>
              <select class="form-control" id="artist" name="artist">
                <?php foreach ($artists as $artist): ?>
                  <option selected="<?= $selectedArtist->id; ?>" value="<?= $artist->id; ?>"><?= $artist->name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="genre">Genre:</label>
              <select class="form-control" id="genre" name="genre">
                <?php foreach ($genres as $genre): ?>
                  <option selected="<?= $selectedGenre->id; ?>" value="<?= $genre->id; ?>"><?= $genre->name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-lg-12">
            <label for="year">Year Published:</label>
            <input class="form-control mt-3" type="text" name="year" id="year" value="<?= $albumId->year_published ?>">
          </div>
        </div>
        <button class="btn btn-default rounded-btn my-5" type="submit" name="submit">&uarr; Update</button>
      </form>

    </div>

    <div class="mt-4">
        <a href="adminAlbumList.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to List</a>
    </div>

<?php

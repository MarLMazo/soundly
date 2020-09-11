<?php require_once 'adminView/header.php';?>
<?php

    require_once '../Models/Database.php';
    require_once '../Models/Album.php';

    //Get Database Connection
    $dbconn = Database::getDb();
    $al = new Album();

    if(isset($_POST['submitSearch'])){
      // save the search query in a format to be used in the query
      $searchKey = "%{$_POST['search']}%";
      // trigger relevant data using the function below
      $albums =  $al->searchAlbums($searchKey, $dbconn);
      // if not, list all of the albums
    }else{
      $albums =  $al->getAlbums($dbconn);
    }
?>

    <h1>List of Albums</h1>
    <!-- MUSIC/ SONG INFORMATION  -->
    <table class="table table-borderless table-hover text-center my-5">
        <thead>
            <tr class="text-uppercase">
                <th class="text-center">#</th>
                <th class="text-center">Thumbnail</th>
                <th class="text-center">Title</th>
                <th class="text-center">Artist</th>
                <th class="text-center">Genre</th>
                <th class="text-center">Year</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach ($albums as $album): ?>
            <tr>
              <th scope="row"><?= $album->id; ?></th>

              <td class="text-center"><img class="albumArtwork" src="../<?= $album->cover_path ?>"></td>
              <td class="text-center"><?= $album->title ?></td>
              <td class="text-center"><?= $album->artist ?></td>
              <td class="text-center"><?= $album->genre ?></td>
              <td class="text-center"><?= $album->year_published ?></td>
              <td>
                <a class="btn rounded-btn btn-primary" href="adminAlbumUpdate.php?id=<?= $album->id ?>">Update</a>
                <a class="btn rounded-btn btn-primary" href="adminAlbumDelete.php?id=<?= $album->id ?>">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>

    </table>
    <a class="btn rounded-btn btn-success" href="adminAlbumAdd.php"> New Album </a>

<?php include 'adminView/footer.php'; ?>

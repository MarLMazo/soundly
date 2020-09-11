<?php ob_start(); ?>
<?php include 'view/header.php'; ?>

<?php
require_once "Models/Database.php";
require_once "Models/lyricModels/Lyrics.php";
require_once "Models/Song.php";

$dbconn = Database::getDb();
$lyrics = new Lyrics();
$song = new Song();

$ls = $lyrics->listLyrics($dbconn);

//if user searches for a song
if(isset($_POST['submitSearch'])){
    $searchKey = $_POST['search'];
    header('Location: lyricsShow.php?key='.$searchKey);
}
//if user the view lyric button for a song
if(isset($_POST['showLyric'])){
    $id = $_POST['lyricId'];
    header('Location: lyricsShow.php?id='.$id);
}
?>
        <div class="row py-2">
          <!-- LYRICS DIV -->
          <div class="col-md">
            <h1>Lyrics</h1>
              <p>Search for a song to get the lyrics!</p>
          </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>Song Title</th>
                        <th>Date Updated</th>
                        <th>Singer Name</th>
                        <th>Album</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    foreach ($ls as $l){?>
                        <tr>
                            <td><?php echo $l->title;?></td>
                            <td><?php echo $l->pub_date;?></td>
                            <td><?php echo $l->name;?></td>
                            <td ><form method="post" action="">
                                    <input type="text" value="<?php echo $l->lid?>" name="lyricId" hidden>
                                    <input type="submit" name="showLyric" value="View Lyrics" class="btn btn-info btn-sm"/>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>

                </table>
            </div>


<?php include 'view/footer.php'; ?>

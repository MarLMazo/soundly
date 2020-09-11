<?php ob_start(); ?>
<?php include 'adminView/header.php'; ?>
<?php
require_once "../Models/Database.php";
require_once "../Models/lyricModels/Lyrics.php";
require_once "../Models/Artist.php";
require_once "../Models/Song.php";

$dbconn = Database::getDb();
$lyrics = new Lyrics();
$songs = new Song();

$song = $songs->listSongs($dbconn);

if(isset($_POST['addLyric'])){
    $songName = $_POST['sName'];
    $lyric = $_POST['lyric'];
    $date = date("Y/m/d");
    echo $songName." ".$lyric." ".$date;
    $lyrics->addLyric($songName,$lyric,$date,$dbconn);
}
?>
    <!-- Title of the page -->
    <h1>Add Lyrics</h1>
    <!-- CONTAINER DIV FOR FEEDBACK FORM -->
    <form class="" action="" method="post">

            <div class="form-group">
                <label for="sName">Song Name:</label>
                <select class="form-control" name="sName">
                    <?php
                    foreach ($song as $s){?>
                        <option value="<?php echo $s->id;?>"><?php echo $s->title;?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

        <div class="form-group">
            <label for="lyric">Lyric</label>
            <textarea class="form-control" name="lyric" id="lyric" rows="10"></textarea>
        </div>
        <input class="btn btn-primary rounded-btn" type="submit" name="addLyric" value="Add" />
    </form>

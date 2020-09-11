<?php ob_start(); ?>
<?php include 'adminView/header.php'; ?>
<?php //include "feedback-Script.php"?>

<?php

require_once "../Models/Database.php";
require_once "../Models/lyricModels/Lyrics.php";
require_once "../Models/Song.php";

$dbconn = Database::getDb();
$lyric = new Lyrics();

$id = $_GET['id'];



//create variables for user details
$l = $lyric->listOneLyric($id,$dbconn);

if(isset($_POST['updateLyric'])){

    //FILL THESE FIELDS OUT LATER
    $ls = $_POST['lyric'];
    $date = date("Y/m/d");
    //validate for errors
    if($id == null || $id == ""){

    }
    //if correct go ahead
    else{
        //comment out for now
        $lyric->updateLyric($id,$date,$ls,$dbconn);
    }
}
?>
<!-- Title of the page -->
<h1>Update Lyrics for <?php echo $l[0]->songtitle;?></h1>
<!-- CONTAINER DIV FOR FEEDBACK FORM -->
<form class="" action="" method="post">
    <div class="row">
        <div class="form-group col">
            <label for="sName">Song Name:</label>
            <input type="text" name="sName" id="sName" class="form-control" aria-describedby="helpId" value="<?php echo $l[0]->songtitle;?>" readonly>
            <small id="helpId" class="text-muted">Song name cannot be changed</small>
        </div>
        <div class="form-group">
            <label for="artist">Artist: </label>
            <input type="text" name="artist" id="artist" class="form-control" aria-describedby="helpId" value="<?php echo $l[0]->artistname;?>" readonly>
            <small id="helpId" class="text-muted">Artist for this song</small>
        </div>
    </div>
    <div class="form-group">
        <label for="lyric">Lyric</label>
        <textarea class="form-control" name="lyric" id="lyric" rows="10"><?php echo $l[0]->lyric;?></textarea>
    </div>
    <input class="btn btn-primary rounded-btn" type="submit" name="updateLyric" value="Update" />
</form>
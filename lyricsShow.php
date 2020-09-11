<?php ob_start(); ?>
<?php include 'view/header.php'; ?>

<?php
require_once "Models/Database.php";
require_once "Models/lyricModels/Lyrics.php";

$dbconn = Database::getDb();
$lyrics = new Lyrics();

//get the id from the url and search for that lyric
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $s = $lyrics->listOneLyric($id,$dbconn);

}
//get the key and search for that songs lyric
if(isset($_GET['key'])){
    $searchKey = "%{$_GET['key']}%";
    $s = $lyrics->getOneLyric($searchKey,$dbconn);
}
//user can search when in this view
if(isset($_POST['submitSearch'])){
    $searchKey = $_POST['search'];
    header('Location: lyricsShow.php?key='.$searchKey);
}
?>
<div class="row py-2">
    <!-- LYRICS DIV -->
    <div class="col-md">
        <h1><?php echo $s[0]->songtitle;?></h1>
        <p class="text-muted">Updated: <?php echo $s[0]->ddate;?></p>
        <p><?php
            if($s[0]->lyric == null){
                echo "Lyrics are not avalible yet.";
            }else{
                echo $s[0]->lyric;
            }

            ?></p>
    </div>
    <!-- END LYRICS DIV -->
    <!-- TRACK INFORMATION DIV -->
    <div class="col-md-5">
        <!-- ARTIST INFORMATION -->
        <div class="card">
            <h2 class="card-header">Artist</h2>
            <!-- CARD BODY -->
            <div class="card-body">
                <h2><?php echo $s[0]->artistname;?></h2>
                <img src="<?php echo $s[0]->coverpath;?>" class="img-responsive">

            </div>
            <!-- END CARD BODY -->
        </div>
        <!-- END ARTIST INFORMAITON -->
        <!-- TRACK DETAILS -->
        <div class="card">
            <h2 class="card-header">Track Information</h2>
            <!-- CARD BODY -->
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Release Date: <p class="text-muted"><?php echo $s[0]->yyear;?></p>
                    </li>
<!--                    <li class="list-group-item">Publisher: <p class="text-muted">Big man Company</p>-->
<!--                    </li>-->
<!--                    <li class="list-group-item">Written by: <p class="text-muted">some other artists</p>-->
<!--                    </li>-->
                </ul>

            </div>
            <!-- END CARD BODY -->
        </div>
        <!-- END TRACK DETAILS -->
        <div>

        </div>
        <!-- END TRACK DETAILS -->
    </div>
    <!-- END TRACK INFORMATION DIV -->
</div>
<!-- END OF LYRICS CONTENT DIV -->


<?php include 'view/footer.php'; ?>

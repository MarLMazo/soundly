<?php ob_start(); ?>
<?php include 'adminView/header.php'; ?>
<?php
require_once "../Models/Database.php";
require_once "../Models/lyricModels/Lyrics.php";

$dbconn = Database::getDb();
$lyrics = new Lyrics();

$ls = $lyrics->listLyrics($dbconn);
$id = $_POST['lyricId'];
if(isset($_POST['updateLyric'])){

    if($id == null || $id == ""){

    }
    else{
        header("Location: AdminLyricupdate.php?id=".$id);
    }
}
if(isset($_POST['deleteLyric'])){
    if($id == null || $id == ""){

    }
    else{
        $lyrics->deleteLyric($id,$dbconn);
    }
}
?>
<div>
    <a href="AdminLyricAdd.php" class="btn btn-primary">Add Lyrics</a>
</div>
<h1>List of lyrics</h1>
<p class="text-muted">Click add to add lyrics to a song or edit previous lyrics.</p>
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th>Song Title</th>
            <th>Date Updated</th>
            <th class="w-25">Lyrics</th>
            <th >Singer Name</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($ls as $l){?>
            <tr>
                <td><?php echo $l->title;?></td>
                <td><?php echo $l->pub_date;?></td>
                <td class="w-25"><?php echo strip_tags($l->lyric);?></td>
                <td><?php echo $l->name;?></td>
                <td ><form method="post" action="">
                        <input type="text" value="<?php echo $l->lid?>" name="lyricId" hidden>
                        <input type="submit" name="updateLyric" value="Edit" class="btn btn-info btn-sm"/>
                        <input type="submit" name="deleteLyric" value="X" class="btn btn-danger rounded-btn btn-sm"/>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>

    </table>
</div>



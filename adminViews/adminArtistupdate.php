<?php
    ob_start();
    require_once '../Models/Database.php';
    require_once '../Models/Artist.php';
    require_once 'adminView/header.php';

    //Get Database connection
    $db=Database::getDb();
    $ar = new Artist();
    //Get the id in get request
    $id = $_GET['id'];
    //get specific artist
    $artist = $ar->getArtist($db,$id);

    //User clicks the submit button in Update
    if(isset($_POST['updateArtist'])){
        $name = $_POST['artistname'];
        $ar->updateArtist($db,$name,$id);
    }

?>

    <h1>Update Song</h1>
    <!--    Form to Update  Student -->
    <form action="" method="post">
        <div class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-2" for="artistname">Title :</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="artistname" id="artistname" value="<?= $artist->name; ?>"/>
                </div>
            </div>
            <div>
                <button type="submit" name="updateArtist" class="btn btn-primary float-right" id="btn-submit">Update Artist</button>
            </div>
        </div>

    </form>

    <div class="mt-4">
        <a href="adminArtistlist.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to List</a>
    </div>

<?php






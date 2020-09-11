<?php
    ob_start();
    require_once '../Models/Database.php';
    require_once '../Models/Song.php';
    require_once 'adminView/header.php';

    //Get Database connection
    $db=Database::getDb();
    $sg = new Song();

    //Get the list of albums and artists
    $albumlist = $sg->getAllAlbums($db);
    $artistlist = $sg->getAllArtists($db);

    //User submit button of Add form
    if(isset($_POST['addSong'])){
        //Get all the values
        $title = $_POST['songtitle'];
        $duration = $_POST['songduration'];
        $path = $_POST['songpath'];
        $artistid = (int)$_POST['songartist'];
        $albumid =(int)$_POST['songalbum'];

        //Error Handling, Check if values are empty
        if($title == '' || $duration == '' || $path == ''){
            $error = 'Please Enter Appropriate Details';
        } else{
            $sg->addSong($db,$title, $duration, $path, $artistid, $albumid);
        }
    }

?>
<h2>Add Song</h2>
<!--    Form to Update  Student -->
<form action="" method="post">
    <div class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-md-2" for="songtitle">Title :</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="songtitle" id="songtitle" <?php if(isset($error)){ echo 'style="border:1px solid red;"';} if(isset($title)){ echo 'value="'.$title.'"';}?> />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="songduration">Duration :</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="songduration" id="songduration" <?php if(isset($error)){ echo 'style="border:1px solid red;"';}  if(isset($duration)){ echo 'value="'.$duration.'"';}?> />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="songpath">Path :</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="songpath" id="songpath" <?php if(isset($error)){ echo 'style="border:1px solid red;"';}  if(isset($path)){ echo 'value="'.$path.'"';}?> />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2"  for="songartist"> Artist :</label>
            <div class="col-md-10">
                <select class=" form-control" name="songartist" id="songartist">
                    <?php
                    foreach ($artistlist as $artist){
                            print '<option value="'.$artist->id.'">'.$artist->name.'</option>';
                    }
                    ?>
                </select>
                <span>Artist not here? <a href="adminArtistadd.php">Add here</a></span>
            </div>

        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="songalbum"> Album :</label>
            <div class="col-md-10">
                <select class="form-control" name="songalbum" id="songalbum">
                    <?php
                    foreach ($albumlist as $album){
                            print '<option value="'.$album->id.'">'.$album->title.'</option>';
                    }
                    ?>
                </select>
                <span>Album not here? <a href="adminAlbumadd.php">Add here</a></span>
            </div>

        </div>
        <div>
            <button type="submit" name="addSong" class="btn btn-primary float-right" id="btn-submit">Add Song</button>
        </div>
        <span class="text-danger"><?php if(isset($error)){ echo $error;}?></span>
    </div>

    <div class="mt-4">
        <a href="adminLibrarylist.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to List</a>
    </div>


</form>

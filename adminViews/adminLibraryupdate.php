<?php
    ob_start();
    require_once '../Models/Database.php';
    require_once '../Models/Song.php';
    require_once 'adminView/header.php';

    //Get Database connection
    $db=Database::getDb();
    $sg = new Song();
    //Get Query String
    $id = $_GET['id'];
    //Get specific song
    $song = $sg->getSong($db,$id);
    //Get all the albums and artists
    $albumlist = $sg->getAllAlbums($db);
    $artistlist = $sg->getAllArtists($db);

    //User click Update Button
    if(isset($_POST['updateSong'])){
        //Get all the values
        $title = $_POST['songtitle'];
        $duration = $_POST['songduration'];
        $path = $_POST['songpath'];
        $artistid = $_POST['songartist'];
        $albumid = $_POST['songalbum'];

        $sg->updateSong($db, $title, $duration, $path, $artistid, $albumid, $id);

    }

?>

    <h1>Update Song</h1>
        <!--    Form to Update  Student -->
    <form action="" method="post">
        <div class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-2" for="songtitle">Title :</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="songtitle" id="songtitle" value="<?= $song->title; ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="songduration">Duration :</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="songduration" id="songduration" value="<?= $song->duration; ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="songpath">Path :</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="songpath" id="songpath" value="<?= $song->path; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2"  for="songartist"> Artist</label>
                <div class="col-md-10">
                    <select class="form-control" name="songartist" id="songartist">
                        <?php
                        foreach ($artistlist as $artist){
                            if($artist->id == $song->artist_id){
                                print '<option value="'.$artist->id.'" selected>'.$artist->name.'</option>';
                            }else{
                                print '<option value="'.$artist->id.'">'.$artist->name.'</option>';
                            }

                        }
                        ?>
                    </select>
                    <span>Artist not here? <a href="adminArtistadd.php">Add here</a></span>
                </div>


            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="songalbum"> Album</label>
                <div class="col-md-10">
                    <select class="form-control" name="songalbum" id="songalbum">
                        <?php
                        foreach ($albumlist as $album){
                            if($album->id == $song->album_id){
                                print '<option value="'.$album->id.'" selected>'.$album->title.'</option>';
                            }else{
                                print '<option value="'.$album->id.'">'.$album->title.'</option>';
                            }
                        }
                        ?>
                    </select>
                    <span>Album not here? <a href="adminAlbumadd.php">Add here</a></span>

                </div>

            </div>
            <div>
                <button type="submit" name="updateSong" class="btn btn-primary float-right" id="btn-submit">Update Song</button>
            </div>
        </div>

    </form>
    <div class="mt-4">
        <a href="adminLibrarylist.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to List</a>
    </div>

    <?php






<?php
    ob_start();
    require_once '../Models/Database.php';
    require_once '../Models/Artist.php';
    require_once 'adminView/header.php';

    //Get the database connection
    $db=Database::getDb();
    $ar = new Artist();

    //If button addSong is Click
    if(isset($_POST['addSong'])){
        $name = $_POST['artistname'];

        //Error Handling, Check if values are empty
        if($name == ''){
            $error = 'Please Enter Appropriate Details';
        } else{
            $ar->addArtist($db,$name);
        }
    }

?>
<h1>Add Artist</h1>
<!--    Form to Update  Student -->
<form action="" method="post">
    <div class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-md-2" for="artistname">Name :</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="artistname" id="artistname" <?php if(isset($error)){ echo 'style="border:1px solid red;"';} if(isset($name)){ echo 'value="'.$name.'"';}?>/>
            </div>
        </div>
        <div>
            <button type="submit" name="addSong" class="btn btn-primary float-right" id="btn-submit">Add Artist</button>
        </div>
        <span style="color: red"><?php if(isset($error)){ echo $error;}?></span>
    </div>

</form>
<div class="mt-4">
    <a href="adminArtistlist.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to List</a>
</div>

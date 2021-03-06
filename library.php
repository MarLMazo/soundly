<?php
    require_once 'Models/Database.php';
    require_once 'Models/Song.php';
    include 'view/header.php';

    //Create Database Connection
    $db=Database::getDb();
    $sg = new Song();

    //Initialize songIds for song
    //GLOBAL $songIds;
    $songIds = array();

    //Search button is click to search for specific song
    if(isset($_POST['submitSearch'])){
        $searchkey = "%".$_POST['search']."%";

        $songs =  $sg->search($db, $searchkey);
    }
    else{
        $songs = $sg->listSongs($db);
    }


?>

    <h1>My Music</h1>
    <!-- MUSIC/ SONG INFORMATION  -->
    <table class="table table-borderless table-hover text-center">
        <?php
        $i = 1;
        foreach ($songs as $m) {
        print '<tr>
                    <!-- THE NUMBER OF TRACK IN THE ALBUM -->
                    <th scope="row">'.$i.'</th>
                    <!-- PLAY BUTTON TO PLAY THE SONG -->
                    <td><button class="btn btn-link" onclick="setTrack('.$m->id.',tempSongIds,true);"><i class="fa fa-play-circle fa-3x"></i></button></td>
                    <!-- MUSIC/SONG INFORMATION GOES HERE -->
                    <td text-center>
                        <!-- SONG NAME -->
                       '.$m->title.'
                        <!-- ARTIST NAME -->
                        <p class="text-black-50">'.$m->name.'</p>
                    </td>
                    <!-- DURATION OF THE SONG -->
                    <td>'.$m->duration.'</td>
                </tr>';
        $i++;
        array_push($songIds, $m->id);
        }
        ?>

    </table>
    <script>
        //Get all the SongIds loaded
        var tempSongIds = <?php echo json_encode($songIds); ?>;
        //console.log(tempSongIds);
    </script>
 <?php


include 'view/footer.php';
?>

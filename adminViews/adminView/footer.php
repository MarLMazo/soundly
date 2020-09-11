<?php

if(isset($songIds) && ($songIds != null || $songIds == '')) {
    $lstsongs = json_encode($songIds);
}
?>

</section>
</div>
</main>
<footer id="player">
    <div class="nowPlaying wrapper page-wrapper d-flex justify-content-left">
        <!-- THE LEFT SIDE IS THE MUSIC/SONG INFORMATION -->
        <div class="left_player">
            <div class="music_content">
                <!-- MUSIC ALBUM IMAGE -->
                <div class="albumLink">
                    <img src="../images/covers/v.jpg" aria-label="Album Image" class="albumArtwork">
                </div>
                <!-- MUSIC INFORMATION -->
                <div class="trackInfo">
                    <!-- MUSIC TITLE -->
                    <div class="nowPlaying_title"></div>
                    <!-- MUSIC ARTIST -->
                    <div class="nowPlaying_artist"></div>
                </div>
            </div>
        </div>
        <!-- RIGHT SIDE IS THE USERS CONTROL OF THE MUSIC/SONG -->
        <div class="right_player">

            <div class="playerControls">
                <!-- PROGRESS BAR OF THE SONG -->

                <!-- CONTROLS OF THE SONG -->
                <div class="controlButtons">
                    <button class="btn btn-link controlButton previous" onclick="goBackSong();">
                        <img src="../images/forward.png" alt="Previous">
                    </button>
                    <button class="btn btn-link controlButton play" onclick="playSong();">
                        <img src="../images/play.png" alt="Play">
                    </button>
                    <button class="btn btn-link controlButton pause" onclick="pauseSong();">
                        <img src="../images/pause.png" alt="Pause">
                    </button>
                    <button class="btn btn-link controlButton next" onclick="goNextSong();">
                        <img src="../images/forward.png" alt="Next">
                    </button>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="../../script/js.js"></script>
<script src="../../script/main.js"></script>

<script>

    var currentPlaylist = [];
    var tempPlaylist = [];
    var audioElement;
    var currentIndex = 0;

    $(document).ready(function () {
        var newPlaylist = '<?php if(isset($listsongs)){echo $lstsongs;} ?>';
        console.log(newPlaylist);
        audioElement = new Audio();
        //setTrack(newPlaylist[0], newPlaylist, false);
    });

    <?php

    ?>
</script>
</body>

</html>

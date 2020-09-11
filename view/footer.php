<?php

if(isset($songIds)) {
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
                    <img src="images/covers/v.jpg" aria-label="Album Image" class="albumArtwork">
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
                    <button class="btn btn-link controlButton btn-hover previous" onclick="goBackSong();">
                        <img title="Previous Song" src="images/backward.png" alt="backward">
                    </button>
                    <button class="btn btn-link controlButton btn-hover play" onclick="playSong();">
                        <img title="Play" src="images/play.png" alt="play">
                    </button>
                    <button class="btn btn-link controlButton btn-hover pause" onclick="pauseSong();" style="display: none;">
                        <img title="Paused" src="images/pause.png" alt="pause">
                    </button>
                    <button class="btn btn-link controlButton btn-hover next" onclick="goNextSong(tempSongIds);">
                        <img title="Next Song" src="images/forward.png" alt="forward">
                    </button>
                    <button class="btn btn-link controlButton shuffle" onclick="setShuffleSong();">
                        <img title="Shuffle" src="images/shuffle.png" alt="shuffle">
                    </button>
                    <button class="btn btn-link controlButton repeat" onclick="setrepeatSong();">
                        <img title="Repeat" src="images/repeat.png" alt="repeat">
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
<script type="text/javascript" src="script/js.js"></script>
<script src="./script/main.js"></script>

<script>

    var audioElement;
    var currentIndex = 0;
    var repeat = false;
    var shuffleSong = false;
    var shufflePlaylist;

    console.log(tempSongIds);
    console.log(ShuffleArray(tempSongIds));
    $(document).ready(function () {
        audioElement = new Audio();
        audioElement.audio.addEventListener('ended',function(){
            goNextSong();
        })
    });

    <?php

?>
</script>
</body>

</html>

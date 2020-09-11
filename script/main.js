function Audio() {
    //Created a Class for Audio
    this.currentPlaying;
    this.audio = document.createElement('audio');
    //Set the data as the track and get the path of it
    this.setTrack = function(track) {
        this.currentPlaying = track;
        //console.log(track);
        this.audio.src = track.path;
    }
    //class to play audio
    this.play = function() {
        this.audio.play();
    }
    //pause the audio
    this.pause = function() {
        this.audio.pause();
    }
    //set the Time of the current audio
    this.setTime = function(seconds) {
        this.audio.currentTime = seconds;
    }
}

function pauseSong() {
    //Pause song and hide pause button and show play button
    $(".controlButton.play").show();
    $(".controlButton.pause").hide();
    audioElement.pause();
}

function playSong() {
    //Play song and hide pause button and show play button
    $(".controlButton.play").hide();
    $(".controlButton.pause").show();
    audioElement.play();
    //console.log("Music is playing");
}

//Set the Repeat to true if user click the repeat into true
function setrepeatSong(){
    repeat = !repeat;
    var imageName = repeat ? "repeat-active.png" : "repeat.png";
    $(".controlButton.repeat img").attr("src", "images/" + imageName);

}

function setTrack(trackId, newPlaylist, play) {

    //console.log(trackId);
    //Get the Index of the Playing Song
    currentIndex = newPlaylist.indexOf(trackId.toString());
    //console.log(currentIndex);

    //Get the handlers Values for Song
    $.post("handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {
        //console.log(data);
        //Put in a variable and encode it as a JSON file
        var track =  JSON.parse(data);
        $(".nowPlaying_title").text(track.title);
        //Get the handlers Values for Artist
        $.post("handlers/ajax/getArtistJson.php", { songId: trackId }, function(data) {
            var artist = JSON.parse(data);
            $(".nowPlaying_artist").text(artist.name);
        });
        //Get the handlers Values for Album
        $.post("handlers/ajax/getAlbumJson.php", { songId: trackId }, function(data) {
            var album = JSON.parse(data);
            //console.log(album);
           $(".albumLink img").attr("src", album.cover_path);
        });
        //Set the Track for the audioElement
        audioElement.setTrack(track);
        //PlaySong if third parameter is true
        if(play == true) {
            playSong();
        }
    });
}

function goNextSong() {
   if(repeat == true){
       console.log("REPEATING");
       audioElement.setTime(0);
       playSong();
       console.log("PLAYING");
       return;
   }
   if(shuffleSong){
       tempSongIds = shufflePlaylist;
       console.log('This is shuffled');
   }

  if(currentIndex == tempSongIds.length-1){
      //Goes back to the first index
      currentIndex = 0;
  }else{
      //Go to the next Index
     currentIndex++;
  }
    //Play The song
    setTrack(tempSongIds[currentIndex],tempSongIds, true);
}

function goBackSong() {
    //Index is the first index, it will go back to the same index
    if(currentIndex == 0){
        currentIndex = 0;
    }else{
        //It will subtract one in the currentIndex
        currentIndex--;
    }
    //Play the song
    setTrack(tempSongIds[currentIndex],tempSongIds, true);
}

//Setting the Player to shuffle
function setShuffleSong(){
    shuffleSong = !shuffleSong;
    var imageName = shuffleSong ? "shuffle-active.png" : "shuffle.png";
    $(".controlButton.shuffle img").attr("src", "images/" + imageName);

    if (shuffleSong == true){
        shufflePlaylist = ShuffleArray(tempSongIds);
        console.log('This set Shuffled');
        console.log(shufflePlaylist);
    }
    else{
        shufflePlaylist = tempSongIds;
    }
}

//Shuffling an array
function ShuffleArray(o) {
    for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
};


//Hover Effect for Player Footer
$('.btn-hover img').hover(
    function(){
        var val = $(this).attr('alt');
        console.log(val);
        $(this).attr('src','images/'+val+'-active.png')
    },
    function(){
        var val = $(this).attr('alt');
        $(this).attr('src','images/'+val+'.png')
    }
)
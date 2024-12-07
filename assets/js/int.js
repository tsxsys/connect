$(document).ready(function () {
    if ($('audio,video').length) {
        const players = Plyr.setup("#player",{
            clickToPlay: true
        });
        $(".ts__video_mod").on("hide.bs.modal",function (){
            players.forEach(function(player) {
                player.stop();
            });

        });
    }
});
<script src= "https://player.twitch.tv/js/embed/v1.js"></script>
<div id="player"></div>
<script type="text/javascript">
  var options = {
	    allowfullscreen : true,
        width: "100%",
        height: "100%",
        channel: "teguhwijiyanto2",
		controls: false,
    // only needed if your site is also embedded on embed.example.com and othersite.example.com
    parent: ["live.alterspace.gg", "live.alterspace.gg"]
  };
  var player = new Twitch.Player("player", options);
  player.setVolume(0.5);
</script>
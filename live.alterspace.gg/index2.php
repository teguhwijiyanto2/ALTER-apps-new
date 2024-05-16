<style>
.container {
  position: relative;
  /*max-width: 800px;*/ /* Maximum width */
  margin: 0 auto; /* Center it */
}

.container .content {
  position: absolute; /* Position the background text */
  bottom: 0; /* At the bottom. Use top:0 to append it to the top */
  background: rgb(0, 0, 0); /* Fallback color */
  background: rgba(0, 0, 0, 0.0); /* Black background with 0.5 opacity */
  color: #f1f1f1; /* Grey text */
  width: 100%; /* Full width */
  padding: 0px; /* Some padding */
}
</style>


<div class="container">
  <div id="player"></div>
  <div class="content">
    <h1>&nbsp;</h1>
    <p style='padding-left:20px;'>PLAYER1: Lorem ipsum ...</p>
	<p style='padding-left:20px;'>PLAYER2: Lorem ipsum ...</p>
	<p style='padding-left:20px;'>PLAYER3: Lorem ipsum ...</p>
	<p style='padding-left:20px;'>PLAYER4: Lorem ipsum ...</p>
	<p style='padding-left:20px;'>PLAYER5: Lorem ipsum ...</p>
	<p style='padding-left:20px;'>PLAYER6: Lorem ipsum ...</p>
	<p style='padding-left:20px;'>PLAYER7: Lorem ipsum ...</p>
	<p style='padding-left:20px;'>PLAYER8: Lorem ipsum ...</p>
	<p style='padding-left:20px;'>PLAYER9: Lorem ipsum ...</p>
	<p style='padding-left:20px;'>PLAYER10: Lorem ipsum ...</p>
  </div>
</div>




<script src= "https://player.twitch.tv/js/embed/v1.js"></script>

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
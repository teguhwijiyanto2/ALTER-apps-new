<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$result = DB::queryFirstRow("SELECT * FROM tournament where id=%i", $_GET['id']);

$teams = DB::query("SELECT * FROM tournament_teams where tournament_code=%s", $result['tournament_code']);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/theme.css" />
    <script src="js/script.js"></script>
    <title>Upload Result</title>
  </head>

  <body>
    <section>
      <div class="px-4">
        <div class="py-3">
          <a href="myorder.php">
            <i class="bi bi-x-lg fs-5 me-2"></i>
            <span>Upload Result</span>
          </a>
        </div>

<script>

function validate_1() {
	
	var is_error_exist = "N";

	if(document.getElementById("img-tournament").value == "") {
		document.getElementById("img-tournamentError").style.display = "block";
		is_error_exist = "Y";
	}
	else {
		document.getElementById("img-tournamentError").style.display = "none";
	}

	if(document.getElementById("wining").value == "") {
		document.getElementById("winingError").style.display = "block";
		is_error_exist = "Y";
	}
	else {
		document.getElementById("winingError").style.display = "none";
	}

	if(is_error_exist == "N") {
		document.getElementById('form').submit();
	}
	
} // function validate_1() {

</script>	

        <form action="upload-tournament-result.php" method="post" enctype="multipart/form-data" id="form">
          <input type="hidden" name="tid" value="<?php echo $_GET['id'] ?>" required>
          <div id="winingBox">
          <input type="hidden" id="wining" name="wining">
          </div>
          <!-- Summary Start -->
          <div class="p-3 bg-dark rounded-3">
            <h5>Winning Team</h5>
            <p class="text-secondary">Choose which one is the winning team</p>
            <?php 
            
            foreach($teams as $team){
              $players = DB::query("SELECT * FROM tournament_team_players where team_code=%s", $team['team_code']);
            
				  $team_logo = 'team_logo/default_team_logo.jpg';

				  if (!empty($team['team_logo'])) {
					$team_logo_path = 'team_logo/' . $team['team_logo'];
					
					if (file_exists($team_logo_path)) {
						$team_logo = $team_logo_path;
					}
				  }
  
            ?>
            <label
              class="position-relative text-start d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50 cursor__pointer"
              for="team1"
              id="winingPointer<?= $team['id'] ?>"
              onclick="winingCheck('<?= $team['id']?>')"
            >
              <img
                src="<?php echo $team_logo; ?>"
                width="48"
                height="48"
                class="object-fit-contain rounded-3"
              />
              <div class="w-75">
                <h6 class="mb-1"><?php echo $team['team_name'] ?></h6>
                <div class="text-secondary lh-1 fs-7">
                  <?php 
                    foreach($players as $player) {
                      echo $player['team_player_username'].", ";
                    }
                  ?>
                </div>
              </div>
              <h1 class="fs-3" id="trops<?= $team['id'] ?>" style="color:#BF40BF"></h1>
            </label>
            <?php } ?>
          </div>
		  <div class="text-error" id="winingError" style="display: none; color: red;">Winners is required!</div>
          <!-- Summary End -->

          <!-- Proof Start -->
          <div class="bg-dark rounded-3 p-3 mt-3">
            <h5>Proof</h5>
            <p class="text-secondary lh-sm">
              Upload a picture for the proof of winning, this would be confirmed
              by our internal team for a maximum of 1x24 hour
            </p>
            <div style="max-height: 500px; overflow-y: hidden">
              <label for="img-tournament" class="cursor__pointer">
                <img
                  id="img-preview"
                  name="image"
                  width="48"
                  height="48"
                  src="./assets/ilustration/ilus__plus.png"
                />
                <span id="name-img-preview" class="text-secondary"
                  >&nbsp; Upload picture</span
                >
                <input type="file" name="img-tournament" id="img-tournament" hidden required/>				
              </label>
            </div>
          </div>
		  <div class="text-error" id="img-tournamentError" style="display: none; color: red;">Proof picture is required!</div>
          <!-- Proof End -->

          <button
		    onclick="validate_1();"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Confirm
          </button>
        </form>
      </div>
    </section>

    <script>

      let wining = 1;
      $(document).ready(function () {
        $("#img-tournament").on("change", function (e) {
          var input = e.target;
          var reader = new FileReader();
          reader.onload = function () {
            $("#img-preview").attr("src", reader.result).css({
              width: "100%",
              height: "auto",
              objectFit: "contain",
            });
            $("#name-img-preview").text(input.files[0].name);
          };
          reader.readAsDataURL(input.files[0]);
        });
      });

      var winingArray = []; 

      function winingCheck(id){
        
        var index = winingArray.indexOf(id);
        if (index === -1 && wining <= 3) {
          winingArray.push(id);
          $("#trops"+id).text(wining)
          wining++
        } else {
          $("#trops"+id).text('')
          winingArray.splice(index, 1);
          wining--
        }
        $('#wining').val(winingArray.join(','));

      }
    </script>
  </body>
</html>

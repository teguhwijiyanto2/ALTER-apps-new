<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$array_cities = array();
$results_A = DB::query("SELECT * FROM cities order by name asc");
$results_A = DB::query("SELECT * FROM cities order by name asc");
foreach ($results_A as $row_A) {
	$array_cities[$row_A['id']] = "".$row_A['name']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];

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
	
<script type="text/JavaScript">
 function noAlpha(obj){
	reg = /[^0-9.]/g;
	obj.value =  obj.value.replace(reg,"");
 }
 
function formatNum(obj){
	var current=obj.value;
	var after=current;

	current=current.replace(/,/g,"");
	var decimalpoint=current.lastIndexOf(".");

	var n;
	var d;
	if(decimalpoint>=0){
	var f=current.split(".");
	d=f[1];
	n=f[0];
	}
	else{
	n=current;
	}

	var index=parseInt((n.length-1)/3);
	if(index!=0){
	var prefixIndex=n.length-index*3;
	after=n.substr(0,prefixIndex)+","+n.substr(prefixIndex,3);
	for(var i=2;i<=index;i++){
	after+=","+n.substr(prefixIndex+3*(i-1),3);
	}

	if(decimalpoint>=0){
	after+="."+d;
	}
	}
	obj.value=after;
}
</script>

	
	
    <style>
      .form__section {
        display: none;
      }

      .form__section.active {
        display: block;
      }
    </style>
    <title>Create Tournament - Alter</title>
  </head>

  <body>
    <form action="tournament-create-process.php" method="POST" enctype="multipart/form-data">
      <!-- Step 1 Start -->
      <section
        id="step1"
        aria-label="Create Tournament"
        class="form__section active"
      >
        <div class="container px-4">
          <div class="py-3">
            <a href="tournament.php">
              <i class="bi bi-x-lg fs-5 me-2"></i>
              <span>Create Tournament</span>
            </a>
          </div>

          <!-- Add Basic Information Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Basic Information</h5>

            <!-- Add Tournament Thumbnail Start -->
            <div
              class="d-flex flex-row align-items-center gap-2 mt-4 border-bottom border-secondary border-opacity-50 pb-4"
            >
              <input type="file" id="logo" aria-label="Team Logo" hidden name="thumbnail"/>
              <label
                for="logo"
                class="d-flex flex-row align-items-center gap-2"
              >
                <span
                  class="bg-secondary d-inline-block text-center d-flex flex-row align-items-center justify-content-center rounded-2"
                  style="height: 48px; width: 48px"
                  ><i class="bi bi-plus-lg fs-3"></i
                ></span>
                <span class="text-secondary">Add tournament thumbnail</span>
              </label>
            </div>
            <!-- Add Tournament Thumbnail End -->

            <!-- Add Banner Start -->
            <div
              class="d-flex flex-row align-items-center gap-2 mt-4 border-bottom border-secondary border-opacity-50 pb-4"
            >
              <input type="file" id="logo" aria-label="Team Logo" hidden name="banner"/>
              <label
                for="logo"
                class="d-flex flex-row align-items-center gap-2"
              >
                <span
                  class="bg-secondary d-inline-block text-center d-flex flex-row align-items-center justify-content-center rounded-2"
                  style="height: 48px; width: 48px"
                  ><i class="bi bi-plus-lg fs-3"></i
                ></span>
                <span class="text-secondary">Add Banner</span>
              </label>
            </div>
            <!-- Add Banner End -->

            <!-- Form Input Start -->
            <div class="border-bottom border-secondary border-opacity-50 pb-4">
              <div class="form__group mt-3">
                <label>Tournament Name</label>
                <div class="form__group-input">
                  <input
                    type="text"
                    name="name"
                    placeholder="Enter your tournament name"
                  />
                </div>
              </div>
              <div class="form__group mt-3">
                <label>Descriptions (optional)</label>
                <div class="form__group-input">
                  <input
                    type="text"
                    name="description"
                    placeholder="Write your descriptions here"
                  />
                </div>
              </div>
            </div>
            <div class="border-bottom border-secondary border-opacity-50 pb-4">
              <div class="form__group mt-3">
                <label>City/Region</label>
                <select name="selCity" id="selCity"
                  class="form-select form__group-select"
                  aria-label="Default select example"
                >
                  <option selected>Select</option>
				  <?php
					foreach($array_cities as $key_1 => $val_1) {
						echo "<option value='$key_1'>$val_1</option>";
					} // foreach($array_cities as $key_1 => $val_1) {
				  ?>
                </select>
              </div>
            </div>
            <div class="mt-3">
              <h6>Time Period</h6>
              <div class="form__group">
                <label class="text-secondary">From</label>
                <div class="form__group-input">
                  <input type="date" name="date_from" id="date_from" min="<?php echo date('Y-m-d'); ?>"/>
                </div>
              </div>
              <div class="form__group mt-3">
                <label class="text-secondary">To</label>
                <div class="form__group-input">
                  <input type="date" name="date_to" id="date_to" min="<?php echo date('Y-m-d'); ?>"/>
                </div>
              </div>
            </div>
            <!-- Form Input End -->
          </div>

          <!-- Button Next Start -->
          <button
            id="next"
            onclick="onNext()"
            data-next="2"
            type="button"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Next
          </button>
          <!-- Button Next End -->
          <!-- Add Basic Information End -->
        </div>
      </section>
      <!-- Step 1 End -->

      <!-- Step 2 Start -->
      <section id="step2" aria-label="Choose Game" class="form__section">
        <div class="container px-4">
          <div class="py-3">
            <div onclick="onPrev()" class="cursor__pointer">
              <i class="bi bi-chevron-left fs-5 me-2"></i>
              <span>Choose Game</span>
            </div>
          </div>

          <!-- All Games Box Start -->
		  <input type="hidden" name="selGameNameId" id="selGameNameId">
		  
          <div class="row g-3 pt-2">
            <div class="col-4">
              <input onclick="document.getElementById('selGameNameId').value='dota_2';"
                type="radio"
                class="btn-check"
                name="options-base"
                id="option1"
                autocomplete="off"
              />
              <label class="btn p-1" for="option1">
                <img
                  src="assets/img/temp/dota_2.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input onclick="document.getElementById('selGameNameId').value='pubg';"
                type="radio"
                class="btn-check"
                name="options-base"
                id="option2"
                autocomplete="off"
              />
              <label class="btn p-1" for="option2">
                <img
                  src="assets/img/temp/pubg.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input onclick="document.getElementById('selGameNameId').value='free_fire';"
                type="radio"
                class="btn-check"
                name="options-base"
                id="option3"
                autocomplete="off"
              />
              <label class="btn p-1" for="option3">
                <img
                  src="assets/img/temp/free_fire.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input onclick="document.getElementById('selGameNameId').value='cs_go';"
                type="radio"
                class="btn-check"
                name="options-base"
                id="option4"
                autocomplete="off"
              />
              <label class="btn p-1" for="option4">
                <img
                  src="assets/img/temp/cs_go.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input onclick="document.getElementById('selGameNameId').value='point_blank';"
                type="radio"
                class="btn-check"
                name="options-base"
                id="option5"
                autocomplete="off"
              />
              <label class="btn p-1" for="option5">
                <img
                  src="assets/img/temp/point_blank.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input onclick="document.getElementById('selGameNameId').value='league_of_legends';"
                type="radio"
                class="btn-check"
                name="options-base"
                id="option6"
                autocomplete="off"
              />
              <label class="btn p-1" for="option6">
                <img
                  src="assets/img/temp/league_of_legends.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input onclick="document.getElementById('selGameNameId').value='valorant';"
                type="radio"
                class="btn-check"
                name="options-base"
                id="option7"
                autocomplete="off"
              />
              <label class="btn p-1" for="option7">
                <img
                  src="assets/img/temp/valorant.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input onclick="document.getElementById('selGameNameId').value='pokemon';"
                type="radio"
                class="btn-check"
                name="options-base"
                id="option8"
                autocomplete="off"
              />
              <label class="btn p-1" for="option8">
                <img
                  src="assets/img/temp/pokemon.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input onclick="document.getElementById('selGameNameId').value='pes';"
                type="radio"
                class="btn-check"
                name="options-base"
                id="option9"
                autocomplete="off"
              />
              <label class="btn p-1" for="option9">
                <img
                  src="assets/img/temp/pes.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input onclick="document.getElementById('selGameNameId').value='genshin_impact';"
                type="radio"
                class="btn-check"
                name="options-base"
                id="option10"
                autocomplete="off"
              />
              <label class="btn p-1" for="option10">
                <img onclick="document.getElementById('selGameNameId').value='genshin_impact';"
                  src="assets/img/temp/genshin_impact.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input
                type="radio"
                class="btn-check"
                name="options-base"
                id="option11"
                autocomplete="off"
              />
              <label class="btn p-1" for="option11">
                <img onclick="document.getElementById('selGameNameId').value='overwatch';"
                  src="assets/img/temp/overwatch.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input
                type="radio"
                class="btn-check"
                name="options-base"
                id="option12"
                autocomplete="off"
              />
              <label class="btn p-1" for="option12">
                <img onclick="document.getElementById('selGameNameId').value='starrail';"
                  src="assets/img/temp/starrail.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input
                type="radio"
                class="btn-check"
                name="options-base"
                id="option13"
                autocomplete="off"
              />
              <label class="btn p-1" for="option13">
                <img onclick="document.getElementById('selGameNameId').value='minecraft';"
                  src="assets/img/temp/minecraft.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input
                type="radio"
                class="btn-check"
                name="options-base"
                id="option14"
                autocomplete="off"
              />
              <label class="btn p-1" for="option14">
                <img onclick="document.getElementById('selGameNameId').value='fortnite';"
                  src="assets/img/temp/fortnite.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
            <div class="col-4">
              <input onclick="document.getElementById('selGameNameId').value='aov';"
                type="radio"
                class="btn-check"
                name="options-base"
                id="option15"
                autocomplete="off"
              />
              <label class="btn p-1" for="option15">
                <img
                  src="assets/img/temp/aov.png"
                  alt=""
                  class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
                />
              </label>
            </div>
          </div>
          <!-- All Games Box End -->

          <!-- Button Next Start -->
          <button
            id="next"
            onclick="onNext()"
            data-next="3"
            type="button"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Next
          </button>
          <!-- Button Next End -->
        </div>
      </section>
      <!-- Step 2 End -->

      <!-- Step 3 Start -->
      <section id="step3" aria-label="Game Formata" class="form__section">
        <div class="container px-4">
          <div class="py-3">
            <div onclick="onPrev()" class="cursor__pointer">
              <i class="bi bi-chevron-left fs-5 me-2"></i>
              <span>Game Format</span>
            </div>
          </div>

          <!-- Tournament Stage Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Tournament Stage</h5>
            <label
              aria-label="tour-type"
              class="position-relative text-start d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50 cursor__pointer"
              for="stage1"
            >
              <div class="flex-fill">
                <h6 class="mb-0">Single Stage Tournament</h6>
              </div>
              <input value="Single Stage"
                type="radio"
                class="me-4"
                name="stage_type"
                id="stage1"
                autocomplete="off"
              />
            </label>
            <label
              aria-label="tour-type"
              class="position-relative text-start d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50 cursor__pointer"
              for="stage2"
            >
              <div class="flex-fill">
                <h6 class="mb-0">Double Stage Tournament</h6>
              </div>
              <input value="Double Stage"
                type="radio"
                class="me-4"
                name="stage_type"
                id="stage2"
                autocomplete="off"
              />
            </label>
          </div>
          <!-- Tournament Stage End -->

          <!-- Format Star -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Tournament Format</h5>
            <label
              aria-label="tour-type"
              class="position-relative text-start d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50 cursor__pointer"
              for="format1"
            >
              <div class="flex-fill">
                <h6 class="mb-0">Single Elimination</h6>
                <small class="text-secondary"
                  >You could put the explanations here
                </small>
              </div>
              <input value="Single Elimination"
                type="radio"
                class="me-4"
                name="format_type"
                id="format1"
                autocomplete="off"
              />
            </label>
            <label
              aria-label="tour-type"
              class="position-relative text-start d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50 cursor__pointer"
              for="format2"
            >
              <div class="flex-fill">
                <h6 class="mb-0">Double Elimination</h6>
                <small class="text-secondary"
                  >You could put the explanations here
                </small>
              </div>
              <input value="Double Elimination"
                type="radio"
                class="me-4"
                name="format_type"
                id="format2"
                autocomplete="off"
              />
            </label>
            <label
              aria-label="tour-type"
              class="position-relative text-start d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50 cursor__pointer"
              for="format3"
            >
              <div class="flex-fill">
                <h6 class="mb-0">Battle Royale</h6>
                <small class="text-secondary"
                  >You could put the explanations here
                </small>
              </div>
              <input value="Battle Royale"
                type="radio"
                class="me-4"
                name="format_type"
                id="format3"
                autocomplete="off"
              />
            </label>
          </div>
          <!-- Format End -->

          <!-- Tournament Stage Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Participant Type</h5>
            <label onclick="document.getElementById('divNumOfPlayers').style.display='none';"
              aria-label="tour-type"
              class="position-relative text-start d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50 cursor__pointer"
              for="participant1"
            >
              <div class="flex-fill">
                <h6 class="mb-0">Individual</h6>
              </div>
              <input value="Individual"
                type="radio"
                class="me-4"
                name="participant_type"
                id="participant1"
                autocomplete="off"
              />
            </label>
            <label onclick="document.getElementById('divNumOfPlayers').style.display='block';"
              aria-label="tour-type"
              class="position-relative text-start d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50 cursor__pointer"
              for="participant2"
            >
              <div class="flex-fill">
                <h6 class="mb-0">Team</h6>
              </div>
              <input value="Team"
                type="radio"
                class="me-4"
                name="participant_type"
                id="participant2"
                autocomplete="off"
              />
            </label>
			
            <label
              aria-label="tour-type"
              class="position-relative text-start d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50 cursor__pointer"
              for="participant2"
            >
			<span id="divNumOfPlayers" style="display:none;">			
              <span class="flex-fill">
				  # Players per Team &nbsp; <input
                    type="text"
                    name="players_per_team"
					size="3"
                    placeholder="5"
                  />
              </span>

			</span>				  
            </label>			
          </div>
          <!-- Tournament Stage End -->

          <!-- Participant Number Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Participant Number</h5>
              <div class="form__group mt-3">
                <label>Participant Number</label>
                <div class="form__group-input">
                  <input
                    type="text"
                    name="participant_number"
                    placeholder="Enter Participant Number"
                  />
                </div>
              </div>
          </div>
          <!-- Participant Number End -->

          <!-- Button Next Start -->
          <button
            id="next"
            onclick="onNext()"
            data-next="4"
            type="button"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Next
          </button>
          <!-- Button Next End -->
        </div>
      </section>
      <!-- Step 3 End -->

      <!-- Step 4 Start -->
      <section id="step4" aria-label="Tournament Reward" class="form__section">
        <div class="container px-4">
          <div class="py-3">
            <div onclick="onPrev()" class="cursor__pointer">
              <i class="bi bi-chevron-left fs-5 me-2"></i>
              <span>Tournament Reward</span>
            </div>
          </div>

          <!-- Reward Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Reward</h5>
            <p class="text-secondary">
              Rewards are distributed according to rankings. Customize the prize
              amounts for each rank as you see fit
            </p>
            <div class="mt-3">
              <div
                class="d-flex flex-row align-items-center justify-content-between"
              >
                <label for="">1st</label>
                <i class="bi bi-x-lg fs-5"></i>
              </div>
              <div class="form__group-input mt-2">
                <input type="text" name="reward_1st" placeholder="Rp 300.000" onkeyup="noAlpha(this); formatNum(this);" onKeyPress='noAlpha(this);' />
              </div>
            </div>
            <div class="mt-3">
              <div
                class="d-flex flex-row align-items-center justify-content-between"
              >
                <label for="">2nd</label>
                <i class="bi bi-x-lg fs-5"></i>
              </div>
              <div class="form__group-input mt-2">
                <input type="text" name="reward_2nd" placeholder="Rp 200.000"  onkeyup="noAlpha(this); formatNum(this);" onKeyPress='noAlpha(this);' />
              </div>
            </div>
            <div class="mt-3">
              <div
                class="d-flex flex-row align-items-center justify-content-between"
              >
                <label for="">3rd</label>
                <i class="bi bi-x-lg fs-5"></i>
              </div>
              <div class="form__group-input mt-2">
                <input type="text" name="reward_3rd" placeholder="Rp 100.000"  onkeyup="noAlpha(this); formatNum(this);" onKeyPress='noAlpha(this);' />
              </div>
            </div>
            <div class="mt-3">
              <div class="d-flex flex-row align-items-center gap-2">
			    <!--
                <i class="bi bi-plus-circle-fill fs-3 text-secondary"></i>
                <span class="text-secondary">Add more</span>
				-->
              </div>
            </div>
          </div>
          <!-- Reward End -->

          <!-- Button Next Start -->
          <button
            id="next"
            onclick="onNext()"
            data-next="5"
            type="button"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Next
          </button>
          <!-- Button Next End -->
        </div>
      </section>
      <!-- Step 4 End -->

      <!-- Step 5 Start -->
      <section id="step5" aria-label="Details" class="form__section">
        <div class="container px-4">
          <div class="py-3">
            <div onclick="onPrev()" class="cursor__pointer">
              <i class="bi bi-chevron-left fs-5 me-2"></i>
              <span>Details</span>
            </div>
          </div>

          <!-- Tournament Type Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Tournament Type</h5>
            <label
              aria-label="tour-type"
              class="position-relative text-start d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50 cursor__pointer"
              for="tourtype1"
            >
              <div class="flex-fill">
                <h6 class="mb-0">Online</h6>
                <small class="text-secondary"
                  >You could put the explanations here
                </small>
              </div>
              <input
                type="radio"
                class="me-4"
                name="tournament_type"
                id="tourtype1"
                autocomplete="off"
				value="Online"
              />
            </label>
            <label
              aria-label="tour-type"
              class="position-relative text-start d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50 cursor__pointer"
              for="tourtype2"
            >
              <div class="flex-fill">
                <h6 class="mb-0">Offline</h6>
                <small class="text-secondary"
                  >You could put the explanations here
                </small>
              </div>
              <input
                type="radio"
                class="me-4"
                name="tournament_type"
                id="tourtype2"
                autocomplete="off"
				value="Offline"
              />
            </label>
            <label
              aria-label="tour-type"
              class="position-relative text-start d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50 cursor__pointer"
              for="tourtype3"
            >
              <div class="flex-fill">
                <h6 class="mb-0">Hybrid</h6>
                <small class="text-secondary"
                  >You could put the explanations here
                </small>
              </div>
              <input
                type="radio"
                class="me-4"
                name="tournament_type"
                id="tourtype3"
                autocomplete="off"
				value="Hybrid"
              />
            </label>
          </div>
          <!-- Tournament Type End -->

          <!-- Registration Setting Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Registration Settings</h5>
			
			<div class="mt-3">
              <input
                type="radio"
                class="btn-check"
                name="registration_type"
                id="regis2"
                autocomplete="off"
				value="Free"
				checked
              />
              <label onclick="document.getElementById('divCharged').style.display='none';"
                class="btn btn-dark text-start w-100 border border-secondary"
                for="regis2"
              >
                <h6 class="mb-0">Free</h6>
                <small class="text-secondary"
                  >You could put the explanations here
                </small>
              </label>
            </div>
			
            <div class="mt-3">
              <input
                type="radio"
                class="btn-check"
                name="registration_type"
                id="regis1"
                autocomplete="off"
				value="Paid"
              />
              <label onclick="document.getElementById('divCharged').style.display='block';"
                class="btn btn-dark text-start w-100 border border-secondary"
                for="regis1"
              >
                <h6 class="mb-0">Paid</h6>
                <small class="text-secondary"
                  >You could put the explanations here
                </small>
              </label>
            </div>

          </div>
          <!-- Registration Setting End -->

          <!-- Charge Start -->
          <div class="p-3 bg-dark rounded-3 mt-3" id="divCharged" style="display:none;">
            <h5>How much do you charge?</h5>
            <p class="text-secondary">
              A participation fee will be charged for each participant joining
            </p>
            <div class="form__group mt-4">
              <div class="form__group-input">
                <input onkeyup="noAlpha(this); formatNum(this);" onKeyPress='noAlpha(this);'
                  type="text"
                  name="participant_fee"
				  placeholder="0"
                />
              </div>
            </div>
          </div>
          <!-- Charge End -->

          <!-- Button Next Start -->
          <input
            id="next"
            type="submit"
            class="btn btn-outline-light rounded-pill my-4 w-100"
			value="Submit"
          >
          <!-- Button Next End -->
        </div>
      </section>
      <!-- Step 5 End -->

      <!-- Step 6 Start -->
      <section id="step6" aria-label="Summary" class="form__section">
        <div class="container px-4">
          <div class="py-3">
            <div onclick="onPrev()" class="cursor__pointer">
              <i class="bi bi-chevron-left fs-5 me-2"></i>
              <span>Summmary</span>
            </div>
          </div>

          <!-- Game Details Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Game Details</h5>
            <div class="mt-3 border-bottom border-secondary border-opacity-50">
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary mb-2"
              >
                <span>Stage</span>
                <span class="text-light">Single Stage</span>
              </div>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary mb-2"
              >
                <span>Format</span>
                <span class="text-light">Single Elimination</span>
              </div>
            </div>
            <div class="mt-2 border-bottom border-secondary border-opacity-50">
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary mb-2"
              >
                <span>Participant Type</span>
                <span class="text-light">Team</span>
              </div>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary mb-2"
              >
                <span>Participant Number</span>
                <span class="text-light">8 </span>
              </div>
            </div>
            <div class="mt-2 border-bottom border-secondary border-opacity-50">
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary mb-2"
              >
                <span>Tournament Type</span>
                <span class="text-light">Online </span>
              </div>
            </div>
            <div class="mt-2">
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary mb-2"
              >
                <span>Registrations</span>
                <span class="text-light">Paid</span>
              </div>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary mb-2"
              >
                <span>Fee</span>
                <span class="text-light">Rp. 150.000</span>
              </div>
            </div>
          </div>
          <!-- Game Details End -->

          <!-- Reward Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Game Details</h5>
            <div class="mt-4">
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary mb-2"
              >
                <span>1st</span>
                <span class="text-light">Rp 300.000</span>
              </div>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary mb-2"
              >
                <span>2nd</span>
                <span class="text-light">Rp 200.000</span>
              </div>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary mb-2"
              >
                <span>3rd</span>
                <span class="text-light">Rp 100.000</span>
              </div>
            </div>
          </div>
          <!-- Reward End -->

          <!-- Button Next Start -->
          <button
            id="next"
            type="submit"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
		  Next
		  </button>
          <!-- Button Next End -->
        </div>
      </section>
      <!-- Step 6 End -->
    </form>
    <script>
      let currenSection = 1;
      let totalSection = $('.form__section').length;
      function onNext(n) {
        if (currenSection <= totalSection) {
          $('.form__section').removeClass('active');
          $(`#step${currenSection + 1}`).addClass('active');
          currenSection++;
        }
      }

      function onPrev(n) {
        if (currenSection <= totalSection) {
          $('.form__section').removeClass('active');
          $(`#step${currenSection - 1}`).addClass('active');
          currenSection--;
        }
      }
    </script>
  </form>
  </body>
</html>

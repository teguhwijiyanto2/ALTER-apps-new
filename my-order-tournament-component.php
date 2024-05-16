<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';
$categ = $_POST['categ'];
$id = $_SESSION["session_usr_id"];

$query = "SELECT 
DISTINCT(tournament.tournament_code),tournament.date_from, tournament.status
FROM tournament
left join tournament_teams on (tournament_teams.tournament_code=tournament.tournament_code AND tournament_teams.registerer_user_id='".$id."')
left join tournament_team_players on (tournament_team_players.tournament_code=tournament.tournament_code AND tournament_team_players.team_player_id='".$id."')
where 
tournament.creator_user_id='".$id."' OR tournament_teams.registerer_user_id='".$id."' OR tournament_team_players.team_player_id='".$id."' AND tournament.status != 'Finished'  ORDER BY date_from DESC;";

if($categ != 'Upcoming') {
    $query = "SELECT 
    DISTINCT(tournament.tournament_code),tournament.date_from, tournament.status
    FROM tournament
    left join tournament_teams on (tournament_teams.tournament_code=tournament.tournament_code AND tournament_teams.registerer_user_id='".$id."')
    left join tournament_team_players on (tournament_team_players.tournament_code=tournament.tournament_code AND tournament_team_players.team_player_id='".$id."')
    where 
    (tournament.creator_user_id='".$id."' OR tournament_teams.registerer_user_id='".$id."' OR tournament_team_players.team_player_id='".$id."') AND tournament.status = '".$categ."'  ORDER BY date_from DESC;";
}
// print_r($query);


$results = DB::query($query);

// print_r($results);
// exit;

foreach ($results as $item) {

    $tour = DB::queryFirstRow("SELECT * FROM tournament where tournament_code=%s", $item['tournament_code']);	
    
    $status = 'host';

    $team = DB::queryFirstRow("SELECT * FROM tournament_team_players where tournament_code=%s", $item['tournament_code']);	

    if($team && $team['team_player_id'] == $id) {
        $status = 'participant';
    }

    if($status == 'host' && $tour['status'] == 'Finished'){
        $status = 'finished';
    }
    $num_of_patricipant = DB::queryFirstField("SELECT count(*) FROM tournament_teams where tournament_code=%s AND payment_status = 'Paid'", $tour['tournament_code']);			 
       
    $tournamen_thumbnail = 'https://placehold.co/400x300.png';

    if (!empty($tour['thumbnail'])) {
      $tournamen_thumbnail_path = 'tournament_thumbnail/' . $tour['thumbnail'];
      
      if (file_exists($tournamen_thumbnail_path)) {
          $tournamen_thumbnail = $tournamen_thumbnail_path;
      }
    }

    $tournamen_banner = 'assets/img/home__tournement-bg-header.png';

      if (!empty($tour['banner'])) {
        $tournamen_banner_path = 'tournament_banner/' . $tour['banner'];
        
        if (file_exists($tournamen_banner_path)) {
            $tournamen_banner = $tournamen_banner_path;
        }
      }

    $finish = false;
    if($tour['date_to'] < date("Y-m-d H:i:s") ){
        $finish = true;
    }

?>

<div class="list-tournament__item d-flex flex-column gap-2 mt-3">
    <div class="bg-dark rounded-3 overflow-hidden w-100">
    <div class="opacity-100">
        <div
        class="position-relative p-3 pt-5 bg-secondary bg-opacity-50"
        style="
            background-image: url('<?php echo $tournamen_banner; ?>');
            background-size: cover;
        "
        >
        <div
            class="position-absolute top-0 fs-8 end-0 px-3 py-1  <?php echo ($status != 'participant') ? 'bg__violet' : 'bg-secondary' ?>"
            style="border-bottom-left-radius: 10px"
        >
            <span><?php echo ucfirst($status); ?></span>
        </div>
        <div class="d-flex flex-row align-items-center gap-3 mt-4">
            <img
            src="<?php echo $tournamen_thumbnail; ?>"
            class="rounded-2 ratio-1x1"
            height="56"
            width="56"
            />
            <div>
            <h5 class="lh-1"><?php echo ucfirst($tour['name']) ?></h5>
            <span><?php echo ucfirst($tour['game_name_id']) ?></span>
            </div>
        </div>
        </div>

        <div class="p-3 d-flex flex-column gap-2">
        <div class='d-flex flex-row align-items-center gap-2'>
        <span class='fw-light'>&nbsp;<b><i class="bi bi-cash fs-4"></i>
        </b> IDR <?=number_format($tour['participant_fee'])?></span>
        </div>							  
        <div class='d-flex flex-row align-items-center gap-2'>
            <i class="bi bi-trophy fs-4"></i>
            <span class='fw-light'>IDR <?=number_format($tour['reward_1st'])?></span>
        </div>
        <div class='d-flex flex-row align-items-center gap-2'>
            <i class="bi bi-people fs-4"></i>
            <span class='fw-light'><?= $num_of_patricipant."/".$tour['participant_number']?> Team</span>
        </div>
        <div class="d-flex flex-row align-items-center gap-2">
            <i class="bi bi-calendar-date fs-4"></i>
            <span class="fw-light"><?php echo $tour['date_from']." - ".$tour['date_to'] ?></span>
        </div>
        </div>
    </div>

    <?php if($tour['status'] == 'Active' && $status != 'participant' && !$finish) { ?>
    <div class="p-3">
        <a
            href="manage-tournament.php?id=<?php echo $tour['id'] ?>"
            class="btn btn-primary btn-sm py-2 rounded-pill w-100"
            >
            Manage
        </a>
    </div>
    <?php } elseif($tour['status'] == 'Active' && $finish && $status != 'participant'){ ?>
    <div class="p-3">
        <a
        href="my-order-tournament-result.php?id=<?php echo $tour['id'] ?>"
        class="btn btn-primary btn-sm py-2 rounded-pill w-100"
        >
        Upload Result
        </a>
    </div>
    <?php } elseif($tour['status'] == 'Active' || $tour['status'] == 'Finished' ) { ?>
    <div class="p-3">
        <a
        href=""
        class="btn btn-outline-light btn-sm py-2 rounded-pill w-100"
        >
        See Details
        </a>
    </div>
    <?php } ?>
    </div>
</div>

<?php } ?>
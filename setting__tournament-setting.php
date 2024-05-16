<?php
  session_start();
  date_default_timezone_set('Asia/Jakarta');
  require_once 'db.class.php';

  $user_profile = DB::queryFirstRow("SELECT *, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0 AS age FROM users where id=%i", $_SESSION["session_usr_id"]);

  $tr_query = DB::query("SELECT tournament.*, games.name AS game_name_text FROM tournament INNER JOIN games ON tournament.game_name_id = games.game_name_id");

  $tournaments = [];

  foreach ($tr_query as $key => $value) {
    if($value["creator_user_id"] === $user_profile["id"]) {
      $value["total_teams"] = DB::queryFirstField("SELECT count(*) FROM tournament_teams where tournament_code=%s", $value['tournament_code']);

      $tournaments[] = $value;
    }
  }
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
    <title>Tournament Settings</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="account.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Tournament Settings</span>
          </a>
        </div>

        <!-- Title Start -->
        <h5>Created Tournament</h5>
        <!-- Title End -->

        <!-- Tournament Start -->
        <section id="tournament__section" class="mt-3">
          <div class="tournament__wrapper d-flex flex-column gap-3 my-3">
            <?php foreach($tournaments as $item) : ?>

            <?php
              $tournament_thumbnail = 'https://placehold.co/400x300.png';

              if (!empty($item['thumbnail'])) {
                $user_pp_file_path = 'tournament_thumbnail/' . $item['thumbnail'];
                
                if (file_exists($user_pp_file_path)) {
                    $tournament_thumbnail = $user_pp_file_path;
                }
              }

              $tournamen_banner = 'assets/img/home__tournement-bg-header.png';

              if (!empty($item['banner'])) {
                $tournamen_banner_path = 'tournament_banner/' . $item['banner'];
                
                if (file_exists($tournamen_banner_path)) {
                    $tournamen_banner = $tournamen_banner_path;
                }
              }
            ?>
              <div
              class="tournament__item bg-dark rounded-3 overflow-hidden w-100"
            >
              <div
                class="position-relative p-3 pt-5 bg-secondary bg-opacity-50"
                style="
                  background-image: url('<?php echo $tournamen_banner; ?>');
                  background-size: cover;
                "
              >
                <div
                  class="position-absolute top-0 end-0 px-3 py-1 bg__green"
                  style="border-bottom-left-radius: 8px"
                >
                  <span><small>Open</small></span>
                </div>
                <div class="d-flex flex-row align-items-center gap-3 mt-4">
                  <img
                    src="<?= $tournament_thumbnail ?>"
                    class="rounded-2 ratio-1x1"
                    height="56"
                    width="56"
                  />
                  <div>
                    <h5 class="lh-1"><?= $item["name"] ?></h5>
                    <span><?= $item["game_name_text"] ?></span>
                  </div>
                </div>
              </div>

              <div class="p-3 d-flex flex-column gap-2">
                <div class="d-flex flex-row align-items-center gap-2">
                  <img
                    src="assets/img/home__tournament-trophy.png"
                    height="24"
                    width="24"
                  />
                  <span class="fw-light">Rp<?= number_format($item["reward_1st"] + $item["reward_2nd"] + $item["reward_3rd"]) ?></span>
                </div>
                <div class="d-flex flex-row align-items-center gap-2">
                  <img
                    src="assets/img/home__tournament-users.png"
                    height="24"
                    width="24"
                  />
                  <span class="fw-light"><?= $item["total_teams"] ?>/<?= $item["participant_number"] ?> Team</span>
                </div>
                <div class="d-flex flex-row align-items-center gap-2">
                  <img
                    src="assets/img/home__tournament-calendar-date.png"
                    height="24"
                    width="24"
                  />
                  <span class="fw-light"><?= $item["date_from"] ?> - <?= $item["date_to"] ?></span>
                </div>
              </div>

              <div class="p-3">
                <a
                  href="manage-tournament.php?id=<?php echo $item['id']; ?>"
                  class="btn btn-primary rounded-pill w-100"
                  >Manage</a
                >
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </section>
        <!-- Tournament End -->
      </div>
    </section>
  </body>
</html>

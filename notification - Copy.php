<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';
$id = $_SESSION["session_usr_id"];


$results = DB::query("SELECT notifications.*, users.*, notifications.id AS notif_id FROM notifications JOIN users ON notifications.notif_from = users.id WHERE notif_for = %i ORDER BY created_date DESC", $id);

// print_r($results);
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
    <title>Notification | Alter</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="home.php">
            <i class="bi bi-x-lg fs-5 me-2"></i>
            <span>Notifications</span>
          </a>
        </div>

        <!-- Notif Tab Start -->
        <section class="sticky-top bg-black">
          <div class="row g-0">
            <div class="col-4">
              <div data-tab="account" class="up__tab-item active">Account</div>
            </div>
            <div class="col-4">
              <div data-tab="playorder" class="up__tab-item">Play Order</div>
            </div>
            <div class="col-4">
              <div data-tab="tournament" class="up__tab-item">Tournament</div>
            </div>
          </div>
        </section>
        <!-- Notif Tab End -->

        <!-- ========================================================== -->
        <!-- Tab Content Account Start -->
        <section id="account" class="tab__content d-block">
          <div class="">
            <h5 class="text-white pt-4">New</h5>
            <div aria-label="List New" class="">
              <!-- Single user liking a post -->
              <?php 
              
              foreach($results as $result) {
                DB::query("UPDATE notifications SET subtitle='read' WHERE id = %i", $result['notif_id']);

                $user_profile_images = 'https://placehold.co/150x150.png';

                if (!empty($result['user_pp_file'])) {
                  $user_pp_file_path = 'user_pp_files/' . $result['user_pp_file'];
                  
                  if (file_exists($user_pp_file_path)) {
                      $user_profile_images = $user_pp_file_path;
                  }
                }

                $name_parts = explode(" ", $result['name']);

                $first_name = $name_parts[0];

                $notificationTime = strtotime($result['created_date']);

                $currentTime = time();

                $timeDiff = $currentTime - $notificationTime;
                $timeAgo = '';

                if ($timeDiff < 3600) {
                    $minutes = round($timeDiff / 60);
                    $timeAgo = "$minutes Min";
                }
                elseif ($timeDiff < 86400) {
                    $hours = round($timeDiff / 3600);
                    $timeAgo = "$hours Hr";
                }
                else {
                    $days = round($timeDiff / 86400);
                    $timeAgo = "$days Day";
                }
                // print_r($result);
              ?>
              <?php if($result['category'] == 'post-like'){?>
                  <a href="user_profile.php">
                    <div
                      class="d-flex flex-row align-items-center gap-3 border-bottom border-dark py-3"
                    >
                      <img
                        src="<?= $user_profile_images?>"
                        alt=""
                        width="32"
                        height="32"
                        class="rounded-circle object-fit-cover"
                      />
                      <div class="flex__1 fs-7">
                        <b><?= ucfirst($first_name) ?></b>
                        <span> <?= $result['title'] ?></span>
                        <span class="text-secondary"><?= $timeAgo ?></span>
                      </div>
                    </div>
                  </a>
              <?php }if($result['category'] == 'post-comment'){?>
                  <a href="user_profile.php">
                    <div
                      class="d-flex flex-row align-items-center gap-3 border-bottom border-dark py-3"
                    >
                      <img
                        src="<?= $user_profile_images?>"
                        alt=""
                        width="32"
                        height="32"
                        class="rounded-circle object-fit-cover"
                      />
                      <div class="flex__1 fs-7">
                        <b><?= ucfirst($first_name) ?></b>
                        <span> <?= $result['title'] ?></span>
                        <span class="text-secondary"><?= $timeAgo ?></span>
                      </div>
                    </div>
                  </a>
              <?php } if($result['category'] == 'play-order'){
                $match = DB::queryFirstRow("SELECT * FROM matchmaking_availability WHERE id=%i", $result['data']);
              ?>
                  <a href="myorder-play-review.php?id=<?php echo $result['data'] ?>&view=1">
                    <div
                      class="d-flex flex-row align-items-center gap-3 border-bottom border-dark py-3"
                    >
                      <img
                        src="<?= $user_profile_images?>"
                        alt=""
                        width="32"
                        height="32"
                        class="rounded-circle object-fit-cover"
                      />
                      <div class="flex__1 fs-7">
                        <span>Incoming order from <b><?= ucfirst($first_name) ?></b></span>
                        <span class="text-secondary"><?= $timeAgo ?></span>
                        <?php if($match['request_status'] == '-'){ ?>
                        <a href="play-request-reject.php?pid=<?php echo $result['data'] ?>" class="btn btn-danger btn-sm py-1 px-2 rounded-3 fs-5">
                          <i class="bi bi-x text-secondary cursor-pointer"></i>
                        </a>
                        <a href="myorder-play-review.php?id=<?php echo $result['data'] ?>&view=0" id="btn_follow" class="btn btn-success btn-sm py-1 px-2 rounded-3 fs-5">
                          <i class="bi bi-check text-secondary cursor-pointer"></i>
                        </a>
                        <?php } ?>
                      </div>
                    </div>
                  </a>
              <?php } if($result['category'] == 'cancel-order'){ ?>
                  <a href="myorder-play-review.php?id=<?php echo $result['data'] ?>&view=1">
                    <div
                      class="d-flex flex-row align-items-center gap-3 border-bottom border-dark py-3"
                    >
                      <img
                        src="<?= $user_profile_images?>"
                        alt=""
                        width="32"
                        height="32"
                        class="rounded-circle object-fit-cover"
                      />
                      <div class="flex__1 fs-7">
                        <span><b><?= ucfirst($first_name) ?></b> Cancelled your order.</span>
                        <span class="text-secondary"><?= $timeAgo ?></span>
                      </div>
                    </div>
                  </a>
              <?php } if($result['category'] == 'accepted-order'){ ?>
                  <a href="myorder-play-review.php?id=<?php echo $result['data'] ?>&view=1">
                    <div
                      class="d-flex flex-row align-items-center gap-3 border-bottom border-dark py-3"
                    >
                      <img
                        src="<?= $user_profile_images?>"
                        alt=""
                        width="32"
                        height="32"
                        class="rounded-circle object-fit-cover"
                      />
                      <div class="flex__1 fs-7">
                        <span><b><?= ucfirst($first_name) ?></b> Accepted your order.</span>
                        <span class="text-secondary"><?= $timeAgo ?></span>
                      </div>
                    </div>
                  </a>
              <?php } if($result['category'] == 'tournament-join'){
	                $tour = DB::queryFirstRow("SELECT * FROM tournament where tournament_code=%s ",$result['data']);

                  $tournament_thumbnail = 'https://placehold.co/400x300.png';

                  if (!empty($tour['thumbnail'])) {
                    $user_pp_file_path = 'tournament_thumbnail/' . $tour['thumbnail'];
                    
                    if (file_exists($user_pp_file_path)) {
                        $tournament_thumbnail = $user_pp_file_path;
                    }
                  }

                ?>
                  <a href="tournament-detail.php?tid=<?= $tour['id']?>">
                    <div
                      class="d-flex flex-row align-items-center gap-3 border-bottom border-dark py-3"
                    >
                      <img
                        src="<?= $user_profile_images?>"
                        alt=""
                        width="32"
                        height="32"
                        class="rounded-circle object-fit-cover"
                      />
                      <div class="flex__1 fs-7">
                        <b><?= ucfirst($first_name) ?></b>
                        <span>are joining your tournament. </span>
                        <span class="text-secondary"><?= $timeAgo ?></span>
                        <div class="text-secondary fw-semibold mt-1">
                          <?= $tour['name'] ?>
                        </div>
                      </div>
                      <img
                        src="<?= $tournament_thumbnail ?>"
                        alt=""
                        width="58"
                        height="58"
                        class="object-fit-cover rounded-3"
                      />
                    </div>
                  </a>
              <?php } if($result['category'] == 'follow'){
                $followed = false;
	              $follow_query = DB::queryFirstField("SELECT count(*) FROM followers where user_id=%i AND follower_id=%i", $result['notif_from'], $id);

                if($follow_query){
                  $followed = true;
                }
                ?>
                    <div
                      class="d-flex flex-row align-items-center gap-3 border-bottom border-dark py-3"
                    >
                      <img
                        src="<?= $user_profile_images?>"
                        alt=""
                        width="32"
                        height="32"
                        class="rounded-circle object-fit-cover"
                      />
                      <div class="flex__1 fs-7">
                        <span><b><?= ucfirst($first_name) ?></b> started following you.</span>
                        <span class="text-secondary"><?= $timeAgo ?></span>
                        <?php if(!$followed) { ?>
                        <span onclick="follow(<?= $result['notif_from'] ?>)" id="btn_follow" class="btn btn-primary btn-sm py-1 px-4 rounded-3">
                          Follow
                        </span>
                        <?php } ?>
                      </div>
                    </div>
              <?php }} ?>
            </div>
          </div>
        </section>
        <!-- Tab Content Account End -->
        <!-- ========================================================== -->

        <!-- ========================================================== -->
        <!-- Tab Content Play Order Start -->
        <section id="playorder" class="tab__content">
          <div class="">
            <h5 class="text-white pt-4">New</h5>
            <div aria-label="List New" class="">
              <!-- Incoming order -->
              <?php 
              
              foreach($results as $result) {
                $user_profile_images = 'https://placehold.co/150x150.png';

                if (!empty($result['user_pp_file'])) {
                  $user_pp_file_path = 'user_pp_files/' . $result['user_pp_file'];
                  
                  if (file_exists($user_pp_file_path)) {
                      $user_profile_images = $user_pp_file_path;
                  }
                }

                $name_parts = explode(" ", $result['name']);

                $first_name = $name_parts[0];

                $notificationTime = strtotime($result['created_date']);

                $currentTime = time();

                $timeDiff = $currentTime - $notificationTime;
                $timeAgo = '';

                if ($timeDiff < 3600) {
                    $minutes = round($timeDiff / 60);
                    $timeAgo = "$minutes Min";
                }
                elseif ($timeDiff < 86400) {
                    $hours = round($timeDiff / 3600);
                    $timeAgo = "$hours Hr";
                }
                else {
                    $days = round($timeDiff / 86400);
                    $timeAgo = "$days Day";
                }
                // print_r($result);
                
                if($result['category'] == 'play-order'){ 
                  $match = DB::queryFirstRow("SELECT * FROM matchmaking_availability WHERE id=%i", $result['data']);
                  
                  ?>
                  <a href="myorder-play-review.php?id=<?php echo $result['data'] ?>&view=1">
                    <div
                      class="d-flex flex-row align-items-center gap-3 border-bottom border-dark py-3"
                    >
                      <img
                        src="<?= $user_profile_images?>"
                        alt=""
                        width="32"
                        height="32"
                        class="rounded-circle object-fit-cover"
                      />
                      <div class="flex__1 fs-7">
                        <span>Incoming order from <b><?= ucfirst($first_name) ?></b></span>
                        <span class="text-secondary"><?= $timeAgo ?></span>
                        <?php if($match['request_status'] == '-'){ ?>
                        <a href="play-request-reject.php?pid=<?php echo $result['data'] ?>" class="btn btn-danger btn-sm py-1 px-2 rounded-3 fs-5">
                          <i class="bi bi-x text-secondary cursor-pointer"></i>
                        </a>
                        <a href="myorder-play-review.php?id=<?php echo $result['data'] ?>&view=0" id="btn_follow" class="btn btn-success btn-sm py-1 px-2 rounded-3 fs-5">
                          <i class="bi bi-check text-secondary cursor-pointer"></i>
                        </a>
                        <?php } ?>
                      </div>
                    </div>
                  </a>
              <?php } if($result['category'] == 'cancel-order'){ ?>
                  <a href="myorder-play-review.php?id=<?php echo $result['data'] ?>&view=1">
                    <div
                      class="d-flex flex-row align-items-center gap-3 border-bottom border-dark py-3"
                    >
                      <img
                        src="<?= $user_profile_images?>"
                        alt=""
                        width="32"
                        height="32"
                        class="rounded-circle object-fit-cover"
                      />
                      <div class="flex__1 fs-7">
                        <span><b><?= ucfirst($first_name) ?></b> Cancelled your order.</span>
                        <span class="text-secondary"><?= $timeAgo ?></span>
                      </div>
                    </div>
                  </a>
              <?php } if($result['category'] == 'accepted-order'){ ?>
                  <a href="myorder-play-review.php?id=<?php echo $result['data'] ?>&view=1">
                    <div
                      class="d-flex flex-row align-items-center gap-3 border-bottom border-dark py-3"
                    >
                      <img
                        src="<?= $user_profile_images?>"
                        alt=""
                        width="32"
                        height="32"
                        class="rounded-circle object-fit-cover"
                      />
                      <div class="flex__1 fs-7">
                        <span><b><?= ucfirst($first_name) ?></b> Accepted your order.</span>
                        <span class="text-secondary"><?= $timeAgo ?></span>
                      </div>
                    </div>
                  </a>
              <?php }} ?>
            </div>
          </div>
          </div>
        </section>
        <!-- Tab Content Play Order End -->
        <!-- ========================================================== -->

        <!-- ========================================================== -->
        <!-- Tab Content Tournament Start -->
        <section id="tournament" class="tab__content">
          <div class="">
            <h5 class="text-white pt-4">New</h5>
            <div aria-label="List">
              <!-- A player joining your tournament -->
              <?php 
              
              foreach($results as $result) {
                $user_profile_images = 'https://placehold.co/150x150.png';

                if (!empty($result['user_pp_file'])) {
                  $user_pp_file_path = 'user_pp_files/' . $result['user_pp_file'];
                  
                  if (file_exists($user_pp_file_path)) {
                      $user_profile_images = $user_pp_file_path;
                  }
                }

                $name_parts = explode(" ", $result['name']);

                $first_name = $name_parts[0];

                $notificationTime = strtotime($result['created_date']);

                $currentTime = time();

                $timeDiff = $currentTime - $notificationTime;
                $timeAgo = '';

                if ($timeDiff < 3600) {
                    $minutes = round($timeDiff / 60);
                    $timeAgo = "$minutes Min";
                }
                elseif ($timeDiff < 86400) {
                    $hours = round($timeDiff / 3600);
                    $timeAgo = "$hours Hr";
                }
                else {
                    $days = round($timeDiff / 86400);
                    $timeAgo = "$days Day";
                }
                // print_r($result);
              ?>
              <?php if($result['category'] == 'tournament-join'){
	                $tour = DB::queryFirstRow("SELECT * FROM tournament where tournament_code=%s ",$result['data']);

                  $tournament_thumbnail = 'https://placehold.co/400x300.png';

                  if (!empty($tour['thumbnail'])) {
                    $user_pp_file_path = 'tournament_thumbnail/' . $tour['thumbnail'];
                    
                    if (file_exists($user_pp_file_path)) {
                        $tournament_thumbnail = $user_pp_file_path;
                    }
                  }

                ?>
                  <a href="tournament-detail.php?tid=<?= $tour['id']?>">
                    <div
                      class="d-flex flex-row align-items-center gap-3 border-bottom border-dark py-3"
                    >
                      <img
                        src="<?= $user_profile_images?>"
                        alt=""
                        width="32"
                        height="32"
                        class="rounded-circle object-fit-cover"
                      />
                      <div class="flex__1 fs-7">
                        <b><?= ucfirst($first_name) ?></b>
                        <span>are joining your tournament. </span>
                        <span class="text-secondary"><?= $timeAgo ?></span>
                        <div class="text-secondary fw-semibold mt-1">
                          <?= $tour['name'] ?>
                        </div>
                      </div>
                      <img
                        src="<?= $tournament_thumbnail ?>"
                        alt=""
                        width="58"
                        height="58"
                        class="object-fit-cover rounded-3"
                      />
                    </div>
                  </a>
                  <?php }}?>
            </div>
          </div>
        </section>
        <!-- Tab Content Tournament End -->
        <!-- ========================================================== -->
      </div>
    </section>
    <script>
      $(document).ready(function () {
        // Tab Click Content
        var tabsItem = $(".up__tab-item");
        var tabsContent = $(".tab__content");
        tabsItem.on("click", function () {
          var tabId = $(this).data("tab");
          tabsItem.removeClass("active");
          $(this).addClass("active");
          tabsContent.removeClass("d-block");
          $(`#${tabId}`).addClass("d-block");
        });
      });
      function follow(id) {
        $.ajax({
              url: "follow-process.php?fid="+id,
              type: 'GET',
              cache: false,
              success: function(data) {
                  $("#btn_follow").hide()
              }
          });
      }
    </script>
  </body>
</html>

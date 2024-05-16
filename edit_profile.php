<?php
    session_start();
    date_default_timezone_set('Asia/Jakarta');
    require_once 'db.class.php';

    $array_users_name = array();
    $array_users_email = array();
    $array_users_username = array();
    $results_A = DB::query("SELECT * FROM users");
    foreach ($results_A as $row_A) {
        $array_users_name[$row_A['id']] = "".$row_A['name']."";
        $array_users_email[$row_A['id']] = "".$row_A['email']."";
        $array_users_username[$row_A['id']] = "".$row_A['username']."";
    } // foreach ($results_A as $row_A) {
    //echo $array_users_username[$row_A['id']];


    $user_profile = DB::queryFirstRow("SELECT *, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0 AS age FROM users where id=%i", $_SESSION["session_usr_id"]);

    $user_profile_images = 'user_pp_files/default_user_pp.jpg';

    if (!empty($user_profile['user_pp_file'])) {
        $user_pp_file_path = 'user_pp_files/' . $user_profile['user_pp_file'];
        
        if (file_exists($user_pp_file_path)) {
            $user_profile_images = $user_pp_file_path;
        }
    }

    $user_banner_image = 'user_banner_files/default_user_banner.jpg';

    if (!empty($user_profile['user_banner_file'])) {
        $user_banner_file_path = 'user_banner_files/' . $user_profile['user_banner_file'];
        
        if (file_exists($user_banner_file_path)) {
            $user_banner_image = $user_banner_file_path;
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
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"
        />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
        <script src="vendor/cropimage/profile-image.js"></script>
        <script src="vendor/cropimage/banner-image.js"></script>
        <script src="js/script.js"></script>

        <!-- Mulitiple Select CDN -->
        <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet"
        />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/select2.css" />
        <title>Edit Profile</title>
    </head>

    <body>
        <section>
            <div class="container px-4">
            <div class="py-3">
                <a href="account.php">
                <i class="bi bi-chevron-left fs-5 me-2"></i>
                <span>Edit Profile</span>
                </a>
            </div>

            <!-- Banner Start -->
            <section class="">
                <div
                    id="banner-profile"
                    class="p-3 w-100 cursor__pointer"
                    style="
                    background-image: url('<?php echo $user_banner_image; ?>');
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                    height: 200px;
                    "
                ></div>
                <div
                    class="bg-dark m-3 rounded-circle position-absolute top-0 end-0 d-flex align-items-center justify-content-center"
                    style="width: 35px; height: 35px"
                >
                    <i class="bi bi-pencil-fill text-secondary cursor-pointer" id="pencil-banner" role="button"></i>
                </div>
                </div>

                <!-- Modal View Image Profile Start -->
                <form action="user-banner-process.php" method="post" enctype="multipart/form-data" id="formUserBanner"> <!-- START formUserBanner -->
                    <div
                        id="modal-view-banner"
                        style="display: none"
                        class="fixed-top max-w-sm w-100 h-100 bg-black bg-opacity-50 align-items-center justify-content-center"
                    >
                        <div class="bg-dark rounded-4">
                        <div class="text-end p-2">
                            <i id="close-view-banner" class="bi bi-x-lg cursor__pointer"></i>
                        </div>
                        <img class="object-fit-contain" style="width: 400px; height: 300px" />
                        <div
                            class="d-flex flex-row align-items-center justify-content-between"
                        >
                            <label
                            for="input-banner"
                            class="btn btn-dark w-100 py-2 d-flex flex-row align-items-center gap-2 flex-fill"
                            style="font-size: 10pt"
                            >
                            <i class="bi bi-pencil-square"></i>
                            <div>Ubah Gambar</div>
                            </label>
                            <input type="file" id="input-banner" name="input_banner" hidden />
                            <input type="text" hidden name="page:edit-profile" value="true">
                            <button
                            type="button"
                            id="delete-banner"
                            class="btn btn-dark flex-fill py-2 d-flex flex-row align-items-center gap-2 text-danger"
                            style="font-size: 10pt"
                            >
                            <i class="bi bi-trash-fill"></i>
                            <div>Hapus</div>
                            </button>
                        </div>
                        </div>
                    </div>
                    <!-- Modal View Image Profile End -->

                    <!-- Preview Selected Image Banner Start -->
                    <div
                        id="modal-preview-input-banner"
                        style="display: none"
                        class="fixed-top max-w-sm w-100 h-100 bg-black bg-opacity-50 align-items-center justify-content-center"
                    >
                        <div class="bg-dark rounded-4">
                        <img
                            id="preview-input-banner"
                            class="object-fit-cover"
                            style="width: 400px; height: 400px"
                        />
                        <div
                            class="d-flex flex-row align-items-center justify-content-between"
                        >
                            <button
                            id="applyCropBanner"
                            type="button"
                            class="btn btn-dark py-2 d-flex flex-row align-items-center gap-2 flex-fill"
                            style="font-size: 10pt"
                            >
                            <div class="mx-auto" onclick="document.getElementById('formUserBanner').submit();">Simpan</div>		  
                            </button>
                            <button
                            id="cancelCropBanner"
                            type="button"
                            class="btn btn-dark flex-fill py-2 d-flex flex-row align-items-center gap-2 text-danger"
                            style="font-size: 10pt"
                            >
                            <div class="mx-auto">Batal</div>
                            </button>
                        </div>
                        </div>
                    </div>
                    </form>
                <!-- Preview Selected Image Banner End -->
            </section>
            <!-- Banner End -->

    <!-- User Profile Start -->
    <section>
      <div class="container">
        <div class="d-flex flex-row align-items-end gap-2">
          <div
            class="border border-dark z-2 rounded-circle"
            style="margin-top: -45px"
          >
            <img
              id="avatar-circle"
              src="<?php echo $user_profile_images; ?>"
              alt=""
              class="rounded-circle ratio-1x1 cursor__pointer bg-dark"
              width="100"
              height="100"
            />
          </div>

          <!-- Modal View Image Profile Start -->
		  <form action="user-pp-process.php" method="post" enctype="multipart/form-data" id="formUserPP"> <!-- START formUserPP -->
          <div
            id="modal-view-avatar"
            style="display: none"
            class="fixed-top max-w-sm w-100 h-100 bg-black bg-opacity-50 align-items-center justify-content-center"
          >
            <div class="bg-dark rounded-4">
              <div class="text-end p-2">
                <i
                  id="close-view-avatar"
                  class="bi bi-x-lg cursor__pointer"
                ></i>
              </div>
              <img
                class="object-fit-cover"
                style="width: 300px; height: 300px"
              />
              <div
                class="d-flex flex-row align-items-center justify-content-between"
              >
                <label
                  for="input-avatar"
                  class="btn btn-dark w-100 py-2 d-flex flex-row align-items-center gap-2 flex-fill"
                  style="font-size: 10pt"
                >
                  <i class="bi bi-pencil-square"></i>
                  <div>Ubah Gambar</div>
                </label>
                <input
                  type="file"
                  id="input-avatar"
                  name="input_avatar"
                  hidden
                />
                <button
                  type="button"
                  id="delete-avatar"
                  class="btn btn-dark flex-fill py-2 d-flex flex-row align-items-center gap-2 text-danger"
                  style="font-size: 10pt"
                >
                  <i class="bi bi-trash-fill"></i>
                  <div>Hapus</div>
                </button>
              </div>
            </div>
          </div>
          <!-- Modal View Image Profile End -->

          <!-- Preview Selected Image Profil Start -->
          <div
            id="modal-preview-input-avatar"
            style="display: none"
            class="fixed-top max-w-sm w-100 h-100 bg-black bg-opacity-50 align-items-center justify-content-center"
          >
            <div class="bg-dark rounded-4">
              <img
                id="preview-input-avatar"
                class="object-fit-cover"
                style="width: 400px; height: 400px"
              />
              <div
                class="d-flex flex-row align-items-center justify-content-between"
              >
                <button
                  id="applyCropProfile"
                  type="button"
                  class="btn btn-dark py-2 d-flex flex-row align-items-center gap-2 flex-fill"
                  style="font-size: 10pt"
                >
                  <div class="mx-auto" onclick="document.getElementById('formUserPP').submit();">Simpan</div>
                </button>
                <button
                  id="cancelCropProfile"
                  type="button"
                  class="btn btn-dark flex-fill py-2 d-flex flex-row align-items-center gap-2 text-danger"
                  style="font-size: 10pt"
                >
                  <div class="mx-auto">Batal</div>
                </button>
              </div>
            </div>
          </div>
        </form>
          <!-- Preview Selected Image Profil End -->
                </div>
                </div>
            </section>
            <!-- User Profile End -->

            <form id="myForm" action="edit_profile_process.php" method="POST">
                <!-- Alter Member Info Start -->
                <section class="bg-dark rounded-3 p-3 mt-4">
                    <h5>Alter Member</h5>
                    <h6 class="text__purple">Username : <?php echo $user_profile["username"] ? $user_profile["username"] : "------" ; ?></h6>

                    <div class="mb-3">
                    <label class="form-label text-secondary">Display Name</label>
                    <input class="form-control bg-dark py-3 text-light" name="name" value="<?php echo $user_profile["name"]; ?>"/>
                    </div>
                </section>
                <!-- Alter Member Info End -->

                <!-- Submit Button Start -->
                <div class="my-3">
                    <button
                    type="submit"
                    class="btn btn-outline-light w-100 rounded-pill"
                    >
                    Save
                    </button>
                </div>
                <!-- Submit Button End -->
                </div>
            </form>
        </section>

        <script>
        // $(document).ready(function () {
        //     $(".interest__multiple").select2();
        //     $(".language__multiple").select2();

        //     // handle back
        //     $(window).on("beforeunload", function () {
        //     return "Are you sure you want to discard your changes? ";
        //     });

        //     $("#myForm").submit(function () {
        //     $(window).off("beforeunload");
        //     });
        // });
        $(document).ready(function() {
    // Menangani klik pada ikon pensil
            $('#pencil-avatar-circle').on('click', function() {
                // Inisiasi klik pada elemen avatar
                $('#avatar-circle').click();
            });
            $('#pencil-banner').on('click', function() {
                // Inisiasi klik pada elemen avatar
                $('#banner-profile').click();
            });
        });
        </script>
    </body>
</html>

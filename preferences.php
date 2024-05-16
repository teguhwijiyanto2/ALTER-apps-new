<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';
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
    <title>Preferences - Alter</title>
  </head>

  <body>
    <div
      class="container min-vh-100 d-flex flex-column align-items-center justify-content-center"
    >
      <div class="bg__gradation">
        <h1 class="text-white text-center fw-bold">Let's Get to Know You</h1>
      </div>

      <form
        action="home.php"
        class="w-100 needs-validation" novalidate
        style="display: block; margin-top: -60px"
		    method="POST"
      >
        <div class="form__group">
          <label for="">Pick your Favorite games</label>
          <div class="row g-3 pt-2">
            <?php
                $results_1 = DB::query("select game_name_id from games order by id asc");
                foreach ($results_1 as $row_1) {
					
				if($row_1['game_name_id']=="apex_legends" || $row_1['game_name_id']=="call_of_duty" || $row_1['game_name_id']=="fifa" || $row_1['game_name_id']=="nba" || $row_1['game_name_id']=="magic_chess") {	
					// these images are not exist, don't display!
				}
				else {
									   echo "
									  <div class='col-4'>
										<img
										src='assets/img/temp/".$row_1['game_name_id'].".png'
										alt=''
										class='game__item w-100 ratio-1x1 object-fit-cover rounded-3'
										/>
									  </div>
									  ";			
									}
					
	
                } // foreach ($results_1 as $row_1) {
                //echo $array_users_username[$row_1['id']];
              ?>
          </div>
        </div>
        <div class="form__group mt-4">
          <label>How often do you play?</label>
          <div class="">
           <select
              class="text-input-auth invalid__form"
              aria-label="Default select example"
              name="selectOften"
              id="selectOften"
              required
            >
              <option selected value="">Select</option>
              <option value="1">1 day in a week</option>
              <option value="2">2 days in a week</option>
              <option value="3">3 days in a week</option>
              <option value="4">4 days in a week</option>
              <option value="5">5 days in a week</option>
              <option value="6">6 days in a week</option>
              <option value="7">7 days in a week</option>
            </select>
            <div id="errorOften" class="invalid-feedback">Please pick an option!</div>
          </div>
        </div>	
        <div class="form__group mt-4">
          <label>How many hours per day do you play?</label>
          <div class="">
           <select
              class="text-input-auth invalid__form"
              aria-label="Default select example"
              name="selectHours"
              id="selectHours"
              required
            >
              <option selected value="">Select</option>
              <option value="1">Less than 1 hour</option>
              <option value="2">1-2 hours</option>
              <option value="3">3-5 hours</option>
              <option value="4">More than 5 hours</option>
            </select>
            <div id="errorHours" class="invalid-feedback">Please pick an option!</div>
          </div>
        </div>	
        <input
          type="submit"
          class="btn btn-outline-light rounded-pill w-100 my-5"
		  value="Submit"
        >
      </form>
    </div>
    <script>
      (function () {
		  'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          var selector = document.getElementById("selectOften");
          var errorMsg = document.getElementById("errorOften");
          var selector2 = document.getElementById("selectHours");
          var errorMsg2 = document.getElementById("errorHours");

          if(selector.matches(":invalid"))
          {
            errorMsg.classList.add("d-block");
          }
          if(selector2.matches(":invalid"))
          {
            errorMsg2.classList.add("d-block");
          }
          form.classList.add('was-validated')
          }, false)
        })
      })()	 

      $(document).ready(function () {
        $('.game__item').click(function () {
          if ($(this).hasClass('border')) {
            $(this).removeClass('border border-5 border-success');
          } else {
            $(this).addClass('border border-5 border-success');
          }
        });
      });
    </script>
  </body>
</html>

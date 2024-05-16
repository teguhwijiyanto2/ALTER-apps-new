<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$game = [];
$date = [];

$option = DB::queryFirstRow("SELECT * FROM matchmaking_option WHERE user_id = %i",$_SESSION["session_usr_id"]);
if($option) {
  $game = json_decode($option['game']);
  $date = json_decode($option['available_date']);
  
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

    <!-- Mulitiple Select CDN -->
    <link
      href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/select2.css" />

    <!-- Calendar JS -->
    <link rel="stylesheet" href="css/calendar.css" />

    <link
      type="text/css"
      rel="stylesheet"
      href="vendor/calendar/css/main.css"
    />

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script> -->
    <script src="vendor/calendar/js/calendar.js"></script>

    <title>Play Options</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="account.php">
            <i class="bi bi-x-lg fs-5 me-2"></i>
            <span>Play Options</span>
          </a>
        </div>

        <!-- Summary Start -->
        <section>
          <form action="play-option-process.php" method="post">
            <div class="p-3 bg-dark rounded-3 mt-5">
              <div
                class="d-flex flex-row align-items-center justify-content-between"
                id="availableBtn"
              >
                <div>
                  <div>Availability status</div>
                  <div id="textAvailable" style="color:<?= (isset($option) && $option['available'] == 'available') ? '#008000' : '#ff0000'  ?>"><?= isset($option) ? ucfirst($option['available']) : 'Not Available' ?></div>
                  <input type="hidden" name="available" id="available" value="<?= isset($option) ? $option['available'] : 'not available' ?>">
                </div>
                <i class="bi bi-chevron-right fs-5"></i>
              </div>
            </div>

          <div class="p-3 bg-dark rounded-3 mt-3">
            <label class="form-label text-secondary">Game Services</label>
            <select
              class="game-services__multiple form-control bg-dark py-3 text-black"
              name="game[]"
              required
              multiple="multiple"
            >
                <option value="mobile_legends" <?= in_array("mobile-legend", $game) ? 'selected' : '' ?>>Mobile Legends</option>
                <option value="pubg" <?= in_array("pubg", $game) ? 'selected' : '' ?>>PUBG</option>
                <option value="dota_2" <?= in_array("dota_2", $game) ? 'selected' : '' ?>>DOTA 2</option>
                <option value="free_fire" <?= in_array("free_fire", $game) ? 'selected' : '' ?>>Free Fire</option>
                <option value="aov" <?= in_array("aov", $game) ? 'selected' : '' ?>>AOV</option>
                <option value="apex_legends" <?= in_array("apex_legends", $game) ? 'selected' : '' ?>>Apex Legends</option>
                <option value="call_of_duty" <?= in_array("call_of_duty", $game) ? 'selected' : '' ?>>Call Of Duty</option>
                <option value="cs_go" <?= in_array("cs_go", $game) ? 'selected' : '' ?>>CS Go</option>
                <option value="point_blank" <?= in_array("point_blank", $game) ? 'selected' : '' ?>>Point Blank</option>
                <option value="fifa" <?= in_array("fifa", $game) ? 'selected' : '' ?>>FIFA</option>
                <option value="nba" <?= in_array("nba", $game) ? 'selected' : '' ?>>NBA</option>
                <option value="league_of_legends" <?= in_array("league_of_legends", $game) ? 'selected' : '' ?>>League Of Legends</option>
                <option value="valorant" <?= in_array("valorant", $game) ? 'selected' : '' ?>>Valorant</option>
                <option value="pokemon" <?= in_array("pokemon", $game) ? 'selected' : '' ?>>Pokemon</option>
                <option value="pes" <?= in_array("pes", $game) ? 'selected' : '' ?>>PES</option>
                <option value="magic_chess" <?= in_array("magic_chess", $game) ? 'selected' : '' ?>>Magic Chess</option>
                <option value="genshin_impact" <?= in_array("genshin_impact", $game) ? 'selected' : '' ?>>Genshin Impact</option>
                <option value="overwatch" <?= in_array("overwatch", $game) ? 'selected' : '' ?>>Overwatch</option>
                <option value="starrail" <?= in_array("starrail", $game) ? 'selected' : '' ?>>Starrail</option>
                <option value="minecraft" <?= in_array("minecraft", $game) ? 'selected' : '' ?>>Minecraft</option>
                <option value="fortnite" <?= in_array("fortnite", $game) ? 'selected' : '' ?>>Fortnite</option>
            </select>
          </div>
          <div id="availableBox">
            <input type="hidden" id="tanggal-input" name="tanggal-input" required>
          </div>
          <div class="p-3 bg-dark rounded-3 mt-3">
            <div class="mb-3">
              <label for="" class="form-label">Fee per play</label>
              <input
                class="form-control bg-dark text-white py-2"
                type="text"
                name="fee"
                required
                id="currency"
                value="<?= isset($option) ? $option['fee'] : '' ?>"
                placeholder="Rp99.000"
              />
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Time per period</label>
              <select class="form-select form-control bg-dark text-white py-2" name="time" required>
                <option value="10" <?= (isset($option) && $option['time'] == 10) ? 'selected' : '' ?>>10 Menit</option>
                <option value="20" <?= (isset($option) && $option['time'] == 20) ? 'selected' : '' ?>>20 Menit</option>
                <option value="30" <?= (isset($option) && $option['time'] == 30) ? 'selected' : '' ?>>30 Menit</option>
                <option value="45" <?= (isset($option) && $option['time'] == 45) ? 'selected' : '' ?>>45 Menit</option>
                <option value="60" <?= (isset($option) && $option['time'] == 60) ? 'selected' : '' ?>>60 Menit</option>
                <option value="90" <?= (isset($option) && $option['time'] == 90) ? 'selected' : '' ?>>90 Menit</option>
                <option value="120" <?= (isset($option) && $option['time'] == 120) ? 'selected' : '' ?>>120 Menit</option>
                <!-- <option value="">more than 2 hours</option> -->
              </select>
            </div>
          </div>

          <div class="p-3 bg-dark rounded-3 mt-3">
            <div class="mb-3">
              <label class="form-label"> Date available </label>
              <!-- Calendar Start -->
              <input type="date" id="selectedDate" name="selectedDate" hidden />
              <div class="bg-dark rounded-3">
                <div class="month calendarYearMonth">
                  <ul>
                    <li class="prev cursor__pointer" onclick="prevMonth()">
                      &#10094;
                    </li>
                    <li class="next cursor__pointer" onclick="nextMonth()">
                      &#10095;
                    </li>
                    <li id="yearMonth">DEC 2023</li>
                  </ul>
                </div>

                <ol class="calendarList1">
                  <li class="day-name">Sat</li>
                  <li class="day-name">Sun</li>
                  <li class="day-name">Mon</li>
                  <li class="day-name">Tue</li>
                  <li class="day-name">Wed</li>
                  <li class="day-name">Thu</li>
                  <li class="day-name">Fri</li>
                </ol>
                <ol class="days calendarList2" id="calendarList"></ol>
              </div>

              <!-- Calendar End -->
            </div>
          </div>
        </section>
        <!-- Summary End -->

        <button type="submit" class="btn btn-outline-light rounded-pill my-4 w-100">
          <?=  $option ? 'Edit' : 'Save' ?>
        </button>
        </form>
      </div>
    </section>

    <script>
      $(document).ready(function () {
        $('#currency').val(formatRupiah($('#currency').val(), 'Rp. '));
        $(".game-services__multiple").select2();
      });
      var tanggalArray = [
        <?php

          for($i = 0 ; $i < count($date) ; $i++) {
            echo "'".$date[$i]."',";
          }
          
          ?>
      ]; 
      $('#tanggal-input').val(tanggalArray)

      function checkAvailable(day, month,year){

        var tanggal = year+'-'+month+'-'+day+' 00:00:00'
        
        var index = tanggalArray.indexOf(tanggal);
        if (index === -1) {
          tanggalArray.push(tanggal);
          $("#textDate"+day).removeClass("not-available");
          $("#textDate"+day).addClass("available");
        } else {
          
          $("#textDate"+day).removeClass("available");
          $("#textDate"+day).addClass("not-available");
          tanggalArray.splice(index, 1);
          $('#tanggal-input').val('');
        }
        
        $('#tanggal-input').val(tanggalArray.join(','));
        console.log($('#tanggal-input').val());

      }
      
    $(document).ready(function () {
      makeCalendar(currentYear, currentMonth, availableDates);
    });
    const months = [
      { id: 1, name: 'Jan' },
      { id: 2, name: 'Feb' },
      { id: 3, name: 'Mar' },
      { id: 4, name: 'Apr' },
      { id: 5, name: 'May' },
      { id: 6, name: 'Jun' },
      { id: 7, name: 'Jul' },
      { id: 8, name: 'Aug' },
      { id: 9, name: 'Sep' },
      { id: 10, name: 'Oct' },
      { id: 11, name: 'Nov' },
      { id: 12, name: 'Dec' },
    ];
    var currentYear = new Date().getFullYear();
    var currentMonth = new Date().getMonth() + 1;

    function letsCheck(year, month) {
      var daysInMonth = new Date(year, month, 0).getDate();
      var firstDay = new Date(year, month, 1).getUTCDay();
      var array = {
        daysInMonth: daysInMonth,
        firstDay: firstDay,
      };
      return array;
    }

    function makeCalendar(year, month, availableDates) {
      var getChek = letsCheck(year, month);
      getChek.firstDay === 0 ? (getChek.firstDay = 7) : getChek.firstDay;
      $('#calendarList').empty();
      for (let i = 1; i <= getChek.daysInMonth; i++) {
        var isAvailable = isDateAvailable(year, month, i, availableDates);

        if (i === 1) {
          var div =
            '<li onclick="checkAvailable('+i+','+month+','+year+')" id="' +
            i +
            '" style="grid-column-start: ' +
            getChek.firstDay +
            ';"><span id="textDate'+i+'" class="' +
            (isAvailable ? 'available' : 'not-available') +
            '">1</span></li>';
        } else {
          var div =
            '<li onclick="checkAvailable('+i+','+month+','+year+')" id="' +
            i +
            '" ><span id="textDate'+i+'" class="' +
            (isAvailable ? 'available' : 'not-available') +
            '">' +
            i +
            '</span></li>';
        }
        $('#calendarList').append(div);
      }
        monthName = months.find((x) => x.id === month).name;
        $('#yearMonth').text(monthName + ' ' + year);
      }

      function isDateAvailable(year, month, day, availableDates) {
        var currentDate = new Date(year, month - 1, day);

        for (var i = 0; i < availableDates.length; i++) {
          var dateParts = availableDates[i].created_at.split(' ');
          var date = dateParts[0];
          var time = dateParts[1];

          var availableDate = new Date(date + 'T' + time);

          if (currentDate.toDateString() === availableDate.toDateString()) {
            return true; // Day is available
          }
        }

        return false; // Day is not available
      }

      function nextMonth() {
        currentMonth = currentMonth + 1;
        if (currentMonth > 12) {
          currentYear = currentYear + 1;
          currentMonth = 1;
        }
        $('#calendarList').empty();
        $('#yearMonth').text(currentYear + ' ' + currentMonth);
        makeCalendar(currentYear, currentMonth, availableDates);
      }

      function prevMonth() {
        currentMonth = currentMonth - 1;
        if (currentMonth < 1) {
          currentYear = currentYear - 1;
          currentMonth = 12;
        }
        $('#calendarList').empty();
        $('#yearMonth').text(currentYear + ' ' + currentMonth);
        makeCalendar(currentYear, currentMonth, availableDates);
      }

      // Example usage:
      var availableDates = [
        <?php
          
          for($i = 0 ; $i < count($date) ; $i++) {
            $dates = date_format(date_create($date[$i]),"Y-m-d H:i:s");
            echo "{ created_at: '".$dates."' },";
          }
          
          
          ?>
      ];

      $("#availableBtn").click(function() {

        if($("#textAvailable").text() === 'Available'){
          $("#textAvailable").text("Not Available")
          $("#textAvailable").css("color", "red");
          $("#available").val("not available")
        }else {
          $("#textAvailable").text("Available")
          $("#textAvailable").css("color", "green");
          $("#available").val("available")

        }
      })
      
      $('#currency').keyup(function() {
        // $('#currency').val('12312');
        // console.log('tes')
        $('#currency').val(formatRupiah($('#currency').val()));

      })

      function formatRupiah(angka){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   = number_string.split(','),
        sisa     = split[0].length % 3,
        rupiah     = split[0].substr(0, sisa),
        ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
        
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return  rupiah;
        }

    </script>
  </body>
</html>
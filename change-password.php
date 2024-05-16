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
    <title>Change Password</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="setting-account__security-settings.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Change Password</span>
          </a>
        </div>

        <!-- Summary Start -->
        <div class="p-3 bg-dark rounded-3 mt-3">
          <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input
              type="password"
              class="form-control bg-dark text-white py-2"
              name="current_password"
              id="current_password_inp"
            />
            <div class="invalid__text fs-7 d-none" id="error-current">Wrong Password</div>
            <div class="invalid__text fs-7 d-none" id="error-length-current">at least 8 characters</div>
          </div>
          <div class="mb-3 mt-4">
            <label class="form-label">New Password</label>
            <input
              type="password"
              class="form-control bg-dark text-white py-2"
              id="new_password_inp"
            />
            <div class="invalid__text fs-7 d-none" id="error-password">at least 8 characters</div>
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input
              type="password"
              class="form-control bg-dark text-white py-2"
              id="confirm_password_inp"
            />
            <div class="invalid__text fs-7 d-none" id="error-confirm">Confirm Password doesnt match</div>
          </div>
        </div>
        <!-- Summary End -->

        <button class="btn btn-primary rounded-pill my-4 w-100" id="btn-submit">Update</button>
      </div>
    </section>
  </body>

  <script>
    const btn_submit = document.getElementById("btn-submit")
    const err_password = document.getElementById("error-password")
    const err_confirm = document.getElementById("error-confirm")
    const err_current = document.getElementById("error-current")
    const err_length_current = document.getElementById("error-length-current")
    const inp_current = document.getElementById("current_password_inp")
    const inp_new = document.getElementById("new_password_inp")
    const inp_confirm = document.getElementById("confirm_password_inp")

    btn_submit.addEventListener("click", () => {
      if(inp_current.value.length < 8) {
        err_length_current.classList.remove("d-none")
      } else {
        err_length_current.classList.add("d-none")
      }

      if(inp_new.value.length < 8) {
        err_password.classList.remove("d-none")
      } else {
        err_password.classList.add("d-none")
      }

      if(inp_confirm.value != inp_new.value) {
        err_confirm.classList.remove("d-none")
      } else {
        err_confirm.classList.add("d-none")
      }

      if(inp_current.value.length >= 8 && inp_new.value.length >= 8 && inp_confirm.value == inp_new.value) {
        fetch("change-password-process.php", { method: 'POST', body: JSON.stringify({ current_password: inp_current.value, new_password: inp_new.value }), headers: {
          "Content-Type": "application/json",
          "Accept":       "application/json"
        }, })
        .then(function (response) {
          return response.json();
        })
        .then(function (body) {
          if(body.status) {
            err_current.classList.add("d-none")

            alert("Password berhasil dirubah.")

            inp_current.value = ""
            inp_new.value = ""
            inp_confirm.value = ""
          } else {
            err_current.classList.remove("d-none")
          }
        });
      }
    })
  </script>
</html>

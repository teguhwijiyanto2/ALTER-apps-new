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
        <title>Account Settings</title>
    </head>

    <body>
        <section>
        <div class="container px-4">
            <div class="py-3">
            <a href="account.php">
                <i class="bi bi-chevron-left fs-5 me-2"></i>
                <span>Account Settings</span>
            </a>
            </div>

            <!-- Summary Start -->
            <section class="d-flex flex-column gap-2">
            <a href="setting-account__login-credentials.php">
                <div
                class="p-3 bg-dark rounded-3 d-flex flex-row align-items-center justify-content-between"
                >
                <div>
                    <h6>Login Credentials</h6>
                    <div class="text-secondary fs-7 lh-1">
                    review and manage crucial details associated with your
                    account, such as phone numbers and email addresses.
                    </div>
                </div>
                <i class="bi bi-chevron-right"></i>
                </div>
            </a>
            <a href="setting-account__security-settings.php">
                <div
                class="p-3 bg-dark rounded-3 d-flex flex-row align-items-center justify-content-between"
                >
                <div>
                    <h6>Security Settings</h6>
                    <div class="text-secondary fs-7 lh-1">
                    Customize security preferences to ensure the safety of your
                    personal information and activities.
                    </div>
                </div>
                <i class="bi bi-chevron-right"></i>
                </div>
            </a>
            <a href="subscriptions.php">
                <div
                class="p-3 bg-dark rounded-3 d-flex flex-row align-items-center justify-content-between"
                >
                <div>
                    <h6>Subscriptions</h6>
                    <div class="text-secondary fs-7 lh-1">
                    oversee and manage your app's subscription details.
                    </div>
                </div>
                <i class="bi bi-chevron-right"></i>
                </div>
            </a>
            <a href="">
                <div
                class="p-3 bg-dark rounded-3 d-flex flex-row align-items-center justify-content-between"
                >
                <div>
                    <h6>Data and Privacy</h6>
                    <div class="text-secondary fs-7 lh-1">
                    manage how your data is handled, ensuring confidentiality
                    </div>
                </div>
                <i class="bi bi-chevron-right"></i>
                </div>
            </a>
            </section>
            <!-- Sound Alert End -->
        </div>
        </section>
    </body>
</html>

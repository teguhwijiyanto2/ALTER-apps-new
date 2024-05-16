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
    <title>Profile - Alter</title>
  </head>

  <body>
    <!-- Header Start -->
    <section class="position-relative">
      <div
        class="p-3 w-100"
        style="
          background-image: url('https://placehold.co/600x200.png');
          background-repeat: no-repeat;
          background-size: cover;
          background-position: center;
          height: 200px;
        "
      ></div>
    </section>
    <!-- Header End -->

    <!-- Navbar Top Start -->
    <div
      id="navbar-top"
      class="fixed-top max-w-sm d-flex p-3 flex-row align-items-center gap-2"
      style="transition: all 200ms"
    >
      <a
        href="home.php"
        class="rounded-circle bg-dark d-flex align-items-center justify-content-center"
        style="height: 36px; width: 36px"
      >
        <i class="bi bi-chevron-left"></i>
      </a>
      <div
        class="d-flex flex-fill flex-row align-items-center border border-secondary rounded-pill px-3 py-1 gap-3 bg-dark bg-opacity-50"
      >
        <i class="bi bi-search fs-5 text-secondary"></i>
        <input
          placeholder="Search in Alter Member"
          class="bg-transparent border-0 w-100 text-light"
        />
      </div>
      <div
        class="rounded-circle bg-dark bg-opacity-50 d-flex align-items-center justify-content-center"
        style="height: 36px; width: 36px"
      >
        <i class="bi bi-chat-square-dots-fill fs-5"></i>
      </div>
      <div
        class="rounded-circle bg-dark bg-opacity-50 d-flex align-items-center justify-content-center"
        style="height: 36px; width: 36px"
      >
        <i class="bi bi-bell-fill fs-5"></i>
      </div>
    </div>
    <!-- Navbar Top End -->

    <!-- User Profile Start -->
    <section>
      <div class="container">
        <div class="d-flex flex-row align-items-end gap-2">
          <div class="z-2">
            <div
              class="border border-black rounded-circle pro__border"
              style="margin-top: -45px"
            >
              <img
                src="https://placehold.co/150x150.png"
                alt=""
                class="rounded-circle ratio-1x1"
                width="100"
                height="100"
              />
            </div>
            <div class="text-center" style="margin-top: -15px">
              <span class="pro__tag" style="font-size: 11pt">Pro</span>
            </div>
          </div>
          <div class="flex-fill"></div>
          <div
            class="bg-dark d-flex align-items-center justify-content-center rounded-circle"
            style="width: 44px; height: 44px"
          >
            <i class="bi bi-person-slash fs-3"></i>
          </div>
          <button class="btn btn-primary rounded-pill py-2 px-4">Follow</button>
        </div>

        <div class="mt-4">
          <div class="d-flex flex-row align-items-center gap-1">
            <div class="text__purple fs-3 lh-1">Alter Member</div>
            <img
              src="assets/icon/ic__star-gold.png"
              alt=""
              class="object-fit-contain"
              height="32"
              width="32"
            />
          </div>
          <small>Indonesia/English</small>
          <div class="d-flex flex-row align-items-center gap-2 mt-2">
            <div
              class="d-flex flex-row align-items-center gap-2 bg-dark px-2 rounded-pill"
              style="width: fit-content"
            >
              <div
                class="rounded-circle"
                style="width: 10px; height: 10px; background-color: green"
              ></div>
              <span><small>Online</small></span>
            </div>
            <div
              class="d-flex flex-row align-items-center gap-2 bg-dark px-2 rounded-pill"
              style="width: fit-content"
            >
              <i class="bi bi-gender-male"></i>
              <span><small>21</small></span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- User Profile End -->

    <!-- User Tab Profile Start -->
    <section class="mt-4">
      <div class="row g-0">
        <div class="col-4">
          <div data-tab="post" class="up__tab-item active">Post</div>
        </div>
        <div class="col-4">
          <div data-tab="stats" class="up__tab-item">Stats</div>
        </div>
        <div class="col-4">
          <div data-tab="review" class="up__tab-item">Review</div>
        </div>
      </div>
    </section>
    <!-- User Tab Profile End -->

    <!-- Post Section Start -->
    <section id="post" class="tab__content d-block">
      <div class="container">
        <!-- Post Status Start -->
        <div
          class="d-flex flex-row align-items-center bg-dark rounded-3 p-3 gap-3 mt-3"
        >
          <img
            src="https://placehold.co/48x48.png"
            alt=""
            height="48"
            width="48"
            class="rounded-circle object-fit-cover"
          />
          <input
            type="text"
            class="bg-transparent border-0 text-light flex-fill"
            style="outline: none"
            placeholder="Write something to alter..."
          />

          <label for="image" style="cursor: pointer">
            <svg
              width="24"
              height="24"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <g clip-path="url(#clip0_12_715)">
                <path
                  d="M18.3334 10.0001C18.3334 13.9284 18.3334 15.8926 17.1125 17.1126C15.8934 18.3334 13.9284 18.3334 10 18.3334C6.07169 18.3334 4.10752 18.3334 2.88669 17.1126C1.66669 15.8934 1.66669 13.9284 1.66669 10.0001C1.66669 6.07175 1.66669 4.10758 2.88669 2.88675C4.10835 1.66675 6.07169 1.66675 10 1.66675"
                  stroke="#EDEDED"
                  stroke-width="1.5"
                  stroke-linecap="round"
                />
                <path
                  d="M1.66669 10.4167L3.12669 9.13925C3.49263 8.81931 3.96647 8.65036 4.45229 8.66661C4.9381 8.68285 5.3996 8.88308 5.74335 9.22675L9.31835 12.8017C9.59578 13.0791 9.96215 13.2497 10.353 13.2836C10.7438 13.3174 11.1341 13.2123 11.455 12.9867L11.7042 12.8117C12.1672 12.4866 12.7268 12.3281 13.2915 12.3621C13.8563 12.3962 14.3928 12.6208 14.8134 12.9992L17.5 15.4167M12.5 4.58341H15.4167M15.4167 4.58341H18.3334M15.4167 4.58341V7.50008M15.4167 4.58341V1.66675"
                  stroke="#EDEDED"
                  stroke-width="1.5"
                  stroke-linecap="round"
                />
              </g>
              <defs>
                <clipPath id="clip0_12_715">
                  <rect width="20" height="20" fill="white" />
                </clipPath>
              </defs>
            </svg>
          </label>
          <input type="file" class="d-none" id="image" />
        </div>
        <!-- Post Status End -->

        <!-- Post Card Start -->
        <section class="post__wrapper">
          <div
            id="1"
            class="post__item position-relative p-3 bg-dark rounded-3 mt-3"
          >
            <div class="d-flex flex-row align-items-center gap-3">
              <img
                src="https://placehold.co/48x48.png"
                alt=""
                height="48"
                width="48"
                class="rounded-circle object-fit-cover"
              />
              <div class="flex-fill">
                <div class="fs-6 lh-1">Alter Member</div>
                <span class="text-secondary" style="font-size: 10pt"
                  >27 Oct 23.22 PM</span
                >
              </div>
              <div class="popup-post__toggle btn btn-dark p-0">
                <i class="bi bi-three-dots-vertical fs-5"></i>
              </div>
            </div>

            <div class="mt-3">
              <p>
                Blasting everything with amber, not that bad. Tho I would
                recommend another character like...
                <a href="" class="text-secondary">See more</a>
              </p>
              <img
                src="https://placehold.co/400x300.png"
                alt=""
                class="w-100 object-fit-cover"
                style="max-height: 250px"
              />
              <div
                class="d-flex flex-row align-items-center justify-content-end gap-3 my-2"
              >
                <button class="btn text-secondary p-0 fs__7">21 Likes</button>
                <button class="btn text-secondary p-0 fs__7">2 Comment</button>
                <button class="btn text-secondary p-0 fs__7">262 Views</button>
              </div>
              <div class="row border-top border-dark-subtle">
                <div class="col-4 post__footer-item">
                  <div
                    class="d-flex py-2 px-0 flex-row align-items-center justify-content-start gap-2 fs-6"
                  >
                    <i class="bi bi-hand-thumbs-up fs-4"></i>
                    <div>Like</div>
                  </div>
                </div>
                <div class="col-4 post__footer-item">
                  <div
                    id="btn-comment"
                    class="d-flex py-2 px-0 flex-row align-items-center justify-content-center gap-2 fs-6"
                  >
                    <i class="bi bi-chat-dots fs-4"></i>
                    <div>Comment</div>
                  </div>
                </div>
                <div class="col-4 post__footer-item">
                  <div
                    class="d-flex py-2 px-0 flex-row align-items-center justify-content-end gap-2 fs-6"
                  >
                    <i class="bi bi-send fs-4"></i>
                    <div>Share</div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Popup Three Dots Post Start -->
            <div
              class="popup-post__modal position-absolute bg-dark shadow-lg border border-secondary border-opacity-25 rounded-4 rounded-top-0 rounded-start-4 overflow-hidden"
              style="top: 60px; right: 16px; display: none"
            >
              <button
                class="report-btn btn btn-dark py-1 px-4 d-block w-100 text-start"
              >
                Report
              </button>
              <button
                class="bookmark-btn btn btn-dark py-1 px-4 d-block w-100 text-start"
              >
                Bookmark
              </button>
            </div>
            <!-- P  opup Three Dots Post End -->
          </div>
        </section>
        <!-- Post Card End -->
      </div>
    </section>
    <!-- Post Section End -->

    <!-- Stats Section Start -->
    <section id="stats" class="tab__content d-none">
      <div class="container">
        <!-- Profile Start -->
        <div class="p-3 bg-dark rounded-3 mt-3">
          <h4>Profile</h4>
          <div class="row mt-3">
            <div class="col-4">
              <span class="text-secondary fs-small">Followers</span>
              <h6>4.2K</h6>
            </div>
            <div class="col-4">
              <span class="text-secondary fs-small">Following</span>
              <h6>890</h6>
            </div>
            <div class="col-4">
              <span class="text-secondary fs-small">Profile Views</span>
              <h6>89.2K</h6>
            </div>
          </div>
          <div class="border-top border-bottom border-secondary pt-3 pb-1 my-3">
            <h6>Bio</h6>
            <p class="text-secondary">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Delectus, sit fugit blanditiis repellendus autem saepe iusto
              repellat provident eius minus.
            </p>
          </div>
          <div>
            <h6>Social Media</h6>
            <div class="row row-cols-auto g-2">
              <div class="col">
                <a
                  href="#"
                  class="social__media-icon rounded-circle bg-secondary"
                >
                  <i class="bi bi-instagram fs-5"></i>
                </a>
              </div>
              <div class="col">
                <a
                  href="#"
                  class="social__media-icon rounded-circle bg-secondary"
                >
                  <i class="bi bi-twitter-x fs-5"></i>
                </a>
              </div>
              <div class="col">
                <a
                  href="#"
                  class="social__media-icon rounded-circle bg-secondary"
                >
                  <i class="bi bi-twitch fs-5"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- Profile End -->

        <!-- Game Stats Start -->
        <div class="p-3 bg-dark rounded-3 mt-3">
          <h4>Game Stats</h4>
          <div class="row mt-3">
            <div class="col-4">
              <span class="text-secondary fs-small">Game Stats</span>
              <h6>2000 hr</h6>
            </div>
            <div class="col-4">
              <span class="text-secondary fs-small">Total Wins</span>
              <h6>211</h6>
            </div>
            <div class="col-4">
              <span class="text-secondary fs-small">Hours Co-Play</span>
              <h6>300hr</h6>
            </div>
          </div>
          <div class="border-top border-bottom border-secondary pt-3 pb-1 my-3">
            <h6>Favorite Games</h6>
            <p class="text-secondary">
              League of Legends, Genshin Impact, Valorant, Arena of Valor,
              Minecraft
            </p>
          </div>
          <div>
            <h6>Total Successful Co-Play</h6>
            <p class="text-secondary">600 plays</p>
          </div>
        </div>
        <!-- Game Stats End -->

        <!-- Badges Start -->
        <div class="p-3 bg-dark rounded-3 mt-3">
          <h4>Badges</h4>
          <div class="row g-3 mt-3">
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain opacity-50"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain opacity-50"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain opacity-50"
              />
            </div>
          </div>
        </div>
        <!-- Badges End -->
      </div>
    </section>
    <!-- Stats Section End -->

    <!-- Review Section Start -->
    <section id="review" class="tab__content d-none">
      <div class="container border-bottom pb-3 border-secondary">
        <!-- Profile Start -->
        <a href="review.php">
          <div class="p-3 bg-dark rounded-3 mt-3">
            <div class="fs-5">Rate and review</div>
            <span class="text-secondary">Share your play experience</span>
            <div class="d-flex flex-row align-items-center gap-3 mt-3">
              <img
                src="https://placehold.co/100x100.png"
                width="48"
                height="48"
                alt=""
                class="object-fit-cover rounded-circle"
              />
              <div class="d-flex flex-row align-items-center gap-2">
                <i class="bi bi-star fs-4"></i>
                <i class="bi bi-star fs-4"></i>
                <i class="bi bi-star fs-4"></i>
                <i class="bi bi-star fs-4"></i>
                <i class="bi bi-star fs-4"></i>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="container mt-4">
        <h5>Sort by</h5>
        <div class="d-inline">
          <button
            id="sortLatest"
            class="sort__btn btn btn-primary fs-small px-4 py-0 rounded-pill"
          >
            Latest
          </button>
          <button
            id="sortHighest"
            class="sort__btn btn btn-dark fs-small px-4 py-0 rounded-pill"
          >
            Highest
          </button>
          <button
            id="sortLowest"
            class="sort__btn btn btn-dark fs-small px-4 py-0 rounded-pill"
          >
            Lowest
          </button>
        </div>

        <div id="feedback__wrapper">
          <div class="feedback_item p-3 bg-dark rounded-3 mt-3">
            <div class="d-flex flex-row align-items-center gap-3">
              <img
                src="https://placehold.co/48x48.png"
                alt=""
                height="48"
                width="48"
                class="rounded-circle object-fit-cover"
              />
              <div class="flex-fill">
                <div class="fs-6 lh-1">Alter Member</div>
                <span
                  id="date-post"
                  class="text-secondary"
                  style="font-size: 10pt"
                  >27 Oct 2023 20:23</span
                ><span style="font-size: 10pt" class="text-secondary"> PM</span>
              </div>
              <button class="btn btn-dark p-0">
                <i class="bi bi-three-dots-vertical fs-5"></i>
              </button>
            </div>

            <div class="mt-3">
              <div class="d-flex flex-row align-items-center gap-3">
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star fs-3"></i>
              </div>
              <p class="text-secondary">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Corporis maxime consequatur consequuntur sint at commodi.
              </p>
            </div>
          </div>
          <div class="feedback_item p-3 bg-dark rounded-3 mt-3">
            <div class="d-flex flex-row align-items-center gap-3">
              <img
                src="https://placehold.co/48x48.png"
                alt=""
                height="48"
                width="48"
                class="rounded-circle object-fit-cover"
              />
              <div class="flex-fill">
                <div class="fs-6 lh-1">Alter Member</div>
                <span
                  id="date-post"
                  class="text-secondary"
                  style="font-size: 10pt"
                  >28 Oct 2023 20:23</span
                ><span style="font-size: 10pt" class="text-secondary"> PM</span>
              </div>
              <button class="btn btn-dark p-0">
                <i class="bi bi-three-dots-vertical fs-5"></i>
              </button>
            </div>

            <div class="mt-3">
              <div class="d-flex flex-row align-items-center gap-3">
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
              </div>
              <p class="text-secondary">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Corporis maxime consequatur consequuntur sint at commodi.
              </p>
            </div>
          </div>
          <div class="feedback_item p-3 bg-dark rounded-3 mt-3">
            <div class="d-flex flex-row align-items-center gap-3">
              <img
                src="https://placehold.co/48x48.png"
                alt=""
                height="48"
                width="48"
                class="rounded-circle object-fit-cover"
              />
              <div class="flex-fill">
                <div class="fs-6 lh-1">Alter Member</div>
                <span
                  id="date-post"
                  class="text-secondary"
                  style="font-size: 10pt"
                  >29 Oct 2023 20:23</span
                ><span style="font-size: 10pt" class="text-secondary"> PM</span>
              </div>
              <button class="btn btn-dark p-0">
                <i class="bi bi-three-dots-vertical fs-5"></i>
              </button>
            </div>

            <div class="mt-3">
              <div class="d-flex flex-row align-items-center gap-3">
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star fs-3"></i>
                <i class="bi bi-star fs-3"></i>
              </div>
              <p class="text-secondary">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Corporis maxime consequatur consequuntur sint at commodi.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Review Section End -->

    <!-- Spacer -->
    <div style="height: 100px"></div>

    <!-- Floating Footer Start -->
    <div
      class="fixed-bottom max-w-sm p-3 bg-dark border-top border-white border-opacity-10"
    >
      <div class="row">
        <div class="col-6">
          <a
            href="chat-room.php"
            class="btn btn-outline-light rounded-pill w-100"
            >Chat</a
          >
        </div>
        <div class="col-6">
          <a
            href="play-regist__paid.php"
            class="btn btn-primary w-100 rounded-pill"
            >Play</a
          >
        </div>
      </div>
    </div>
    <!-- Floating Footer End -->

    <!-- Popup Comment Start -->
    <div
      id="popup-comment"
      class="fixed-bottom z-5 max-w-sm bg-dark h-75 shadow-lg rounded-top-4"
      style="display: none"
    >
      <div
        class="sticky-top bg-dark text-center py-4 border-bottom border-secondary"
      >
        <span class="ps-5"> Comments </span>
        <i
          id="close-comment"
          class="bi bi-x-lg float-end pe-3 cursor__pointer"
        ></i>
      </div>

      <div class="comment__wrapper">
        <div class="comment__item d-flex flex-row gap-3 px-3 pt-3">
          <img
            src="https://placehold.co/48x48.png"
            width="48"
            height="48"
            class="rounded-circle"
          />
          <div>
            <span class="fs-6">Tiger</span>
            <div class="text-light" style="font-size: 10pt">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex,
              suscipit!
            </div>
            <span
              id="reply-comment"
              class="text-secondary cursor__pointer"
              style="font-size: 10pt"
              >Reply</span
            >
            <div
              id="reply-comment__total"
              class="text-secondary cursor__pointer d-flex flex-row align-items-center gap-2"
              style="font-size: 10pt"
            >
              <div
                class="bg-secondary bg-opacity-50 d-inline-block"
                style="width: 2rem; height: 1px"
              ></div>
              View 1 replies
            </div>
            <div class="reply-comment__wrapper d-none">
              <div class="reply-comment__item d-flex flex-row gap-3 pt-3">
                <img
                  src="https://placehold.co/36x36.png"
                  width="36"
                  height="36"
                  class="rounded-circle"
                />
                <div>
                  <span class="fs-6">Tiger</span>
                  <div class="text-light" style="font-size: 10pt">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Exercitationem architecto iure, voluptate magni itaque quia
                    rerum facere nostrum saepe in repellat libero sed quae
                    minima rem quas provident eos nisi quasi numquam. Dicta non
                    quisquam magni ipsam minima hic praesentium!
                  </div>
                  <span
                    id="reply-comment"
                    class="text-secondary cursor__pointer"
                    style="font-size: 10pt"
                    >Reply</span
                  >
                  <div class="ms-4"></div>
                </div>
              </div>
              <div class="reply-comment__item d-flex flex-row gap-3 pt-3">
                <img
                  src="https://placehold.co/36x36.png"
                  width="36"
                  height="36"
                  class="rounded-circle"
                />
                <div>
                  <span class="fs-6">Tiger</span>
                  <div class="text-light" style="font-size: 10pt">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex,
                    suscipit!
                  </div>
                  <span
                    id="reply-comment"
                    class="text-secondary cursor__pointer"
                    style="font-size: 10pt"
                    >Reply</span
                  >
                  <div class="ms-4"></div>
                </div>
              </div>
              <div class="reply-comment__item d-flex flex-row gap-3 pt-3">
                <img
                  src="https://placehold.co/36x36.png"
                  width="36"
                  height="36"
                  class="rounded-circle"
                />
                <div>
                  <span class="fs-6">Tiger</span>
                  <div class="text-light" style="font-size: 10pt">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex,
                    suscipit!
                  </div>
                  <span
                    id="reply-comment"
                    class="text-secondary cursor__pointer"
                    style="font-size: 10pt"
                    >Reply</span
                  >
                  <div class="ms-4"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="py-5"></div>
      <form
        class="fixed-bottom max-w-sm d-flex flex-row align-items-center gap-3 bg-dark p-3 shadow-lg"
      >
        <img
          src="https://placehold.co/48x48.png"
          width="48"
          height="48"
          class="rounded-circle"
        />
        <input
          type="text"
          class="w-100 bg-transparent border-0 text-white"
          style="outline: none"
          placeholder="add a comment for  Alter Member..."
        />
        <button
          type="submit"
          class="btn btn-primary rounded-pill d-inline-block px-4 py-2"
        >
          Send
        </button>
      </form>
    </div>
    <!-- Popup Comment End -->

    <div style="height: 120px"></div>

    <script>
      $(document).ready(function () {
        $(window).scroll(function (e) {
          var offsetY = $(this).scrollTop();
          if (offsetY > 150) {
            $('#navbar-top').addClass('bg-dark shadow');
          } else {
            $('#navbar-top').removeClass('bg-dark shadow');
          }
        });

        $('.up__tab-item').on('click', function () {
          // Remove the "active" class from all tab items
          $('.up__tab-item').removeClass('active');

          // Add the "active" class to the clicked tab
          $(this).addClass('active');

          const tabId = $(this).data('tab');
          $('.tab__content').removeClass('d-block');
          $('.tab__content').removeClass('d-none');
          $('#' + tabId).addClass('d-block');
        });

        // Function to sort and update feedback items
        function sortAndUpdateFeedbackItems(sortFunction) {
          const feedbackItems = $('.feedback_item');
          feedbackItems.sort(sortFunction);
          feedbackItems.detach();
          $('#feedback__wrapper').append(feedbackItems);
        }

        // Button click events
        $('#sortLatest').click(function () {
          $('.sort__btn').removeClass('btn-primary');
          $('.sort__btn').addClass('btn-dark');
          $(this).addClass('btn-primary');
          // Example: sort by date
          sortAndUpdateFeedbackItems(function (a, b) {
            const dateA = new Date($(a).find('#date-post').text());
            const dateB = new Date($(b).find('#date-post').text());
            return dateB - dateA;
          });
        });

        $('#sortLowest').click(function () {
          $('.sort__btn').removeClass('btn-primary');
          $('.sort__btn').addClass('btn-dark');
          $(this).addClass('btn-primary');

          // Example: sort by lowest rating
          sortAndUpdateFeedbackItems(function (a, b) {
            const starsA = $(a).find('.bi-star-fill').length;
            const starsB = $(b).find('.bi-star-fill').length;
            return starsA - starsB;
          });
        });

        $('#sortHighest').click(function () {
          $('.sort__btn').removeClass('btn-primary');
          $('.sort__btn').addClass('btn-dark');
          $(this).addClass('btn-primary');
          // Example: sort by highest rating
          sortAndUpdateFeedbackItems(function (a, b) {
            const starsA = $(a).find('.bi-star-fill').length;
            const starsB = $(b).find('.bi-star-fill').length;
            return starsB - starsA;
          });
        });
      });
    </script>

    <!-- Comment Popup Start -->
    <script>
      $('#btn-comment').click(function () {
        $('#popup-comment').toggle();
      });
      $('#close-comment').click(function () {
        $('#popup-comment').toggle();
      });
      $();
      $('#reply-comment__total').click(function () {
        $(this).removeClass('d-flex');
        $(this).addClass('d-none');
        $('.reply-comment__wrapper').removeClass('d-none');
        $('.reply-comment__wrapper').addClass('d-block');
      });
    </script>
    <!-- Comment Popup Delete -->

    <!-- Post Card Popup More Three Dots  -->
    <script>
      $(document).ready(function () {
        $('.popup-post__toggle').click(function () {
          $(this).closest('.post__item').find('.popup-post__modal').toggle();
        });

        // Report button click functionality
        $('.report-btn').click(function () {
          var postItem = $(this).closest('.post__item');
          var postId = postItem.attr('id'); // You can use this ID to identify the specific post
          alert('Reporting post with ID: ' + postId);
          // Implement your report logic here
          postItem.find('.popup-post__modal').hide();
        });

        // Bookmark button click functionality
        $('.bookmark-btn').click(function () {
          var postItem = $(this).closest('.post__item');
          var postId = postItem.attr('id'); // You can use this ID to identify the specific post
          postItem.find('.popup-post__modal').hide();
          // Implement your bookmark logic here
          alert('Bookmarking post with ID: ' + postId);
        });
      });
    </script>
    <!-- Post Card Popup More Three Dots  -->
  </body>
</html>

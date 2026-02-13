<?php
  require('vendor/autoload.php');

  // Fetch bench location data from JSON file (see README.md for details)
  $bench_location_json_path = "./data/benches.json";
  $bench_location_contents = file_get_contents($bench_location_json_path);
  $results = json_decode($bench_location_contents, true);
?>
<!DOCTYPE html>
<html lang="en">

  <!--
  Future try:
  - the tiny text stack.
  - Try using petite-vue JS framework
  - ionic for mobile apps
  - Cloud firestore for database? Plus firebase for authentication.
  -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bill's Bus Benches</title>

  <!-- Page icon (placeholder) -->
  <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/1843/1843261.png"/>

  <!-- Boostrap script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <!-- Bootstrap icons (alternative to Font Awesome) -->
  <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.min.css">

  <!-- Custom Bootstrap-based Stylesheet -->
  <link rel="stylesheet" href="./style/custom_bootstrap.css">

  <!--Leaflet stylesheet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
  <!--Leaflet script -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <!-- Style for the map box on this page -->
  <link rel="stylesheet" href="./style/map.css">
</head>
<body>

  <!-- Page header -->
  <?php include_once("./components/header.php"); ?>

  <!-- Inject bench locations from PHP into javascript variable -->
  <?php
    echo "<script>const locations = " . json_encode($results) . ";</script>";
  ?>

  <!-- Banner -->
  <img src="./assets/images/Banner_Draft.png" alt="One of our bus bench builds" class="img-fluid w-100">

  <section id="about" class="bg-primary">
    <div class="container-lg pt-3">
      <div class="row justify-content-center">
        <div class="col-12 col-md-7 bg-white rounded-5"> <!--text-center text-md-start-->
          <div class="display-5 text-center py-3">About Us</div>
          <div class="px-3">
            <p>
              We are neighbors and builders who believe that the city of Milwaukee should be safe, accessible, and comfortable for everyone. Across our city and county, hundreds of bus stops are little more than a sign on the side of a busy road, without shelter or a place to sit. They fail to provide even the barest minimum of accessibility. No one should have to stand for twenty minutes in the sun or snow just to get around the city.
            </p>
            <!-- <h3 class="pt-3">Our Goal: One Hundred Benches</h3> -->
            <p>
              We believe in the value of shaping our own communities. That's why we have taken the construction of bus stop benches into our own hands. We are committing to building <b>one hundred benches</b> at bus stops across Milwaukee county.
            </p>
          </div>
        </div>  
        <div class="col-12 col-md-5">
          <img src="assets/images/20250330_154546.jpg" class="img-fluid rounded-5"></img>
        </div>
      </div>
    </div>
  </section>

  <section id="cards" class="bg-primary">
    <div class="container py-3">
      <div class="row align-center justify-content-center g-3 my-3"> <!-- align-center will center things vertically -->
        <div class="col-8 col-lg-4 d-flex align-items-stretch">
          <div class="card rounded-5"> <!-- maybe add border-0 -->
            <img src="assets/images/IMG_6569.jpg" class="card-img-top rounded-5" style="object-fit: cover; height: 200px" alt="...">
            <div class="card-body text-center">
              <h4 class="card-title">Support Us</h4>
              <p class="card-text">All contributions go directly towards purchasing materials for our benches. Every little bit counts towards making Milwaukee a more accessible place.</p>
              <a class="btn btn-primary fs-4 mx-5 mb-3 px-4 py-2 rounded-pill" href="https://paypal.me/BillsBenches?country.x=US&locale.x=en_US">
            Donate
          </a>
            </div>
          </div>
        </div>
        <div class="col-8 col-lg-4 d-flex align-items-stretch">
          <div class="card rounded-5">
            <img src="assets/images/20250330_153259.jpg" class="card-img-top rounded-5" style="object-fit: cover; height: 200px" alt="...">
            <div class="card-body text-center">
              <h4 class="card-title">Get Involved</h4>
              <p class="card-text">Whether you are a leader in your community, or a neighbor who believes in what we are doing, we need your help. Fill out our contact form, or email us at <a href="mailto://billsbusbenches@gmail.com">billsbusbenches@gmail.com</a>.</p>
              <a href="#contact" class="btn btn-warning fs-4 mx-5 mb-3 px-4 py-2 rounded-pill">Learn more</a>
            </div>
          </div>
        </div>
        <div class="col-8 col-lg-4 d-flex align-items-stretch">
          <div class="card rounded-5">
            <img src="assets/images/20260125_144047.jpg" class="card-img-top rounded-5" style="object-fit: cover; height: 200px" alt="...">
            <div class="card-body text-center">
              <h4 class="card-title">Learn More</h4>
              <p class="card-text">Curious about how we build our benches? All of the bench blueprints we use are available online!</p>
              <a href="https://rogueengineer.com/diy-outdoor-bench-plans-with-back/" class="btn btn-info fs-4 mx-5 mb-3 px-4 py-2 rounded-pill">Guides</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="mapsection">
    <div class="container-fluid py-3 bg-primary">
      <div class="row bg-primary justify-content-center">
        <h1 class="display-5 text-center py-3 text-white">Our Impact In Milwaukee</h1>
        <div class="col-md-6">
          <div>
            <div class="map justify-content-center py-3" id="map"><!--This id must match the map's id in the js file-->
              <script type="text/javascript" src="mapbuild.js"></script>
            </div>
          </div>
        </div>
        <div class="col-md-3 py-3 my-5 bg-white rounded-5" style="">
          <h3 class="text-center">Key</h3>
          <p>
            <img src="./assets/icons/icon_blue.png" width="20" height="20">
            Completed bench
            <br>
            <img src="./assets/icons/icon_yellow.png" width="20" height="20">
            Bench is in need of repairs
            <br>
            <img src="./assets/icons/icon_red.png" width="20" height="20">
            Bench is missing
            <!-- <br>
            <img src="./assets/icons/icon_gray.png" width="20" height="20">
            Planned future benches -->
          </p>
        </div>
      </div>
    </div>
  </section>

  <section id="faq" class="bg-primary">
    <div class="container-lg pt-3 pb-3">
      <div class="row justify-content-center text-center">
        <div class="col-md-10 col-lg-8">
          <div class="display-5 text-center text-white py-3">Frequently Asked Questions</div>
        </div>
      </div>
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="questionOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              How can I get a bus bench at a stop near me?
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="questionOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>
                If you want a bench at a stop near you, all you have to do is contact us and we will get a bench out there as soon as we can. We are working with neighborhood associations and community groups to get benches to the places in Milwaukee where people need them the most. If you would like to see bus benches installed in your neighborhood, we'd love for you to send us an email or fill out our contact form!
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="questionTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              How can I help out?
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="questionTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>
                The best way you can help is by keeping an eye out for benches that might be damaged or missing. While we do our best to keep an eye on the benches we put out, Milwaukee is a big city, and we can't be everywhere at once. If you see a bench that is missing or damaged, please send us an email. It really helps us out!
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              How can I get involved with the bench-building team?
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>
                If you'd like to join our team, we can use all the help we can get. We are a small team of volunteers, and as this project grows, we are going to need people to write grants, help make repairs, transport benches, and manage our website. We would love for you to be a part of this effort to make Milwaukee a more accessible place.
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              Won't these benches just get stolen?
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>
                Surprisingly, no! We've had benches out for months and months, on busy roads and in quiet neighborhoods, and we have rarely seen benches stolen. Typically when a bench is out of order, it's from typical wear-and-tear. We are constantly workshopping our design to make it more resilient to the cold Milwaukee winters.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="contact" class="bg-primary">
    <div class="container-xl text-white">
      <h1 class="display-5 text-center py-3">Contact Us</h1>
      <!-- <form action="/formsubmit.php" method="POST"> -->
      <form action="/emailsubmit.php" method="POST">
        <div class="form-group row justify-content-center py-2">
          <div class="col-sm-6 col-md-4"> <!-- Take up whole row up to "small" threshold -->
            <label for="firstname">First Name*:</label>
            <input class="form-control" name="firstname" id="firstname" required>
          </div>
          <div class="col-sm-6 col-md-4"> <!-- At "small" threshold, group with firstname -->
            <label for="lastname">Last Name:</label>
            <input class="form-control" name="lastname" id="lastname">
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="form-group py-2">
              <label for="email">Email address*:</label>
              <input class="form-control" name="email" type="email" id="email" required>
            </div>
            <div class="form-group py-2">
              <label for="reason">Reason for reaching out (choose one)*</label>
              <select class="form-control" name="reason" id="reason">
                <option>Request a bench</option>
                <option>Report a broken bench</option>
                <option>Get involved</option>
                <option>Contribute materials</option>
                <option>Other</option>
              </select>
            </div>
            <div class="form-group py-2">
              <label for="message">Message*</label>
              <textarea class="form-control" name="message" id="message" rows="3" required></textarea>
            </div>
          </div> 
        </div>
        <div class="row justify-content-center">
          <div class="col-8 justify-content-center text-center py-2">
            <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
          </div>
        </div>
      </form> 
    </div>
  </section>

  <section id="supporters" class="bg-primary">
    <div class="container-xl bg-white rounded-5 pb-3">
      <div class="row text-center justify-content-center">
        <div class="col-md-10 col-lg-8">
          <h1 class="display-5 text-center py-3">Our Supporters</h1>
        </div>
      </div>
      <div class="row text-center justify-content-center">
        <div class="col-md-10 col-lg-8">
          <img src="./assets/images/logo__bliffert.png" alt="Logo for Bliffert Co., one of our sponsors" class="img-fluid mx-5 mb-3 px-4 py-2">
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
          <p>
            Thank you to Bliffert Lumber & Hardware for donating lumber to be used for our bench-building efforts! Thanks to them, we have been able to replace some of our original benches with a sturdier design, as well as expand to new locations.
          </p>
        </div>
      </div>
    </div>
  </section>

  <?php include_once("./components/footer.php"); ?>

</body>
</html>

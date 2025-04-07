<?php
  require('vendor/autoload.php');

  // Fetch bench location data from JSON file in a non-public directory (see README for details)
  $bench_location_json_path = "../benches.json";
  $bench_location_contents = file_get_contents($bench_location_json_path);
  $results = json_decode($bench_location_contents, true);

  $faker = Faker\Factory::create()
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

  <!-- Bootstrap stylesheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Boostrap script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <!--Leaflet stylesheet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
  <!--Leaflet script -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <!-- Style for the map box on this page -->
  <link rel="stylesheet" href="custom.css">
</head>
<body>
  <!-- Inject bench locations from PHP into javascript variable -->
  <?php
    echo "<script>const locations = " . json_encode($results) . ";</script>";
  ?>

  <!-- Main Title (above navbar) -->
  <div class="container-md">
    <div class="row justify-content-center">
      <div class="col-md-8 py-5">
        <h1 class="">Bill's Bus Benches</h1>
        <p class="text-secondary">
          <!--Subtitle here?-->
        </p>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <!-- navbar-expand-md means the navbar should expand to fill if screen is larger than medium-sized. Otherwise, put the buttons in a hamburger. -->
    <div class="container-xxl">
      <!-- Main title with link -->
      
      <!--
      <a href="#mapsection" class="navbar-brand">
        <span class="fw-bold text-secondary">
          Bill's Bus Benches
        </span>
      </a>
      -->

      <!-- Toggle button for mobile nav -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Aria things are for screen readers -->

      <!-- Here are all of the links that can be collapsed into a hamburger menu -->
      <div class="collapse navbar-collapse justify-content-center align-center" id="main-nav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="#support-us" class="nav-link">Donate</a>
          </li>
          <li class="nav-item">
            <a href="#about" class="nav-link">About</a>
          </li>
          <li>
            <a href="#get-involved" class="nav-link">Get Involved</a>
          </li>
          <li>
            <a href="#mapsection" class="nav-link">Map</a>
          </li>
          <li>
            <a href="#guides" class="nav-link">Guides</a>
          </li>
          <li>
            <a href="#contact" class="nav-link">Contact</a>
          </li>
        </ul>
      </div>

    </div>
  </nav>

  <!-- Main Content -->
  <img src="./assets/images/bus_bench_build_1_cropped.png" alt="One of our bus bench builds" class="img-fluid">
  <!-- TODO: When I have more images, use Bootstrap's "Carousel" feature to cycpe through. -->

  <section id="quote">
    <div class="container-sm">
      <div class="row justify-content-center">
        <div class="col-md-6 maintxt">
          <figure class="text-center p-5">
            <blockquote class="blockquote">
              <p>
                We crave the simple: benches, shade, rest, comfort, thoughtfulness, and breathing.
              </p>
            </blockquote>
            <figcaption class="blockquote-footer">
              <cite title="Bill Sell">Bill Sell</cite>
            </figcaption>
          </figure>
        </div>
      </div>
    </div>
  </section>

  <section id="support-us">
    <div class="container-lg pt-3 pb-3">
      <div class="row justify-content-center text-center">
        <div class="col-md-10 col-lg-8">
          <div class="display-5 text-center py-3">Support Our Work</div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
          <p>
            Any contributions go directly towards purchasing materials for our benches. Every little bit counts towards making Milwaukee a more accessible place.
          </p>
        </div>
      </div>
      <div class="row justify-content-center text-center">
        <div class="col-md-10 col-lg-8">
          <a class="btn btn-primary fs-4 mx-5 mb-3 px-4 py-2 rounded-pill" href="https://paypal.me/BillsBusBenches">
            Donate
          </a>
        </div>
      </div>
    </div>
  </section>

  <section id="about">
    <div class="container-lg pt-3">
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8"> <!--text-center text-md-start-->
          <div class="display-5 text-center py-3">About Us</div>
          <p>
            We are neighbors and builders who believe that the city of Milwaukee should be safe, accessible, and comfortable for everyone. Across our city and county, hundreds of bus stops are little more than a sign on the side of a busy road, without shelter or a place to sit. They fail to provide even the barest minimum of accessibility. No one should have to stand for twenty minutes in the sun or snow just to get around the city.
          </p>
          <!-- <h3 class="pt-3">Our Goal: One Hundred Benches</h3> -->
          <p>
            We believe in the value of shaping our own communities. That's why we have taken the construction of bus stop benches into our own hands. We are committing to building <br><b>one hundred benches</b> at bus stops across Milwaukee county.
          </p>
        </div>  
      </div>
    </div>
  </section>

  <section id="get-involved">
    <div class="container-lg pt-3 pb-5">
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
          <h1 class="display-5 text-center py-3">Get Involved</h1>
          <p>
            Whether you are a leader in your community, or a neighbor who believes in what we are doing, we need your help. The best way to get in touch with us is to fill out our <b>contact form at the bottom of this page</b>. You can also send us an email at <a href="billsbusbenches@gmail.com">billsbusbenches@gmail.com</a>.
          </p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
          <h4 class="pt-3">How can I get a bus bench near me?</h4>
          <p>
            If you want a bench at a stop near you, all you have to do is contact us and we will get a bench out there as soon as we can. We are working with neighborhood associations and community groups to get benches to the places in Milwaukee where people need them the most. If you would like to see bus benches installed in your neighborhood, we'd love for you to send us an email.
          </p>
          <h4 class="pt-3">How can I help?</h4>
          <p>
            The best way you can help is by keeping an eye out for benches that might be damaged or missing. While we do our best to keep an eye on the benches we put out, Milwaukee is a big city, and we can't be everywhere at once. If you see a bench that has been broken or stolen, please send us an email. It really helps us out.
          </p>
          <p>
            And if you'd like to join our team, we can use all the help we can get. We are a small team of volunteers, and as this project grows, we are going to need people to write grants, help make repairs, transport benches, and manage our website. We would love for you to be a part of this effort to make Milwaukee a more accessible place.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section id="mapsection">
    <!-- <div class="container-xl py-3 bg-primary"> -->
    <div class="container-fluid py-3 bg-primary">
      <div class="row bg-primary justify-content-center">
        <!-- <h2 class="text-center pt-3 text-white">Our Impact in Milwaukee</h2> -->
        <h1 class="display-5 text-center py-3 text-white">Our Impact In Milwaukee</h1>
        <div class="col-md-6">
          <div>
            <div class="map justify-content-center py-3" id="map"><!--This id must match the map's id in the js file-->
              <script type="text/javascript" src="mapbuild.js"></script>
            </div>
          </div>
        </div>
        <div class="col-md-3 py-3 my-5 bg-white">
          <h3 class="text-center">Key</h3>
          <p>
            <img src="./assets/icons/icon_blue.png" width="20" height="20">
            Active bench <br>(bench is in place and not broken)
            <br>
            <img src="./assets/icons/icon_yellow.png" width="20" height="20">
            Bench is in need of repairs
            <br>
            <img src="./assets/icons/icon_red.png" width="20" height="20">
            Bench is missing
            <br>
            <img src="./assets/icons/icon_gray.png" width="20" height="20">
            Planned future benches
          </p>
        </div>
      </div>
    </div>
  </section>

  <section id="guides">
    <div class="container-xl pt-3 pb-5">
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
          <h1 class="display-5 text-center py-3">Guides</h1>
          <p>
            If you want to make a bench yourself, we've included a link to the design that we prefer to use. It's heavy enough to withstand the harsh Milwaukee weather, and comfortable enough for people with limited mobility.
          </p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8 justify-content-center text-center">
          <a class="btn btn-dark fs-4 mx-5 mb-3 px-4 py-2 rounded-pill" href="https://rogueengineer.com/diy-outdoor-bench-plans-with-back/">
            View Guide
          </a>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
          However, there are plenty of other designs out there, and we encourage you to pick one that fits your needs and your budget. The Chattanooga Urbanist Society has <a href="https://www.urbanistsociety.com/resources/">another design</a> that is also a great option: 
        </div>
      </div>
    </div>
  </section>

  <section id="contact">
    <div class="container-xl mt-3 mb-5">
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

  <section id="supporters">
    <div class="container-xl">
      <div class="row text-center justify-content-center">
        <div class="col-md-10 col-lg-8">
          <h1 class="display-5 text-center py-3">Our supporters</h1>
        </div>
      </div>
      <div class="row text-center justify-content-center">
        <div class="col-md-10 col-lg-8">
          <img src="./assets/bliffert.png" alt="Logo for Bliffert Co., one of our sponsors" class="img-fluid mx-5 mb-3 px-4 py-2">
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
          <p>
            Thank you to Bliffert for donating lumber to contribute to our bench-building efforts! Thanks to them, we have been able to replace some of our original benches with a sturdier design, as well as expand to new locations.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section id="footer">
    <div class="container-xl">
      <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Back to Top</a></li>
          <!-- <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li> -->
        </ul>
        <p class="text-center text-muted">&copy; 2024 Bill's Bus Benches | billsbusbenches@gmail.com</p>
      </footer>
    </div>
  </section>
</body>
</html>

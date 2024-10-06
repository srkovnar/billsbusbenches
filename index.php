<?php
  require('vendor/autoload.php');

  // Fetch bench location data from JSON file in a non-public directory (see README for details)
  $bench_location_json_path = "../benches.json";
  $bench_location_contents = file_get_contents("../benches.json");
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
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
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
            <a href="#about" class="nav-link">About</a>
          </li>
          <li>
            <a href="#contact" class="nav-link">Contact</a>
          </li>
          <li>
            <a href="#mapsection" class="nav-link">Map</a>
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

  <section id="about">
    <div class="container-lg pt-3">
      <div class="row justify-content-center">
        <div class="col-md-8"> <!--text-center text-md-start-->
          <h2 class="text-center pt-3">About Us</h2>
          <!--<div class="display-2">About Us</div>
          <div class="display-5 text-muted">About Us</div>-->
          <p>
            We are neighbors and builders who believe that the city of Milwaukee should be safe, accessible, and comfortable for everyone. A bench is the simplest step forward to make waiting for the bus more pleasant. No one should have to stand for twenty minutes in the sun or snow just to get around the city.
          </p>
          <p>
            We believe in the value of shaping our own communities. That's why we have taken the construction of bus stop benches into our own hands.
          </p>
        </div>  
      </div>
    </div>
  </section>

  <section id="contact">
    <div class="container-lg pt-3">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <h2 class="text-center">Contact Us</h2>
          <p>
            The best way to get in touch with us is to send us an email at <a href="billsbusbenches@gmail.com">billsbusbenches@gmail.com</a>.
          </p>
          <h4 class="pt-3">How can I get a bus bench near me?</h4>
          <p>
            We are working with neighborhood groups to get benches to the places in Milwaukee where people need them the most. If you would like to see bus benches installed in your neighborhood, we'd love for you to send us an email.
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
    <div class="container-xl py-3 bg-primary">
      <div class="row bg-primary justify-content-center">
        <h2 class="text-center pt-3 text-white">Current Bench Locations</h2>
        <div class="col-md-8">
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
            <img src="./assets/icons/icon_red.png" width="20" height="20">
            Bench is broken
            <br>
            <img src="./assets/icons/icon_yellow.png" width="20" height="20">
            Bench is missing
            <br>
            <img src="./assets/icons/icon_gray.png" width="20" height="20">
            Planned future benches
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
        <p class="text-center text-muted">&copy; 2024 Bill's Bus Benches</p>
      </footer>
    </div>
  </section>

  <section id="contact-button">
    <div class="justify-content-end">
      <div class="fixed-bottom justify-content-end align-end align-self-end">
        <a class="btn btn-primary mx-5 my-5 rounded-pill" href="mailto:billsbusbenches@gmail.com">
          <svg width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px; color: rgb(255, 255, 255);"><path d="M21.75 1.5H2.25c-.828 0-1.5.672-1.5 1.5v12c0 .828.672 1.5 1.5 1.5h19.5c.828 0 1.5-.672 1.5-1.5V3c0-.828-.672-1.5-1.5-1.5zM15.687 6.975L19.5 10.5M8.313 6.975L4.5 10.5" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M22.88 2.014l-9.513 6.56C12.965 8.851 12.488 9 12 9s-.965-.149-1.367-.426L1.12 2.014" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>  
          Contact Us
        </a>
      </div>
    </div>
  </section>
</body>
</html>

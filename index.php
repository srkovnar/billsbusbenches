<?php
require('vendor/autoload.php');
$faker = Faker\Factory::create()
?><!DOCTYPE html>
<html lang="en">
  <!--Leaflet stylesheet-->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
  <!--Leaflet script library or something-->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <!--
  Future try:
  - the tiny text stack.
  - Try using petite-vue JS framework
  - Try using bootstrap CSS framework
  - ionic for mobile apps
  - Cloud firestore for database? Plus firebase for authentication.
  -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bill's Bus Benches</title>
  <link rel="stylesheet" href = "custom.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <!-- Test Header -->
  <div class="container-md">
    <div class="row">
      <div class="col-md-8">
        <h1 class="text-center py-5">Bill's Bus Benches</h1>
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
  <section id="quote">
    <div class="container-sm">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <figure class="text-center p-5">
            <blockquote class="blockquote">
              <p>
                I was thinking we could put a quote from Bill Sell here.
                One of the ones we used on the benches.
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
            We are neighbors and builders who believe that the city of Milwaukee should be safe, accessible, and comfortable for everyone. A bench is the simplest step forward to make waiting for the bus more pleasant. No one should have to stand in the sun or snow just to get around the city.
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
          <h2 class="text-center">Get Involved</h2>
          <p>
            Want to get in touch with us? Want to join our team? Want to request a bench at a bus stop near you? You can email us at <strong>billsbusbenches@gmail.com</strong> and we'll get back to you as soon as possible!
          </p>
        </div>
      </div>
    </div>
  </section>

  <section id="mapsection">
    <div class="container-xl pt-3">
      <div class="row justify-content-center">
        <div class="col-md-8 bg-primary">
          <h2 class="text-center pt-3 text-white">Current Bench Locations</h2>
          <div>
            <div class="map justify-content-center" id="map"><!--This id must match the map's id in the js file-->
              <script src="locations.json"></script>
              <script type="text/javascript" src="map.js"></script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>

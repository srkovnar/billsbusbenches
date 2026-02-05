<!DOCTYPE html>
<html lang="en">
<head>
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

      <!-- Toggle button for mobile nav -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Aria things are for screen readers -->

      <!-- Here are all of the links that can be collapsed into a hamburger menu -->
      <div class="collapse navbar-collapse justify-content-center align-center" id="main-nav">
        <ul class="navbar-nav">
        </ul>
      </div>

    </div>
  </nav>

  <!-- Thank you message -->
  <section id="thankyou">
    <div class="container-xl">
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8 text-center">
          <h1 class="display-5 text-center py-3">Thank you for contacting us!</h1>
          <p>
            We'll get back to you as soon as we can.
          </p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8 justify-content-center text-center">
          <a class="btn btn-dark fs-4 mx-5 mb-3 px-4 py-2 rounded-pill" href="/">
            Return to homepage
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Return to main page -->
</body>
</html>

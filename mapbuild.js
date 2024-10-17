/* This script facilitates the creation of a map from a JSON object.
 *
 * Requirements:
 *  - Leaflet initizliation script (place in HTML header)
 *      - <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
 *
 *  - Leaflet style sheet (place in HTML header)
 *      - <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
 * 
 *  - JSON object "locations" with the following fields
 *      - "name" (string)
 *      - "latitude" (float)
 *      - "longitude" (float)
 *      - "status" (string)
 *      - There may be extra fields, but they are not required
 */

// You don't have to do tileLayers this way; I'm doing it this way to make it easier to switch between layers and groups of pins.
let osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
});

let osm_hot = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France</a>'
});

/* Initialize map */
let map = L.map('map', {
  layers: [osm]
});

/* Initialize Layer Groups */
let base_maps = {
  "OpenStreetMaps": osm,
  "OpenStreetMaps.HOT": osm_hot
};

/* Initialize Layer Manager */
let layer_control = L.control.layers(base_maps).addTo(map);

/* Load custom markers */
let icon_red = L.icon({
  iconUrl: "./assets/icons/icon_red.png",
  //shadowUrl: "",

  iconSize:     [38, 38], // size of the icon (width, height)
  //shadowSize:   [50, 64], // size of the shadow
  iconAnchor:   [19, 38], // point of the icon which will correspond to marker's location
  //shadowAnchor: [4, 62],  // the same for the shadow
  popupAnchor:  [1.5, -30] // point from which the popup should open relative to the iconAnchor
});
let icon_yellow = L.icon({
  iconUrl: "./assets/icons/icon_yellow.png",
  //shadowUrl: "",

  iconSize:     [38, 38], // size of the icon (width, height)
  //shadowSize:   [50, 64], // size of the shadow
  iconAnchor:   [19, 38], // point of the icon which will correspond to marker's location
  //shadowAnchor: [4, 62],  // the same for the shadow
  popupAnchor:  [1.5, -30] // point from which the popup should open relative to the iconAnchor
});
let icon_blue = L.icon({
  iconUrl: "./assets/icons/icon_blue.png",
  //shadowUrl: "",

  iconSize:     [38, 38], // size of the icon (width, height)
  //shadowSize:   [50, 64], // size of the shadow
  iconAnchor:   [19, 38], // point of the icon which will correspond to marker's location
  //shadowAnchor: [4, 62],  // the same for the shadow
  popupAnchor:  [1.5, -30] // point from which the popup should open relative to the iconAnchor
});
let icon_gray = L.icon({
  iconUrl: "./assets/icons/icon_gray.png",
  //shadowUrl: "",

  iconSize:     [38, 38], // size of the icon (width, height)
  //shadowSize:   [50, 64], // size of the shadow
  iconAnchor:   [19, 38], // point of the icon which will correspond to marker's location
  //shadowAnchor: [4, 62],  // the same for the shadow
  popupAnchor:  [1.5, -30] // point from which the popup should open relative to the iconAnchor
});
let icon_green = L.icon({
  iconUrl: "./assets/icons/icon_green.png",
  //shadowUrl: "",

  iconSize:     [38, 38], // size of the icon (width, height)
  //shadowSize:   [50, 64], // size of the shadow
  iconAnchor:   [19, 38], // point of the icon which will correspond to marker's location
  //shadowAnchor: [4, 62],  // the same for the shadow
  popupAnchor:  [1.5, -30] // point from which the popup should open relative to the iconAnchor
});

/* Add points to map from database results */
let lat_sum = 0;
let lng_sum = 0;
let num_pts = 0;

/* Instantiate icon layers (empty by default; will be filled during the main loop) */
let bench_layer_active  = L.layerGroup([]); // Locations of active benches
let bench_layer_missing = L.layerGroup([]); // Locations of missing benches
let bench_layer_broken  = L.layerGroup([]); // Locations of broken benches
let bench_layer_planned = L.layerGroup([]); // Locations of planned benches

/* Map bench statuses to icon colors */
let icon_map = {
    "active": {
      "stylized": "Active",
      "icon": icon_blue,
      "layer": bench_layer_active
    },
    "broken": {
      "stylized": "Broken",
      "icon": icon_red,
      "layer": bench_layer_broken
    },
    "missing": {
      "stylized": "Missing",
      "icon": icon_yellow,
      "layer": bench_layer_missing
    },
    "planned": {
      "stylized": "Planned",
      "icon": icon_gray,
      "layer": bench_layer_planned
    },
};

let map_bounds = L.latLngBounds();
for (let key in locations) {
  num_pts++;

  var icon_type;

  let location = locations[key]
  let coordinates = [location.latitude, location.longitude];

  /* Create popup text based on available information in the JSON info file */
  let popup_text = `<span class="popup">`;
  
  if (location.name) {
    if (location.direction) {
      popup_text += `${location.name} (${location.direction})<br>`;
    }
    else {
      popup_text += `${location.name}<br>`;
    }
  }
  if (location.stop_id) {
    popup_text += `Stop #${location.stop_id}<br>`;
  }
  if (location.status) {
    popup_text += `Status: ${location.status}<br>`;
  }
  if (location.updated && (location.status != "planned")) {
    popup_text += `<br>Last checked: ${location.updated}<br>`;
  }

  popup_text += "</span>";

  //if (location.image) {
  //  popup_text += `
  //    <br><img src="${location.image.src}" height="${location.image.height}" width="${location.image.width}"></img>
  //  `;
  //}

  L.marker(coordinates, {
    icon: icon_map[location.status].icon
  })
  .bindPopup(popup_text)
  //.addTo(map); // Add the new marker to the map
  .addTo(icon_map[location.status].layer); // Add the new marker to the correct pin layer

  lat_sum += coordinates[0];
  lng_sum += coordinates[1];

  map_bounds.extend(coordinates);
}

/* Set view to the average of all of the points. */
let lat_avg = lat_sum / num_pts;
let lng_avg = lng_sum / num_pts;
map.setView([lat_avg, lng_avg], 13); // 13 is the zoom.

/* Set map bounds to include all points, plus a padding of 0.5. */
map.fitBounds(map_bounds.pad(0.5));

/* Add marker layers to map layer control (the little drop-down with the checkboxes) */
layer_control.addOverlay(
  bench_layer_active,
  '<img src="./assets/icons/icon_blue.png" width="20" height="20">Active'
);
layer_control.addOverlay(
  bench_layer_missing,
  '<img src="./assets/icons/icon_yellow.png" width="20" height="20"></img>Missing'
);
layer_control.addOverlay(
  bench_layer_broken,
  `<img src="./assets/icons/icon_red.png" width="20" height="20"></img>Broken`
);
layer_control.addOverlay(
  bench_layer_planned,
  '<img src="./assets/icons/icon_gray.png" width="20" height="20"></img>Planned'
);

/* Show default layers (put pin layers here that you wish to see by default when map loads) */
bench_layer_active.addTo(map);
bench_layer_missing.addTo(map);
bench_layer_broken.addTo(map);

/* Add pin layer control to map */
layer_control.addTo(map);

/* Display success message in console */
console.log("Points successfully loaded to map.");

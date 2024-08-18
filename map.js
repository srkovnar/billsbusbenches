//const datafile = require("./locations.json");
// Do I not have require available?
// I think it needs to be included somehow...
//console.log(datafile);

//import file from "./locations.json" with { type: "json" };
//console.log(`testing ${file.testing}`);
// This ^ doesn't work at all because I'm not in a "module", whatever that is.

// Ok, so this function kind of works. But it returns a promise, not an object like I want.
function readJSONFile(file) {
    testval = fetch(file)
        .then((res) => {
            if (!res.ok) {
                throw new Error
                    (`HTTP error! Status: ${res.status}`);
            }
            return res.json();
        })
        .then((data) => {
            console.log(data);
            //return data;
        })
        .catch((error) => 
            console.error("Unable to fetch data:", error));
    return testval;
}

/*  
 * This does functionally the same thing as the other version of this function.
 * It's shorter, so I'm going with this one, but I'm leaving the other one
 * in for the sake of documentation.
 * 
 * This function returns a promise. If you want to use it, you have to wait for it to finish
 * by using a `.then` block.
 * Here's the post that finally cleared that up for me: 
 * https://stackoverflow.com/questions/44331581/convert-promise-in-json-object
 */
async function getJSONFile(file) {
    const response = await fetch(file);
    const json = await response.json();
    //console.log(json);
    return json;
}

/* Initialize map */
let map = L.map('map');
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);


/* Load custom markers */
let broken_icon = L.icon({
    iconUrl: "./assets/icons/icon1.png",
    //shadowUrl: "",

    iconSize:     [38, 38], // size of the icon (width, height)
    //shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [19, 38], // point of the icon which will correspond to marker's location
    //shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [1.5, -30] // point from which the popup should open relative to the iconAnchor
});



/* Read marker data from file */
const marker_JSON_data = getJSONFile("./locations.json");

let marker_array = [];

/* Wait for reading process to finish, then add points to map. */
marker_JSON_data.then((data) => {
    let lat_sum = 0;
    let lng_sum = 0;
    let num_pts = 0;

    for (let key in data) {
        num_pts++;

        let location = data[key]
        L.marker(location.coordinates, {

        }).bindPopup(`
            <span class="popup">
                ${location.title}
            </span>
        `).addTo(map);

        lat_sum += location.coordinates[0];
        lng_sum += location.coordinates[1];
    }

    // Set view to the average of all of the points.
    let lat_avg = lat_sum / num_pts;
    let lng_avg = lng_sum / num_pts;
    map.setView([lat_avg, lng_avg], 13); // 13 is the zoom.

    console.log("Points successfully loaded to map.");

    // TODO: Set zoom automatically based on the points.
})

//L.marker(
//    [43.00604935035454, -87.90759136368332],
//    {
//        icon: broken_icon
//    }
//).bindPopup(
//    `
//    <span class="popup">
//        TESTING
//    </span>
//    `
//).addTo(map);

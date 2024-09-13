# bills-bus-benches
Code for Bill's Bus Benches website

# Non-Obvious Functionality

In order to load the map of benches, we need a JSON file `benches.json` to exist in the directory above this one. This is done to ensure that it is not part of the git repository, and can be manually edited at any time to update the map.

The general structure of the `benches.json` file should look like this:

```json
{
    "Bench Name #1": {
        "name": "Bench Name #1",
        "latitude": "43.054783544046295",
        "longitude": "-87.95775363703311",
        "status": "missing"
    },
    "Bench Name #2": {
        "name": "Bench Name #2",
        "latitude": "43.0607647616709",
        "longitude": "-87.95770295192429",
        "status": "active"
    }
}
```

# Development Notes and Attributions

This website is built using Bootstrap CSS framework: [https://getbootstrap.com]

The map is built with Leaflet.js ([https://leafletjs.com/])
and uses OpenStreetMap map data ([https://www.openstreetmap.org]).

## Before development

Before you can do anything, you must run `composer install` to install PHP dependencies.
Honestly, this project doesn't really use them right now, but I'm leaving them in for now.

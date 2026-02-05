# bills-bus-benches

Code for Bill's Bus Benches website

# About The Code

## Setting up the folder structure

Because of the way that this project is hosted, we keep the configuration details outside of the main project directory. You'll need to set up your files like this:

```
your_folder/
├── billsbusbenches/
│   └── (everything else)
└── config.json
```

You'll need to create config.json yourself, to hold any access information for your deployment. This will be covered in more detail later on.

## Setup

Before you can run this code locally, you must install the following programs:

- PHP
- Composer (a library manager for PHP)
- NodeJS
- Node Package Manager (NPM) (a library manager for NodeJS)

Run `composer install` to download all needed PHP libraries. These are needed to run the website.

Run `npm i` to download all needed NodeJS libraries. Right now, these are only needed for development - you can skip this unless you plan on changing the stylesheet.

## Attributions

This website is built using Bootstrap CSS framework: [https://getbootstrap.com](https://getbootstrap.com)

The map is built with Leaflet.js ([https://leafletjs.com/](https://leafletjs.com/))
and uses OpenStreetMap map data ([https://www.openstreetmap.org](https://www.openstreetmap.org)).

## Bench Data Format

Bench data is stored in a JSON file, because I'm too broke to afford a proper database. It's called `benches.json`. The general structure of the `benches.json` file should look like this:

```json
{
    "Bench Name #1": {
        "name": "Bench Name #1",
        "latitude": 43.054783544046295,
        "longitude": -87.95775363703311,
        "status": "missing"
    },
    "Bench Name #2": {
        "name": "Bench Name #2",
        "latitude": 43.0607647616709,
        "longitude": -87.95770295192429,
        "status": "active"
    }
}
```

And so on. The following fields are supported:

Field name | Required? | Description
-----------|-----------|-------------
`latitude` | YES       | Latitude of the bench marker on the map.
`longitude`| YES       | Longitude of the bench marker on the map.
`name`     | YES       | Name of the bench in the popup.
`status`   | YES       | "active", "missing", "broken", or "planned". Determines what icon to provide to the icon on the map.
`stop_id`  | no        | Number. Shows the stop number in the popup when clicked.
`direction`| no        | String. Indicates the direction of the stop (i.e., if the stop is served only by buses traveling east, the direction would be "Eastbound").
`deployed` | no        | String (date). Shows the date of first setup.
`updated`  | no        | String (date). Shows the date of the last time this bench's status was verified in person.
`repaired` | no        | String (date). Shows the date of the last time this bench was repaired.
`image`    | no        | String. Path to an image file. If included, this will add an image to the bench popup to show the bench's position.

## Future To-Do

- Remove EXIF metadata from images to reduce size
- Build a script to guide user through the setup process (bash or python or powershell maybe)

### Images

If we ever get to the point where the amount of images is too many to commit to Github, we should migrate to CDN image storage. We would just list the URL in `benches.json` instead of the path.

# Old Documentation

## Composer Libraries Used

- `bootstrap`
    - Used for Bootstrap theme customization.
- `phpmailer` (Github: [https://github.com/PHPMailer/PHPMailer])
    - Used for the contact form in `contact.php`.

Make sure to have the following line at the start of any of your PHP files to include all of the needed libraries:

```php
require("vendor/autoload.php");
```

## Getting mail to work is a pain.

But it's not impossible. You'll need it to get a contact form working.

If you've been self-hosting up to this point, you might want to consider getting a hosting service. The reason for this is that most hosting services include a SMTP server (i.e. an email server) for you to use from your website. My service is Hostinger. If you don't use a service, you'll need to set up an SMTP server and a locally-hosted email address to go with it.

They'll usually also help you set up an internally-hosted email address. If your website is hoste at the domain "beepboop.com", you will be able to get an email address such as "myemail@beepboop.com" through your hosting service. You'll need to get some information from your hosting service to get this to work.

This is also where local testing with: `php -S 127.0.0.1:3000` will begin to get more difficult. It should still work if you do it right, but it might be easier to test in a live environment on a server with your hosting service.

### PHP's mail function is PHPMailer's biggest advertisement.

So, PHP has a built-in mail function called, appropriately, `mail()`. You can look up the manual pages for it with a quick Google search, it's really not that interesting. Very simple, very inflexible. And in my case, it didn't work at all. No idea what I did wrong.

Instead, I used an external library called **PHPMailer**. This is imported as a Composer package. You can see how I used PHPMailer by taking a look at my code. Plus, there are plenty of tutorials out there. I'd link the one I used, but honestly, it's such a hodgepodge of different people's code that I have no idea which one actually helped me.

Using **PHPMailer** will also allow you to test your stuff locally. As long as you get the SMTP stuff set up properly, you should still be able to test this out on your machine, even if you're just using PHP's built-in server with `php -S 127.0.0.1:3000` to access your site on `localhost:3000`.

### A note about Gmail

Allegedly, you can use a Gmail address and Gmail's SMTP server. There are guides on how to do this, however many of them are out-of-date. I did try to do this initially, before I decided to just use Hostinger's SMTP server.

You'll need to mess with your Gmail address's Google account settings. You will need to set up two-factor authentication in order to make the proper settings changes, since Google is really cracking down on that stuff now. I decided that was too much work and went back to the other plan of using my hosting service's SMTP server instead. That way I didn't have to deal with Google at all.

## Known Bugs

The navbar blocks the heading titles when you click on an anchor link. It's super irritating.

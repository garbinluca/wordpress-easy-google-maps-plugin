# Easy Wordpress Google Maps Plugin

Simple Wordpress plugin for GoogleMaps integration.

## Usage:

The plugin replaces all elements with `easy-google-maps` class.
```
<div class="easy-google-maps" style="height: 300px;" data-zoom="7" data-pin='{"src": "<?php echo get_template_directory_uri() ?>/assets/google-maps-pin.png", "width": 40, "height": 40}' data-latitude="45.438618" data-longitude="10.993313" data-styles='[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"color":"#5f3b34"}]},{"featureType":"administrative.neighborhood","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"administrative.neighborhood","elementType":"geometry.stroke","stylers":[{"visibility":"on"}]},{"featureType":"administrative.neighborhood","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#471E16"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#392718"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#5f3b34"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#5f3b34"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#331610"}]}]'></div>
```
### Options
- latitude: number
- longitude: number
- zoom: number (default: 8)
- pin: object (default: null). Es: `{src: 'https://www.example.com/pin.png', width: 10, height: 10}`
- styles: array (default: null). See [snazzymaps.com](snazzymaps.com)

[Google Api Key](https://console.developers.google.com/) is required: add `define('EASY_GOOGLE_MAPS_KEY', '{YOUR_API_KEY}')` to `wp-config.php`.


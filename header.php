<?php
// Set the content-type for proper HTML rendering
header('Content-Type: text/html; charset=utf-8');

// Echo out the HTML structure
echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
  /* Add your styles here */
  body {
    margin: 0; /* Remove default margin to prevent page shifting */
    padding: 0; /* Remove default padding */
  }
  .header-container {
    position: fixed; /* Make the header fixed at the top */
    top: 0; /* Position it at the top of the page */
    width: 100%; /* Make it full-width */
    background-color: #fff; /* Background color for the header */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Add a shadow for better visibility */
    padding: 10px 0; /* Add some padding for spacing */
    text-align: center;
    border-bottom: 3px solid #008000; /* Dark green border */
    font-family: Arial;
  }
  .header-title {
    color: #008000; /* Dark green text */
    font-size: 24px;
    font-weight: bold;
    margin: 0;
  }
  .header-address {
    color: #000000; 
    margin: 10px 0; 
    font-weight: 600;

  }
  .header-phone {
    color: #000000; 
    font-weight: 600;
    margin-top: -1vh;
    margin-bottom: -1vh;
  }
</style>
</head>
<body>
  <div class="header-container">
    <p class="header-title">RICHARD GWAPO COOPERATIVE INCORPORATED</p>
    <p class="header-address">Forever Gwapo St., Mandaluyong City</p>
    <p class="header-phone">Telephone #: 143-4456</p>
  </div>
</body>
</html>
HTML;

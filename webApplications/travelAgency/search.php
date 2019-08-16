 <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <script src="https://kit.fontawesome.com/dd01eeee16.js"></script>
      <link rel="stylesheet" href="css/main.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>FoxdropTravel</title>
    </head>

    <body id="home" class="scrollspy">
      <div class="navbar-fixed">
        <nav class="teal">
          <div class="container">
            <div class="nav-wrapper">
              <a href="./../travelAgency/index.html" class="brand-logo">FoxdropTravel</a>
              <ul class="right hide-on-med-and-down">
                <li>
                  <a class="btn btn-warning" href="./../../portfolio.php">Back To Foxdrop</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>

      <section class="section section-search darken-1 black-text center">
        <div class="container">
          <div class="row">
            <div class="col s12">
              <h2>Travel To <?php echo $_GET['country']; ?> </h2>
            </div>

            <div class="input-field">
              <form method="GET">
                <input type="hidden" name="country" value="<?php echo !empty($_GET['country']) ? htmlspecialchars($_GET['country']) : ''; ?>" />
                <input type="text" class="white grey-text autocomplete form-control" id="countryFrom" name="countryFrom" placeholder="From Sweden...">
              </form>
              <?php 
                $countryFrom="Sweden";
                isset($_GET['countryFrom']) ? $countryFrom = $_GET['countryFrom'] : '';
                echo '<h2>From '.$countryFrom.'</h2>' 
              ?>
            </div> 
          </div>
        </div>
      </section>


      <section class="section section-icons grey lighten-4 center">
        <div class="container">
          <div class="row">
            <div class="col-s12 m4">
              <div class="card-panel">
                <i class="material-icons large teal-text">room</i>
                <h4>Locations</h4>
                <?php 
                  require '../../vendor/autoload.php';
                  $dotenv = Dotenv\Dotenv::create(dirname(dirname(__DIR__)));
                  $dotenv->load();
                  $API_KEY = $_ENV['RAPID_API_KEY'];

                  if(isset($_GET['country'])) {
                    $country = $_GET['country'];
                    if ($country === "United States of America") {
                      $country = "United+States";
                    }
                  }
                  $country = str_replace(' ', '+', $country);
                  

                  $response = Unirest\Request::get("https://skyscanner-skyscanner-flight-search-v1.p.rapidapi.com/apiservices/autosuggest/v1.0/SE/SEK/en-SE/?query=".$country."",
                    array(
                      "X-RapidAPI-Host" => "skyscanner-skyscanner-flight-search-v1.p.rapidapi.com",
                      "X-RapidAPI-Key" => $API_KEY
                    )
                  );

                  $placeNameArr = array();
                  $placeIdArr = array();

                  $responseBody = $response->body->{'Places'};
                  for ($i=2; $i < @sizeof($responseBody); $i++) {
                    $result = $responseBody[$i]->{'PlaceName'};
                    $placeNameArr[$i-2] = $result;
                    $result2 = $responseBody[$i]->{'PlaceId'};
                    $placeIdArr[$i-2] = $result2;

                    
                    $resultNoSpace = str_replace(' ', '+', $result);
                    echo "<p><a href='https://google.com/maps/search/".$resultNoSpace."' target='_blank'>".$result." </a></p>";
                    
                  }

                  // Input "from" here before the API call
                  $countryFromId = "SE-sky";

                  if(!empty($_GET['countryFrom'])) {
                    $fromCountry = $_GET['countryFrom'];

                    $response = Unirest\Request::get("https://skyscanner-skyscanner-flight-search-v1.p.rapidapi.com/apiservices/autosuggest/v1.0/SE/SEK/en-SE/?query=".$fromCountry."",
                      array(
                        "X-RapidAPI-Host" => "skyscanner-skyscanner-flight-search-v1.p.rapidapi.com",
                        "X-RapidAPI-Key" => $API_KEY
                      )
                    );


                    $countryFromId = $response->body->{'Places'}[0]->{'PlaceId'}; // Country ID maybe
                  }

                  $response = Unirest\Request::get("https://skyscanner-skyscanner-flight-search-v1.p.rapidapi.com/apiservices/browsequotes/v1.0/SE/SEK/en-US/".$countryFromId."/".$placeIdArr[0]."/anytime",
                    array(
                      "X-RapidAPI-Host" => "skyscanner-skyscanner-flight-search-v1.p.rapidapi.com",
                      "X-RapidAPI-Key" => "b9334583cemsh670233cf6f39e65p11ad14jsn75c6538b3a72"
                    )
                  );

                  $flightAlternatives = $response->body->{'Quotes'};

                ?>

              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section section-icons grey lighten-4 center">
        <div class="container">
          <div class="row">
            <div class="col-s12 m4">
              <div class="card-panel">
                <i class="material-icons large teal-text">airplanemode_active</i>
                <h4>Flights</h4>
                <?php
                  for($i=0; $i<@sizeof($flightAlternatives); $i++) {
                    $direct = $flightAlternatives[$i]->{'Direct'};
                    $directString;
                    $direct ? $directString="Yes" : $directString="No";
                    $departure = $flightAlternatives[$i]->{'OutboundLeg'}->{'DepartureDate'};
                    $airline = $flightAlternatives[$i]->{'OutboundLeg'}->{'CarrierIds'}[0];
                    $airlineName = "Not found!";
                    foreach($response->body->{'Carriers'} as &$value) {
                      if($airline === $value->{'CarrierId'}) {
                        $airlineName = $value->{'Name'};
                        break;
                      }
                    }
                    // Get airline routes
                    $fromPlaceId = $flightAlternatives[$i]->{'OutboundLeg'}->{'OriginId'};
                    $toPlaceId = $flightAlternatives[$i]->{'OutboundLeg'}->{'DestinationId'};
                    $fromPlace;
                    $toPlace;
                    foreach($response->body->{'Places'} as &$value) {
                      if($fromPlaceId === $value->{'PlaceId'}) {
                        $fromPlace = $value->{'Name'};
                      }
                      else if ($toPlaceId === $value->{'PlaceId'}) {
                        $toPlace = $value->{'Name'};
                      }
                      if(!empty($fromPlace) && !empty($toPlace)) {
                        break;
                      }
                    }

                    echo "<p><b>Price:</b> ".$flightAlternatives[$i]->{'MinPrice'}." SEK<br><b>Direct Flight:</b> ".$directString."<br><b>Departure Date:</b> ".substr($departure, 0, -9)."<br><b>Route:</b> ".$fromPlace." - ".$toPlace."<br><b>Airline:</b> ".$airlineName."</p>";
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </section>



 <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
  // Sidenav
  const sideNav = document.querySelector('.sidenav');
  M.Sidenav.init(sideNav, {});

  // Slider
  const slider = document.querySelector('.slider');
  M.Slider.init(slider, {
    indicators: false,
    height: 500,
    transition: 500,
    interval: 6000
  });

  // Material Boxed
  const mb = document.querySelectorAll('.materialboxed');
  M.Materialbox.init(mb, {});

  // Scrollspy
  const ss = document.querySelectorAll('.scrollspy');
  M.ScrollSpy.init(ss, {});

// Autocomplete
      const ac = document.querySelector('.autocomplete');
      M.Autocomplete.init(ac, {
        data: {
          "Aruba": null,
          "Cancun Mexico": null,
          "Hawaii": null,
          "Florida": null,
          "California": null,
          "Jamacia": null,
          "Europe": null,
          "Norway": null,
          "Iceland": null,
          "Greece": null,
          "Italy": null,
          "France": null,
          "Spain": null,
          "China": null,
          "Japan": null,
          "South Korea": null,
          "Thailand": null,
          "Australia": null,
          "Sweden": null,
          "Denmark": null,
          "Australia": null,
          "Afghanistan": null,
          "Åland Islands": null,
          "Albania": null,
          "Algeria": null,
          "American Samoa": null,
          "Andorra": null,
          "Angola": null,
          "Anguilla": null,
          "Antarctica": null,
          "Antigua and Barbuda": null,
          "Argentina": null,
          "Armenia": null,
          "Aruba": null,
          "Australia": null,
          "Austria": null,
          "Azerbaijan": null,
          "Bahamas": null,
          "Bahrain": null,
          "Bangladesh": null,
          "Barbados": null,
          "Belarus": null,
          "Belgium": null,
          "Belize": null,
          "Benin": null,
          "Bermuda": null,
          "Bhutan": null,
          "Bolivia (Plurinational State of)": null,
          "Bonaire, Sint Eustatius and Saba": null,
          "Bosnia and Herzegovina": null,
          "Botswana": null,
          "Bouvet Island": null,
          "Brazil": null,
          "British Indian Ocean Territory": null,
          "United States Minor Outlying Islands": null,
          "Virgin Islands (British)": null,
          "Virgin Islands (U.S.)": null,
          "Brunei Darussalam": null,
          "Bulgaria": null,
          "Burkina Faso": null,
          "Burundi": null,
          "Cambodia": null,
          "Cameroon": null,
          "Canada": null,
          "Cabo Verde": null,
          "Cayman Islands": null,
          "Central African Republic": null,
          "Chad": null,
          "Chile": null,
          "China": null,
          "Christmas Island": null,
          "Cocos (Keeling) Islands": null,
          "Colombia": null,
          "Comoros": null,
          "Congo": null,
          "Congo (Democratic Republic of the)": null,
          "Cook Islands": null,
          "Costa Rica": null,
          "Croatia": null,
          "Cuba": null,
          "Curaçao": null,
          "Cyprus": null,
          "Czech Republic": null,
          "Denmark": null,
          "Djibouti": null,
          "Dominica": null,
          "Dominican Republic": null,
          "Ecuador": null,
          "Egypt": null,
          "El Salvador": null,
          "Equatorial Guinea": null,
          "Eritrea": null,
          "Estonia": null,
          "Ethiopia": null,
          "Falkland Islands (Malvinas)": null,
          "Faroe Islands": null,
          "Fiji": null,
          "Finland": null,
          "France": null,
          "French Guiana": null,
          "French Polynesia": null,
          "French Southern Territories": null,
          "Gabon": null,
          "Gambia": null,
          "Georgia": null,
          "Germany": null,
          "Ghana": null,
          "Gibraltar": null,
          "Greece": null,
          "Greenland": null,
          "Grenada": null,
          "Guadeloupe": null,
          "Guam": null,
          "Guatemala": null,
          "Guernsey": null,
          "Guinea": null,
          "Guinea-Bissau": null,
          "Guyana": null,
          "Haiti": null,
          "Heard Island and McDonald Islands": null,
          "Holy See": null,
          "Honduras": null,
          "Hong Kong": null,
          "Hungary": null,
          "Iceland": null,
          "India": null,
          "Indonesia": null,
          "Côte d'Ivoire": null,
          "Iran (Islamic Republic of)": null,
          "Iraq": null,
          "Ireland": null,
          "Isle of Man": null,
          "Israel": null,
          "Italy": null,
          "Jamaica": null,
          "Japan": null,
          "Jersey": null,
          "Jordan": null,
          "Kazakhstan": null,
          "Kenya": null,
          "Kiribati": null,
          "Kuwait": null,
          "Kyrgyzstan": null,
          "Lao People's Democratic Republic": null,
          "Latvia": null,
          "Lebanon": null,
          "Lesotho": null,
          "Liberia": null,
          "Libya": null,
          "Liechtenstein": null,
          "Lithuania": null,
          "Luxembourg": null,
          "Macao": null,
          "Macedonia (the former Yugoslav Republic of)": null,
          "Madagascar": null,
          "Malawi": null,
          "Malaysia": null,
          "Maldives": null,
          "Mali": null,
          "Malta": null,
          "Marshall Islands": null,
          "Martinique": null,
          "Mauritania": null,
          "Mauritius": null,
          "Mayotte": null,
          "Mexico": null,
          "Micronesia (Federated States of)": null,
          "Moldova (Republic of)": null,
          "Monaco": null,
          "Mongolia": null,
          "Montenegro": null,
          "Montserrat": null,
          "Morocco": null,
          "Mozambique": null,
          "Myanmar": null,
          "Namibia": null,
          "Nauru": null,
          "Nepal": null,
          "Netherlands": null,
          "New Caledonia": null,
          "New Zealand": null,
          "Nicaragua": null,
          "Niger": null,
          "Nigeria": null,
          "Niue": null,
          "Norfolk Island": null,
          "Korea (Democratic People's Republic of)": null,
          "Northern Mariana Islands": null,
          "Norway": null,
          "Oman": null,
          "Pakistan": null,
          "Palau": null,
          "Palestine, State of": null,
          "Panama": null,
          "Papua New Guinea": null,
          "Paraguay": null,
          "Peru": null,
          "Philippines": null,
          "Pitcairn": null,
          "Poland": null,
          "Portugal": null,
          "Puerto Rico": null,
          "Qatar": null,
          "Republic of Kosovo": null,
          "Reunion": null,
          "Romania": null,
          "Russian Federation": null,
          "Rwanda": null,
          "Saint Barthelemy": null,
          "Saint Helena, Ascension and Tristan da Cunha": null,
          "Saint Kitts and Nevis": null,
          "Saint Lucia": null,
          "Saint Martin (French part)": null,
          "Saint Pierre and Miquelon": null,
          "Saint Vincent and the Grenadines": null,
          "Samoa": null,
          "San Marino": null,
          "Sao Tome and Principe": null,
          "Saudi Arabia": null,
          "Senegal": null,
          "Serbia": null,
          "Seychelles": null,
          "Sierra Leone": null,
          "Singapore": null,
          "Sint Maarten (Dutch part)": null,
          "Slovakia": null,
          "Slovenia": null,
          "Solomon Islands": null,
          "Somalia": null,
          "South Africa": null,
          "South Georgia and the South Sandwich Islands": null,
          "Korea (Republic of)": null,
          "South Sudan": null,
          "Spain": null,
          "Sri Lanka": null,
          "Sudan": null,
          "Suriname": null,
          "Svalbard and Jan Mayen": null,
          "Swaziland": null,
          "Sweden": null,
          "Switzerland": null,
          "Syrian Arab Republic": null,
          "Taiwan": null,
          "Tajikistan": null,
          "Tanzania, United Republic of": null,
          "Thailand": null,
          "Timor-Leste": null,
          "Togo": null,
          "Tokelau": null,
          "Tonga": null,
          "Trinidad and Tobago": null,
          "Tunisia": null,
          "Turkey": null,
          "Turkmenistan": null,
          "Turks and Caicos Islands": null,
          "Tuvalu": null,
          "Uganda": null,
          "Ukraine": null,
          "United Arab Emirates": null,
          "United Kingdom of Great Britain and Northern Ireland": null,
          "United States of America": null,
          "Uruguay": null,
          "Uzbekistan": null,
          "Vanuatu": null,
          "Venezuela (Bolivarian Republic of)": null,
          "Viet Nam": null,
          "Wallis and Futuna": null,
          "Western Sahara": null,
          "Yemen": null,
          "Zambia": null,
          "Zimbabwe": null
        }
      });
    </script>
    
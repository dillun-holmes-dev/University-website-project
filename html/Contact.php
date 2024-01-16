<?php
// Start session
session_start();

// Access form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store POST data in session
    $_SESSION['postdata'] = $_POST;

    // Clear $_POST
    $_POST = array();

    // Redirect to the same page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// This code can be used anywhere you redirect your user to using the header("Location: ...")
if (array_key_exists('postdata', $_SESSION)) {
    // Compose email
    $firstName = $_SESSION['postdata']['firstname'];
    $lastName = $_SESSION['postdata']['lastname'];
    $emailadd = $_SESSION['postdata']['email'];
    $country = $_SESSION['postdata']['country'];
    $subject = $_SESSION['postdata']['subject'];

    $email_from = 'noreply-ctubuddy@sjpret.co.za';
    $email_subject = "New Form submission";
    $email_body = "You have received a new message from the user $firstName $lastName from $country with email address $emailadd.\n".
                      "Here is the message:\n $subject";

    // Send email
    $to = "simon.agar@ctucareer.co.za";
    $cc = array("dillunholmesdev@gmail.com","kayleigh0230@gmail.com","sjpret12345@gmail.com");
    $cc_emails = implode(", ", $cc); // convert array to string with comma separation

    $headers = "From: <$email_from> \r\n";
    $headers .= "Cc: $cc_emails \r\n"; // add cc recipients to headers
    mail($to,$email_subject,$email_body,$headers);

    // After using the postdata, don't forget to unset/clear it
    unset($_SESSION['postdata']);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>CTU-Buddy</title>
  <link rel="icon" type="image/x-icon" href="../img/fav.ico">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/contact.css">
  <script src="../js/scrollreveal.min.js"></script>
  <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=AoGrhd1Qb0g1NjQZKwiqTsq-DUwBwzJX45nB4luArZUFhRClXmqUtxvrrfl5drbv'></script>
  <style>
    /* Set the size and rounded corners of the map container */
    #map {
      width: 100%;
      height: 500px;
      border-radius: 20px;
    }
    /* Add modern styling to the map container */
    .map-container {
      background-color: #f2f2f2;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border: 1px solid #ccc;
      border-radius: 20px;
      overflow: hidden;
      width: 50%;
    }
  </style>
</head>
<body>
  
  <header>
    <img src="../img/CTU BUDDY.png" alt="CTU_BUDDY_LOGO" align="left" width="100" height="100">
    <div class="topnav">
    <a href="../index.html">Home</a>
      <a href="Time.html">Timetable</a>
      <a href="Discussion.html">Discussion</a>
      <a href="Share.html">Shared Resources</a>
      <a href="About.html">About Us</a>
      <a href="Contact.php">Contact Us</a>
    </div>
  </header>

  <main>
    Dillun Holmes: 20230440<br> Salomon Pretorius: 20231348<br> Kayleigh Louwrens: 20230424<br><br>
    <div class="container">
    <div class="email">
    <form id="contactForm" class="contactForm" method="POST" action="Contact.php">
        <!-- Your form fields here -->
        <label for="fname"><h3>First Name</h3></label>
        <input type="text" id="fname" class="options" name="firstname" placeholder="Your name..">
    
        <label for="lname"><h3>Last Name</h3></label>
        <input type="text" id="lname" class="options" name="lastname" placeholder="Your last name..">

        <label for="email"><h3>Email</h3></label>
        <input type="text" id="email" class="options" name="email" placeholder="Your email address..">
    
        <label for="country"><h3>Country</h3></label>
        <select id="country" name="country" class="options">
          <option value="SOUTH AFRICA">South Africa</option>
        </select>
    
        <label for="subject"><h3>Subject</h3></label>
        <textarea id="subject" class="options" name="subject" placeholder="Write something.." style="height:200px"></textarea>
    
        <input type="submit" value="Submit">
      </form>
    </div>

    </div>
    <br>
    <h1>MAP</h1>
    <center>
    <div class="map-container">
    <div id="map"></div>
    </div>
    </center>
  </main>
  <script>
  var map;
  
  function loadMapScenario() {
    map = new Microsoft.Maps.Map(document.getElementById('map'), {
      center: new Microsoft.Maps.Location(-29.087217, 26.154898), // Coordinates are reversed for lat and lng
      zoom: 10 // Starting zoom level
    });

    // Add a pushpin to mark Bloemfontein, South Africa
    var bloemfonteinLocation = new Microsoft.Maps.Location(-29.120029, 26.214004);
    var pushpin = new Microsoft.Maps.Pushpin(bloemfonteinLocation, { title: 'Bloemfontein' });
    map.entities.push(pushpin);
  }
</script>

<script>
  // Load the Bing Maps control when the page is loaded
  window.onload = loadMapScenario;
</script>

  <script>
   document.getElementById('contactForm').addEventListener('submit', function(event) {
  event.preventDefault();

  var firstName = document.getElementById('fname').value;
  var lastName = document.getElementById('lname').value;
  var email = document.getElementById('email').value;
  var country = document.getElementById('country').value;
  var subject = document.getElementById('subject').value;

  var errors = [];

  if (firstName === '') {
    errors.push('First name is required');
  }

  if (lastName === '') {
    errors.push('Last name is required');
  }
  
  var emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
  if (!email.match(emailRegex)) {
    errors.push('Please enter a valid email address');
  }

  if (country === '') {
    errors.push('Country is required');
  }

  if (subject === '') {
    errors.push('Subject is required');
  }

  if (errors.length > 0) {
    alert('Please correct the following errors:\n' + errors.join('\n'));
  } else {
    this.submit();
    alert("Email successfully send to Simon Agar's email account.");
  }
});

  const srtop = ScrollReveal({
  origin: 'top',
  distance: '80px',
  duration: 2000,
  reset: false
  });
  srtop.reveal('main');
  </script>
  <footer>
    <p>Contact Number : 041 098 7865 </p>
    <p>Email : info@ctuniversity.co.za</p>
    <br>
    <div class="topnav">
    <a href="../index.html">Home</a>
      <a href="Time.html">Timetable</a>
      <a href="Discussion.html">Discussion</a>
      <a href="Share.html">Shared Resources</a>
      <a href="About.html">About Us</a>
      <a href="Contact.php">Contact Us</a>
    </div>
    <p>Created By Dillun Holmes; Salomon Pretorius; Kayleigh Louwrens  </p>
    <p>SDK &copy; 2023</p>
  </footer>
</body>

</html>

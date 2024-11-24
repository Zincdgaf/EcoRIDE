<?php  
session_start(); // Sinisigurado na ang session ay nagsimula, kailangan ito para sa login at session management
include('database.php'); // Kinu-connect ang PHP script sa database para magamit ang database connection

// Tinitiyak na ang user ay naka-login bago mag-create ng ride
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Ire-redirect ang user sa login page kung hindi pa siya naka-login
    exit(); // Pagkatapos ng redirect, tinatapos ang script para hindi magpatuloy ang ibang code
}

// Function para kumuha ng distansya sa pagitan ng dalawang lokasyon gamit ang Google Maps API
function get_distance($start_location, $destination) {
    $start = urlencode($start_location); // I-eencode ang start location para sa URL
    $dest = urlencode($destination); // I-eencode ang destination para sa URL

    $api_key = 'YOUR_GOOGLE_MAPS_API_KEY';  // Palitan ito ng iyong aktwal na Google Maps API key
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$start&destinations=$dest&key=$api_key"; // URL ng Google API na maghahanap ng distansya

    // Gumagawa ng GET request sa Google API at i-decode ang response
    $response = file_get_contents($url);
    $data = json_decode($response, true); // I-decode ang response mula sa JSON format papunta sa array

    // Sinusuri kung may distance na natagpuan sa response
    if (isset($data['rows'][0]['elements'][0]['distance']['value'])) {
        $distance_in_meters = $data['rows'][0]['elements'][0]['distance']['value']; // Kumuha ng distance sa meters mula sa API response
        $distance_in_km = $distance_in_meters / 1000;  // Kinoconvert ang meters sa kilometers
        return round($distance_in_km, 2);  // Ibalik ang distansya sa kilometers na may dalawang decimal places
    } else {
        return 0;  // Kung walang distansya na nahanap, magbabalik ng 0
    }
}

// Pag-handle ng form submission kapag ang form ay na-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kunin ang data mula sa form na ipapadala
    $user_id = $_SESSION['user_id'];  // Kunin ang user ID mula sa session
    $start_location = $_POST['start_location']; // Start location mula sa form
    $destination = $_POST['destination']; // Destination mula sa form
    $date = $_POST['date'];  // Petsa mula sa form
    $seats_available = $_POST['seats_available'];  // Seats available mula sa form

    // Kumuha ng distansya mula sa Google API function
    $distance = get_distance($start_location, $destination);

    // Pag-compute ng presyo gamit ang pricing model (₱10 bawat kilometer)
    $price_per_km = 10;  // Puwedeng baguhin ayon sa kinakailangan
    $ride_price = $distance * $price_per_km; // Total na presyo ng biyahe

    // SQL query para i-insert ang bagong ride offer sa database
    $sql = "INSERT INTO carpool_offers (user_id, start_location, destination, date, seats_available, price, distance_km) 
            VALUES ('$user_id', '$start_location', '$destination', '$date', '$seats_available', '$ride_price', '$distance')";

    // Pagsagawa ng SQL query at pag-check kung successful ang insertion
    if ($conn->query($sql) === TRUE) {
        echo "Ride created successfully!"; // Success message kung ang ride ay matagumpay na na-create
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // Error message kung may problema sa SQL query
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Sinisigurado ang tamang character encoding para sa page -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ginagamit para sa responsive design, makikita sa mobile -->
    <title>Create a Ride</title> <!-- Pamagat ng page na lumalabas sa browser tab -->
    <link rel="stylesheet" href="style.css"> <!-- Link para sa external stylesheet -->
    <style>
        /* Pangkalahatang styling ng body */
        body {
            background-color: #121212; /* Madilim na background para sa dark theme */
            color: white;  /* Puti ang kulay ng text para madaling mabasa */
            font-family: 'Arial', sans-serif; /* Font family para sa web page */
            margin: 0;
            padding: 0;
        }

        /* Header styling */
        header {
            background-color: #FFDD00; /* Dilaw na kulay para sa header */
            text-align: center; /* Pinag-iisa ang text sa gitna */
            padding: 20px;
        }

        header h1 {
            color: #333; /* Itim na kulay ng font sa header */
            font-size: 2.5em; /* Mas malaking font size para sa title */
        }

        /* Styling ng form container */
        form {
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent na background */
            padding: 30px;
            border-radius: 8px;
            width: 80%; /* 80% ng lapad ng screen */
            max-width: 600px; /* Maximum na lapad ng form */
            margin: 50px auto; /* I-center ang form sa screen */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Maliit na shadow effect sa form */
        }

        /* Label styling */
        form label {
            display: block;
            font-size: 1.1em;
            margin-bottom: 10px;
            color: #FFDD00; /* Dilaw na kulay para sa mga label */
        }

        /* Input fields styling */
        form input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #444; /* Border na medyo madilim */
            border-radius: 5px;
            background-color: #333; /* Madilim na background ng inputs */
            color: #fff; /* Puti ang kulay ng text */
            font-size: 1em; /* Normal na laki ng font */
        }

        /* Button styling */
        form button {
            width: 100%; /* Full width ng button */
            padding: 12px;
            background-color: #FFDD00; /* Dilaw na kulay ng button */
            border: none; /* Walang border */
            border-radius: 5px;
            color: black; /* Itim na kulay ng text */
            font-size: 1.2em; /* Laki ng font sa button */
            cursor: pointer; /* Magiging pointer ang cursor kapag naka-hover sa button */
            transition: background-color 0.3s; /* Epekto ng pagbabago ng kulay kapag hover */
        }

        form button:hover {
            background-color: #ffcc00; /* Mas madilim na dilaw kapag hover */
        }

        /* Back to Homepage Button */
        .back-button {
            padding: 12px 20px;
            background-color: #00796b; /* Teal na kulay na akma sa header at footer */
            color: white;
            font-size: 1.1em;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px; /* May space sa itaas ng button */
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #004d40; /* Madilim na teal kapag hover */
        }

        /* Responsive adjustments para sa mas maliit na screen */
        @media (max-width: 600px) {
            form {
                width: 90%; /* Ginagawang 90% ang width ng form */
                padding: 20px;
            }

            header h1 {
                font-size: 2em; /* Maliit na font size ng header para sa mas maliit na screen */
            }
        }
    </style>
</head>
<body>

    <header>
        <!-- Pamagat ng page -->
        <h1>Create a Carpool Ride</h1>
    </header>

    <!-- Ride Creation Form -->
    <form method="POST" action="create_ride.php">
        <!-- Start Location Input -->
        <label for="start_location">Start Location:</label>
        <input type="text" id="start_location" name="start_location" required>
        
        <!-- Destination Input -->
        <label for="destination">Destination:</label>
        <input type="text" id="destination" name="destination" required>
        
        <!-- Date Input -->
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        
        <!-- Seats Available Input -->
        <label for="seats_available">Seats Available:</label>
        <input type="number" id="seats_available" name="seats_available" required>
        
        <!-- Submit Button -->
        <button type="submit">Create Ride</button>
    </form>

    <!-- Button to go back to homepage -->
    <a href="index.php" class="back-button">Back to Homepage</a>

</body>
</html>



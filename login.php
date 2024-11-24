<?php   
session_start();  // Nagsisimula ng session para magamit ang session variables (halimbawa: user_id)
include('database.php');  // Isinasama ang 'database.php' upang kumonekta sa database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // Kung ang request ay POST (ibig sabihin, ang form ay isinubmit)
    $email = $_POST['email'];  // Kinukuha ang email na ipinasa mula sa form
    $password = $_POST['password'];  // Kinukuha ang password na ipinasa mula sa form

    // Nagsasagawa ng SQL query upang hanapin ang user na may parehong email sa database
    $sql = "SELECT * FROM users WHERE email = '$email'";  
    $result = $conn->query($sql);  // Ipinapasa ang query sa database

    // Kung may resulta (may user na tumugma sa email)
    if ($result->num_rows > 0) {  
        $user = $result->fetch_assoc();  // Kukunin ang user record mula sa resulta ng query
        // Tinutukoy kung tama ang password gamit ang password_verify() function
        if (password_verify($password, $user['password'])) {  
            $_SESSION['user_id'] = $user['id'];  // Itinatago ang user_id sa session upang maging authenticated ang user
            header("Location: create_ride.php");  // Kung tama ang password, ire-redirect ang user sa create_ride.php page
        } else {
            // Kung mali ang password, magpapakita ng error message
            echo "<p class='error'>Invalid password.</p>";
        }
    } else {
        // Kung walang user na tumugma sa email, magpapakita ng error message
        echo "<p class='error'>No user found with that email.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  <!-- Ipinapakita ang character encoding ng pahina -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!-- Ginagawa ang page responsive sa mga mobile devices -->
    <title>Login - Carpooling</title>  <!-- Ipinapakita ang title ng page sa browser tab -->
    <link rel="stylesheet" href="style.css">  <!-- Ipinapasok ang external na CSS file para sa layout ng page -->
    <style>
        /* Body styling */
        body {
            font-family: 'Arial', sans-serif;  /* Ipinapakita ang font style para sa body */
            background: linear-gradient(135deg, #00b09b, #96c93d);  /* Green gradient background para sa buong page */
            margin: 0;  /* Wala ng margin sa paligid ng body */
            padding: 0;  /* Wala ng padding */
            display: flex;  /* Ginagawa ang body bilang flex container */
            justify-content: center;  /* Pinag-center ang content horizontally */
            align-items: center;  /* Pinag-center ang content vertically */
            height: 100vh;  /* Ginagawa ang body na kasing taas ng buong screen */
            color: #fff;  /* Ginagawang puti ang text color */
            flex-direction: column;  /* Ipinapakita ang mga elementong vertical */
        }

        /* Header styling */
        header {
            text-align: center;  /* Ipinapa-center ang text ng header */
            margin-bottom: 30px;  /* Nagdadagdag ng espasyo sa ibaba ng header */
        }

        header h1 {
            font-size: 2.5em;  /* Laki ng font ng heading */
            font-weight: bold;  /* Ginagawang bold ang font */
        }

        /* Form container styling */
        form {
            background-color: rgba(0, 0, 0, 0.7);  /* Dark semi-transparent na background para sa form */
            padding: 30px;  /* Nagdadagdag ng padding sa loob ng form */
            border-radius: 8px;  /* May rounded corners ang form */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);  /* Naglalagay ng shadow effect sa form */
            max-width: 400px;  /* Maximum width ng form */
            width: 100%;  /* Ginagawang 100% ang width ng form depende sa container */
            margin-bottom: 20px;  /* Nagdadagdag ng espasyo sa ilalim ng form */
        }

        form label {
            display: block;  /* Ginagawa ang label bilang block element para ito'y mag-isa sa linya */
            font-size: 1.2em;  /* Laki ng font ng labels */
            margin-bottom: 10px;  /* Naglalagay ng espasyo sa ibaba ng label */
        }

        form input {
            width: 100%;  /* Ginagawang 100% ang width ng input fields */
            padding: 10px;  /* Nagdadagdag ng padding sa input fields */
            margin: 10px 0;  /* Naglalagay ng espasyo sa itaas at ibaba ng input fields */
            border: none;  /* Wala ng border sa input fields */
            border-radius: 4px;  /* Ginagawang bilog ang mga kanto ng input fields */
            font-size: 1em;  /* Laki ng font sa loob ng input fields */
            box-sizing: border-box;  /* Sinisigurado na ang padding at border ay kasama sa total width ng input */
        }

        form button {
            width: 100%;  /* Ginagawang 100% ang width ng button */
            padding: 12px;  /* Nagdadagdag ng padding sa button */
            background-color: #96c93d;  /* Green color para sa background ng button */
            border: none;  /* Wala ng border sa button */
            border-radius: 4px;  /* Ginagawang bilog ang mga kanto ng button */
            color: white;  /* Ginagawang puti ang text sa button */
            font-size: 1.2em;  /* Laki ng font sa button */
            cursor: pointer;  /* Nagiging pointer ang cursor kapag hover sa button */
            transition: background-color 0.3s ease;  /* Smooth na transition kapag nag-hover sa button */
        }

        form button:hover {
            background-color: #00b09b;  /* Nagiging ibang green color kapag hover sa button */
        }

        /* Back to Homepage Button */
        .back-button {
            padding: 10px 20px;  /* Nagdadagdag ng padding sa back button */
            background-color: #00796b;  /* Teal color ang background */
            color: white;  /* Ginagawang puti ang text ng button */
            font-size: 1.1em;  /* Laki ng font */
            text-decoration: none;  /* Tinatanggal ang underline sa link */
            border-radius: 5px;  /* Ginagawang bilog ang kanto ng button */
            margin-top: 20px;  /* Naglalagay ng espasyo sa itaas ng button */
            transition: background-color 0.3s ease;  /* Smooth na transition kapag hover */
        }

        .back-button:hover {
            background-color: #004d40;  /* Nagiging mas dark na teal color kapag hover */
        }

        /* Error message styling */
        .error {
            color: #ff4d4d;  /* Red color para sa error message */
            font-size: 1.2em;  /* Laki ng font ng error message */
            text-align: center;  /* Ipinapa-center ang error message */
            margin-top: 15px;  /* Nagdadagdag ng espasyo sa itaas ng error message */
        }

        /* Responsive Design */
        @media (max-width: 500px) {
            form {
                width: 90%;  /* Ginagawang 90% ang width ng form para maging mobile-friendly */
                padding: 20px;  /* Nagbabawas ng padding para sa mga mobile devices */
            }
            header h1 {
                font-size: 2em;  /* Binabago ang font size ng header sa mga mobile devices */
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Login to EcoRIDE</h1>  <!-- Title ng page, ipinapakita sa header -->
    </header>
    <form method="POST" action="login.php">  <!-- Login form, nagsasubmit ng data sa login.php -->
        <label for="email">Email:</label>  <!-- Label para sa email input -->
        <input type="email" id="email" name="email" required>  <!-- Email input field, required ang pag-fill -->
        <label for="password">Password:</label>  <!-- Label para sa password input -->
        <input type="password" id="password" name="password" required>  <!-- Password input field, required -->
        <button type="submit">Login</button>  <!-- Submit button ng form -->
    </form>

    <!-- Back to Homepage Button -->
    <a href="index.php" class="back-button">Back to Homepage</a>  <!-- Button para magbalik sa homepage -->
</body>
</html>



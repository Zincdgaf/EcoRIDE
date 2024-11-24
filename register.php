<?php  
include('database.php');  // Iniu-import ang 'database.php' file para makakonekta sa database

// Sini-check kung ang form ay na-submit gamit ang POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    // Kinokolekta ang mga value mula sa form inputs
    $name = $_POST['name'];  
    $email = $_POST['email'];  
    // I-apply ang password hashing upang gawing secure ang password bago ito i-save
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  

    // Naghahanda ng SQL query upang i-insert ang user data sa database
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";  

    // Ginagamit ang prepared statement upang maprotektahan laban sa SQL injection
    $stmt = $conn->prepare($sql);  
    // Binibind ang mga input values sa query
    $stmt->bind_param("sss", $name, $email, $password);  

    // Kung matagumpay na naisagawa ang query, ipapakita ang success message
    if ($stmt->execute()) {  
        echo "Registration successful! You can now <a href='login.php'>login</a>.";  
    } else {
        // Kung may error sa query, ipapakita ang error message
        echo "Error: " . $stmt->error;  
    }
    // Isinasara ang prepared statement pagkatapos ng execution
    $stmt->close();  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  <!-- Ipinapakita ang character encoding ng pahina -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!-- Ginagawa ang page responsive para sa mga mobile devices -->
    <title>Register - Carpooling</title>  <!-- Ipinapakita ang title ng page sa browser tab -->
    <link rel="stylesheet" href="style.css">  <!-- Iniu-import ang external na CSS file para sa layout ng page -->
    <style>
        /* Body Styling */
        body {
            font-family: 'Arial', sans-serif;  /* Inilalagay ang font style para sa buong body */
            background: linear-gradient(135deg, #FF8C00, #FFD700);  /* Warm orange gradient background */
            margin: 0;  /* Wala ng margin */
            padding: 0;  /* Wala ng padding */
            display: flex;  /* Ginagawa ang body bilang flex container */
            justify-content: center;  /* Pinag-center ang content horizontally */
            align-items: center;  /* Pinag-center ang content vertically */
            height: 100vh;  /* Ginagawang kasing taas ng screen ang body */
            flex-direction: column;  /* Ginagawang vertical stacking ng mga elemento */
            color: #333;  /* Dark gray ang text color */
        }

        /* Header Styling */
        header {
            text-align: center;  /* Pinapa-center ang header text */
            margin-bottom: 40px;  /* Naglalagay ng espasyo sa ibaba ng header */
        }

        header h1 {
            font-size: 2.5em;  /* Laki ng font para sa header */
            font-weight: bold;  /* Ginagawang bold ang font ng header */
            color: #fff;  /* Ginagawang puti ang text color ng header */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);  /* Naglalagay ng text shadow para sa depth effect */
        }

        /* Form container */
        form {
            background-color: rgba(0, 0, 0, 0.7);  /* Semi-transparent black background para sa form */
            padding: 40px;  /* Nagdadagdag ng padding sa loob ng form */
            border-radius: 10px;  /* May rounded corners ang form */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);  /* Soft shadow effect sa form */
            max-width: 450px;  /* Maximum width ng form */
            width: 100%;  /* Ginagawang 100% ang width ng form depende sa container */
            text-align: center;  /* Pinapa-center ang text sa loob ng form */
            margin-bottom: 20px;  /* Naglalagay ng espasyo sa ilalim ng form */
        }

        /* Form Labels */
        form label {
            display: block;  /* Ginagawang block element ang labels upang mag-isa sa linya */
            font-size: 1.1em;  /* Laki ng font para sa labels */
            margin-bottom: 10px;  /* Naglalagay ng espasyo sa ilalim ng labels */
            color: #fff;  /* Puti ang text color ng labels */
        }

        /* Input Fields */
        form input {
            width: 100%;  /* Ginagawang 100% ang width ng input fields */
            padding: 12px;  /* Nagdadagdag ng padding sa input fields */
            margin: 12px 0;  /* Naglalagay ng espasyo sa itaas at ibaba ng input fields */
            border: none;  /* Wala ng border sa input fields */
            border-radius: 6px;  /* Bilog ang mga kanto ng input fields */
            font-size: 1.1em;  /* Laki ng font sa loob ng input fields */
            background-color: #fff;  /* Puti ang background color ng input fields */
            color: #333;  /* Dark gray ang text color sa input fields */
            box-sizing: border-box;  /* Kasama sa width ang padding at border */
        }

        /* Button Styling */
        form button {
            width: 100%;  /* Ginagawang 100% ang width ng button */
            padding: 14px;  /* Nagdadagdag ng padding sa button */
            background-color: #FF8C00;  /* Orange color ang background ng button */
            border: none;  /* Wala ng border sa button */
            border-radius: 6px;  /* Bilog ang mga kanto ng button */
            color: white;  /* Puting text color sa button */
            font-size: 1.3em;  /* Laki ng font sa button */
            cursor: pointer;  /* Ginagawang pointer ang cursor kapag hover sa button */
            transition: background-color 0.3s ease, transform 0.2s ease;  /* Smooth transition sa hover effect */
        }

        form button:hover {
            background-color: #FFD700;  /* Nagiging dilaw ang button kapag hover */
            transform: translateY(-2px);  /* Slightly lifting effect kapag hover */
        }

        /* Back to Homepage Button */
        .back-button {
            display: inline-block;  /* Ginagawang inline block ang back button */
            padding: 10px 20px;  /* Nagdadagdag ng padding */
            background-color: #00796b;  /* Teal color ang background ng back button */
            color: white;  /* Puting text color sa button */
            font-size: 1.1em;  /* Laki ng font sa button */
            text-decoration: none;  /* Tinatanggal ang underline sa link */
            border-radius: 5px;  /* Bilog ang mga kanto ng back button */
            transition: background-color 0.3s ease;  /* Smooth na transition sa hover */
            margin-top: 20px;  /* Naglalagay ng espasyo sa itaas ng button */
        }

        .back-button:hover {
            background-color: #004d40;  /* Mas dark na teal kapag hover */
        }

        /* Responsive Design */
        @media (max-width: 500px) {
            header h1 {
                font-size: 2em;  /* Binabawasan ang font size ng header sa mobile */
            }

            form {
                width: 90%;  /* Ginagawang 90% ang width ng form sa mobile */
                padding: 20px;  /* Nagbabawas ng padding sa mobile */
            }

            form label {
                font-size: 1em;  /* Binabawasan ang font size ng label sa mobile */
            }

            form input {
                font-size: 1em;  /* Binabawasan ang font size ng input fields sa mobile */
            }

            form button {
                font-size: 1.1em;  /* Binabawasan ang font size ng button sa mobile */
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Sign Up to EcoRIDE</h1>  <!-- Pamagat ng page, nagpapakita ng header sa itaas -->
    </header>

    <!-- Registration Form -->
    <form method="POST" action="register.php">  <!-- Form na magsasubmit ng data sa register.php -->
        <label for="name">Username:</label>  <!-- Label para sa pangalan ng user -->
        <input type="text" id="name" name="name" required>  <!-- Input field para sa pangalan ng user -->
        
        <label for="email">Email:</label>  <!-- Label para sa email ng user -->
        <input type="email" id="email" name="email" required>  <!-- Input field para sa email ng user -->
        
        <label for="password">Password:</label>  <!-- Label para sa password ng user -->
        <input type="password" id="password" name="password" required>  <!-- Input field para sa password ng user -->
        
        <button type="submit">Register</button>  <!-- Submit button para mag-submit ng form -->
    </form>

    <!-- Back to Homepage Button -->
    <a href="index.php" class="back-button">Back to Homepage</a>  <!-- Link na magbabalik sa homepage -->

</body>
</html>

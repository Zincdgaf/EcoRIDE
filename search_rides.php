<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Character encoding ng pahina, tinitiyak na ang mga character ay ipinapakita nang tama -->
    <meta charset="UTF-8">

    <!-- Para gawing responsive ang page sa mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title ng pahina na ipinapakita sa browser tab -->
    <title>Search for Rides</title>

    <!-- Iniu-import ang external CSS file na magbibigay ng mga estilo sa page -->
    <link rel="stylesheet" href="style.css">

    <style>
        /* General body styling */
        body {
            background-color: #F3F4F6; /* Light gray background */
            color: #333; /* Dark text color para madaling basahin */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Font style ng buong page */
            margin: 0; /* Tinatanggal ang default na margin */
            padding: 0; /* Tinatanggal ang default na padding */
            min-height: 100vh; /* Siguraduhing ang body ay may taas na katumbas ng screen */
            display: flex; /* Ginagawang flexbox ang layout ng page */
            flex-direction: column; /* Pahalang na pagsasaayos ng mga elemento */
            justify-content: flex-start; /* Ang mga elemento ay naka-align sa itaas */
            align-items: center; /* Naka-center ang mga elemento sa gitna ng page */
            overflow-y: auto; /* Nagbibigay ng scrollbar kung ang nilalaman ay lalampas sa taas ng screen */
        }

        /* Header styling */
        header {
            background-color: #00796b; /* Teal color para sa background ng header */
            color: white; /* Puti ang text color sa header */
            text-align: center; /* Pinapa-center ang text sa header */
            padding: 25px; /* Naglalagay ng espasyo sa paligid ng header text */
            width: 100%; /* Punuin ang buong lapad ng screen */
            border-bottom: 4px solid #333; /* Naglalagay ng pahalang na border sa ilalim ng header */
            margin-bottom: 30px; /* Naglalagay ng espasyo sa ilalim ng header */
        }

        header h1 {
            font-size: 2.5em; /* Laki ng font ng header */
            margin: 0; /* Tinatanggal ang default na margin sa ilalim ng header */
        }

        /* Search form container */
        form {
            background-color: #ffffff; /* Puti ang background ng form */
            padding: 40px; /* Naglalagay ng padding sa loob ng form */
            border-radius: 12px; /* May mga bilog na kanto ang form */
            width: 80%; /* Ginagawang 80% ng lapad ng screen ang form */
            max-width: 600px; /* Maximum na lapad ng form */
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1); /* Naglalagay ng bahagyang shadow sa paligid ng form */
            margin-top: 30px; /* Naglalagay ng espasyo sa itaas ng form */
            display: flex; /* Ginagawang flexbox ang form */
            flex-direction: column; /* Patayong pagkakaayos ng mga elemento sa loob ng form */
        }

        /* Floating label input design */
        .form-group {
            position: relative; /* Ginagamit para makontrol ang posisyon ng label at input */
            margin-bottom: 25px; /* Naglalagay ng espasyo sa ilalim ng bawat input field */
        }

        .form-group input,
        .form-group select {
            width: 100%; /* Punuin ang lapad ng form ng input fields */
            padding: 14px 16px; /* Naglalagay ng padding sa loob ng input fields */
            border: 1px solid #ccc; /* May border ang input fields */
            border-radius: 10px; /* Bilog ang mga kanto ng input fields */
            background-color: #f9f9f9; /* Puti ang background ng input fields */
            font-size: 1.1em; /* Laki ng font sa loob ng input fields */
            color: #333; /* Madilim na text color */
            transition: 0.3s; /* Nagbibigay ng transition effect kapag nagbabago ang estilo */
        }

        /* Style kapag naka-focus ang input o select */
        .form-group input:focus,
        .form-group select:focus {
            border-color: #00796b; /* Palitan ang border color ng teal kapag naka-focus */
            outline: none; /* Tinatanggal ang default na outline */
            box-shadow: 0 0 8px rgba(0, 121, 107, 0.4); /* Naglalagay ng shadow effect kapag naka-focus */
        }

        /* Style ng label na floating */
        .form-group label {
            position: absolute; /* Ang label ay naka-absolute position sa loob ng form */
            top: 18px; /* Ilalagay ang label sa taas ng input */
            left: 18px; /* Ilalagay ang label sa kaliwa ng input */
            font-size: 1em; /* Laki ng font ng label */
            color: #888; /* Ang kulay ng label ay light gray */
            transition: 0.3s; /* Nagbibigay ng transition effect sa label kapag na-focus */
            pointer-events: none; /* Tinatanggal ang interaction ng user sa label */
        }

        /* Style ng label kapag na-focus ang input field */
        .form-group input:focus ~ label,
        .form-group select:focus ~ label,
        .form-group input:not(:placeholder-shown) ~ label,
        .form-group select:not(:placeholder-shown) ~ label {
            top: -10px; /* Ililipat ang label sa itaas kapag may input */
            left: 15px; /* Ililipat ang label sa kanan */
            font-size: 0.85em; /* Pababaan ang font size ng label */
            color: #00796b; /* Palitan ang kulay ng label sa teal */
        }

        /* Submit button design */
        button {
            padding: 14px; /* Naglalagay ng padding sa button */
            background-color: #00796b; /* Teal background ng button */
            border: none; /* Walang border ang button */
            border-radius: 10px; /* May bilog na kanto ang button */
            color: white; /* Puti ang text color ng button */
            font-size: 1.2em; /* Laki ng font ng button */
            cursor: pointer; /* Ginagawang pointer ang cursor kapag hover sa button */
            transition: 0.3s; /* Nagbibigay ng transition effect sa background color */
        }

        /* Style kapag hovered ang button */
        button:hover {
            background-color: #004d40; /* Nagiging dark teal ang background kapag hover */
        }

        /* Notification styling */
        .notification {
            margin-top: 20px; /* Naglalagay ng espasyo sa itaas ng notification */
            padding: 15px; /* Naglalagay ng padding sa notification */
            border-radius: 8px; /* Bilog na kanto ng notification */
            text-align: center; /* Ang text sa notification ay naka-center */
            width: 80%; /* Ginagawang 80% ng lapad ng screen ang notification */
            max-width: 600px; /* Maximum na lapad ng notification */
            font-size: 1.1em; /* Laki ng font ng notification */
        }

        /* Style ng notification kapag may available na rides */
        .available {
            background-color: #c8e6c9; /* Light green background */
            color: #388e3c; /* Green text color */
        }

        /* Style ng notification kapag walang available na rides */
        .none {
            background-color: #ffcdd2; /* Light red background */
            color: #d32f2f; /* Red text color */
        }

        /* Back to homepage button */
        .back-btn {
            margin-top: 20px; /* Naglalagay ng espasyo sa itaas ng button */
            padding: 12px 20px; /* Naglalagay ng padding sa button */
            background-color: #00796b; /* Teal background ng button */
            color: white; /* Puti ang text color ng button */
            font-size: 1.2em; /* Laki ng font ng button */
            border: none; /* Walang border ang button */
            border-radius: 8px; /* May mga bilog na kanto ang button */
            cursor: pointer; /* Ginagawang pointer ang cursor kapag hover sa button */
            text-decoration: none; /* Tinatanggal ang underline sa link */
        }

        /* Style kapag hovered ang back button */
        .back-btn:hover {
            background-color: #004d40; /* Nagiging dark teal ang background kapag hover */
        }

        /* Responsive adjustments para sa mas maliit na mga screen */
        @media (max-width: 600px) {
            form {
                width: 90%; /* Ginagawang 90% ng lapad ang form sa maliit na screen */
                padding: 25px; /* Binabawasan ang padding sa form sa maliit na screen */
            }

            header h1 {
                font-size: 2em; /* Binabawasan ang laki ng font ng header sa maliit na screen */
            }

            button {
                font-size: 1.1em; /* Binabawasan ang laki ng font ng button sa maliit na screen */
            }
        }
    </style>
</head>
<body>

    <!-- Header ng pahina -->
    <header>
        <h1>Search for Carpool Rides</h1> <!-- Pamagat ng pahina na nagpapakita ng layunin ng page -->
    </header>

    <!-- Search Form -->
    <form method="POST" action="">
        <!-- Start Location Input -->
        <div class="form-group">
            <input type="text" id="start_location" name="start_location" required placeholder=" ">
            <label for="start_location">Start Location</label> <!-- Label para sa start location input -->
        </div>

        <!-- Date Input -->
        <div class="form-group">
            <input type="date" id="date" name="date" required> <!-- Input field para sa date -->
            <label for="date"></label> <!-- Empty label para sa date input -->
        </div>

        <!-- Submit Button -->
        <button type="submit">Search</button> <!-- Button na magsusubmit ng form -->
    </form>

    <!-- Notification Area -->
    <?php
    // Check kung na-submit ang form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Kunin ang mga data mula sa form
        $start_location = $_POST['start_location'];
        $date = $_POST['date'];

        // Simulate ang pag-check ng available rides (pwedeng palitan ito ng aktwal na data check)
        $availableRides = rand(0, 1); // Random na simulation ng availability (0 = walang rides, 1 = may rides)

        // I-display ang notification
        echo '<div class="notification ';
        if ($availableRides) {
            echo 'available'; /* Kung may available na rides, ipapakita ang green notification */
            echo '">Great news! There are available rides for your search.';
        } else {
            echo 'none'; /* Kung walang rides, ipapakita ang red notification */
            echo '">Sorry, no rides found for your search.';
        }
        echo '</div>';
    }
    ?>

    <!-- Back to Homepage Button -->
    <a href="index.php" class="back-btn">Back to Homepage</a> <!-- Link na magbabalik sa homepage -->

</body>
</html>




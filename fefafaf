<html lang="en">   
<head>
    <meta charset="UTF-8"> <!-- Itinatakda ang character encoding sa UTF-8 para sa tamang pagpapakita ng mga character -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Para sa tamang pagpapakita sa mga mobile device -->
    <title>EcoRIDE</title> <!-- Title ng web page -->
    <link rel="stylesheet" href="style.css"> <!-- Naglalagay ng external CSS file para sa style ng website -->
    <style>
        /* Body at Pangunahing Estilo */
        body {
            background-color: #f4f4f4; /* Banayad na kulay ng background */
            font-family: Arial, sans-serif; /* Pumipili ng font para sa body text */
            color: #333; /* Kulay ng text (dark gray) */
            margin: 0; /* Inaalis ang default na margin ng body */
            padding: 0; /* Inaalis ang default na padding ng body */
        }

        /* Header Estilo */
        header {
            background-color: #00796b; /* Kulay ng background ng header (Teal) */
            padding: 20px; /* Nag-aapply ng padding sa header */
            text-align: center; /* Ika-center ang nilalaman ng header */
        }

        header h1 {
            color: #fff; /* Kulay ng font ng header (puti) */
            font-size: 3em; /* Sukat ng font ng header */
            margin: 0; /* Inaalis ang margin ng h1 */
        }

        nav {
            margin-top: 10px; /* Nagbibigay ng maliit na espasyo sa pagitan ng header at navigation */
        }

        nav a {
            color: #fff; /* Kulay ng teksto ng mga link (puti) */
            text-decoration: none; /* Inaalis ang underline sa mga link */
            margin: 0 15px; /* Nagbibigay ng margin sa kaliwa at kanan ng bawat link */
            font-size: 1.1em; /* Sukat ng font ng mga link */
        }

        nav a:hover {
            text-decoration: underline; /* Nag-aapply ng underline kapag nakahover ang user sa link */
        }

        /* Estilo ng Pangunahing Nilalaman */
        main {
            padding: 40px; /* Naglalagay ng padding sa paligid ng content */
            text-align: center; /* Ika-center ang nilalaman ng main */
        }

        main h1 {
            font-size: 2.5em; /* Sukat ng font para sa header ng main */
            color: #00796b; /* Kulay ng text ng main header */
        }

        main p {
            font-size: 1.2em; /* Sukat ng font ng teksto sa main */
            color: #555; /* Kulay ng teksto (medium gray) */
            margin-top: 20px; /* Nagbibigay ng espasyo sa itaas ng paragraph */
            line-height: 1.6; /* Nagbibigay ng mas malaking line height para sa mas maginhawang pagbabasa */
        }

        /* Footer Estilo */
        footer {
            background-color: #00796b; /* Kulay ng background ng footer (pareho ng header) */
            color: white; /* Kulay ng text ng footer (puti) */
            text-align: center; /* Ika-center ang nilalaman ng footer */
            padding: 15px; /* Nagbibigay ng padding sa footer */
            margin-top: 40px; /* Nagbibigay ng espasyo sa itaas ng footer */
        }

        footer p {
            margin: 0; /* Inaalis ang margin ng paragraph sa footer */
        }

        /* Estilo ng Imahe */
        .center-image {
            position: absolute; /* Inilalagay ang imahe sa isang partikular na posisyon */
            top: 70%; /* Inilalagay ang imahe 70% mula sa taas ng page */
            left: 50%; /* Inilalagay ang imahe sa gitna ng page horizontally */
            transform: translate(-50%, -50%); /* Ina-adjust ang posisyon upang matiyak na naka-center */
            width: 300px; /* Sukat ng imahe */
            height: auto; /* Pinapanatili ang proporsyon ng imahe */
            border-radius: 8px; /* Nagbibigay ng rounded corners sa imahe */
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2); /* Nagbibigay ng light shadow sa imahe para sa depth */
        }

        .car-image {
            position: fixed; /* Ginagawa ang imahe na naka-fix at hindi gumagalaw sa scroll */
            left: 280px; /* Inilalagay ang imahe 280px mula sa kaliwa ng page */
            bottom: 100px; /* Inilalagay ang imahe 100px mula sa ibaba ng page */
            width: 200px; /* Sukat ng imahe */
            height: auto; /* Pinapanatili ang proporsyon ng imahe */
            border-radius: 10px; /* Rounded corners para sa imahe */
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3); /* Stronger shadow para sa imahe */
        }

        /* New Right-center Image */
        .right-center-image {
            position: absolute; /* Inilalagay ang imahe sa partikular na posisyon */
            top: 68%; /* Inilalagay ang imahe 68% mula sa taas ng page */
            right: 15%; /* Inilalagay ang imahe 15% mula sa kanang gilid ng page */
            transform: translateY(-50%); /* Inilalagay ang imahe sa gitna vertically */
            width: 250px; /* Sukat ng imahe */
            height: auto; /* Pinapanatili ang proporsyon ng imahe */
            border-radius: 8px; /* Rounded corners para sa imahe */
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2); /* Light shadow para sa depth */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .center-image {
                width: 80%; /* Ginagawang mas maliit ang center image sa mga mobile devices */
            }

            .car-image {
                width: 200px; /* Ginagawang mas maliit ang car image sa mobile */
            }

            .right-center-image {
                width: 70%; /* Ginagawang mas maliit ang right-center image sa mobile */
            }

            main {
                padding: 20px; /* Nagbibigay ng padding sa main content sa mobile */
            }

            header h1 {
                font-size: 2em; /* Binabawasan ang font size ng header sa mobile */
            }

            main h1 {
                font-size: 2em; /* Binabawasan ang font size ng main header sa mobile */
            }

            nav a {
                font-size: 1em; /* Binabawasan ang font size ng mga links sa mobile */
                margin: 0 10px; /* Binabawasan ang margin ng mga links sa mobile */
            }
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <h1>Welcome to EcoRIDE</h1> <!-- Pangalan ng website sa header -->
        <nav> <!-- Navigation bar para sa pag-navigate ng website -->
            <a href="carpooling.html">About Us</a> <!-- Link patungong "About Us" -->
            <a href="register.php">Sign Up</a> <!-- Link patungong "Sign Up" page -->
            <a href="login.php">Login</a> <!-- Link patungong "Login" page -->
            <a href="create_ride.php">Publish a Ride</a> <!-- Link patungong "Publish a Ride" page -->
            <a href="search_rides.php">Search for Rides</a> <!-- Link patungong "Search for Rides" page -->
        </nav>
    </header>

    <!-- Main Content Section -->
    <main>
        <h1>EcoRIDE!</h1> <!-- Pangunahing pamagat ng main content -->
        <p>EcoRIDE helps you connect with others for carpooling, save costs, reduce traffic and helps our environment.Help us reduce pollution by carpooling.</p> <!-- Pangunahing teksto tungkol sa EcoRIDE -->
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 EcoRIDE Inc.</p> <!-- Copyright information sa footer -->
    </footer>

    <!-- Center Image -->
    <img src="https://img.freepik.com/premium-vector/car-sharing-man-looking-vehicle-with-smartphone-app-rent-car-online_80590-7849.jpg" alt="EcoRIDE Center Image" class="center-image"> <!-- Imahe sa gitna ng page -->

    <!-- Car Image (right-bottom) -->
    <img src="https://img.freepik.com/premium-vector/ready-use-flat-icon-carpooling_67813-14617.jpg?semt=ais_hybrid" alt="Car Side View" class="car-image"> <!-- Imahe ng kotse sa kanang ibaba -->

    <!-- New Right-center Image -->
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTlXphSOQO_3fALydkBLGBBA60gYHR_9Jm7Q&s" alt="Car Ride App" class="right-center-image"> <!-- Bagong imahe na nasa kanan ng page -->
</body>
</html>

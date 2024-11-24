<?php 
$servername = "127.0.0.1";  // Tamang address ng MySQL server (localhost) para sa lokal na server
$username = "root";         // Username para sa MySQL (karaniwang 'root' sa lokal na server)
$password = "";             // Password para sa MySQL (walang password kung hindi naka-set)
$dbname = "carpooling";     // Pangalan ng database na gagamitin para sa carpooling system

// Gumawa ng koneksyon sa database gamit ang MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Suriin kung may error sa koneksyon
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);  // Kung may error sa koneksyon, ititigil ang script at ipapakita ang error
}
?>


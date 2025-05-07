<?php 


if ($_SERVER["REQUEST_METHOD"] === "POST") {
$firstName = $_POST["firstName"] ?? '';
  $lastName = $_POST["lastName"] ?? '';
  $email = $_POST["email"] ?? '';
  $subject = $_POST["subject"] ?? '';
  $message = $_POST["message"] ?? '';

  // Connect to database
  $servername = "localhost";
  $username = "root";       // XAMPP/WAMP default
  $password = "";           // Leave empty for XAMPP
  $dbname = "zeta_form";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    http_response_code(500);
    echo "Database connection failed: " . $conn->connect_error;
    exit;
  }
  // Prepare & bind
  $stmt = $conn->prepare("INSERT INTO messages (first_name, last_name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $firstName, $lastName, $email, $subject, $message);

  if ($stmt->execute()) {
    echo "Your message has been submitted successfully.";
  } else {
    http_response_code(500);
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
} else {
  http_response_code(405);
  echo "Invalid request.";
}
?>


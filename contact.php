<?php 

session_start();

include 'connect.php'; // Include the database connection file


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $firstName = htmlspecialchars($_POST['firstName'] ?? '');
  $lastName = htmlspecialchars($_POST['lastName'] ?? '');
  $email = htmlspecialchars($_POST['email'] ?? '');
  $subject = htmlspecialchars($_POST['subject'] ?? '');
  $message = htmlspecialchars($_POST['message'] ?? '');
  $newSub = htmlspecialchars($_POST['newSub'] ?? '');


  // Prepare & bind
  $stmt = $conn->prepare("INSERT INTO formdata (first_name, last_name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
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


<?php 


if ($_SERVER["REQUEST_METHOD"] === "POST") {
$firstName = $_POST["firstName"] ?? '';
  $lastName = $_POST["lastName"] ?? '';
  $email = $_POST["email"] ?? '';
  $subject = $_POST["subject"] ?? '';
  $message = $_POST["message"] ?? '';

  // Example: Email handling (you can also insert into DB here)
	$to = "timone427@gmail.com";
  $fullName = "$firstName $lastName";
  $body = "From: $fullName\nEmail: $email\n\nSubject: $subject\n\nMessage:\n$message";

  if (mail($to, $subject, $body, "From: $email")) {
    echo "Message sent successfully!";
  } else {
    echo "Failed to send message.";
  }
} else {
  echo "Invalid request.";
}


?>
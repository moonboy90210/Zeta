<?php
require_once '../connect.php';
require_once '../includes/auth_check.php';


// Get total messages
$messages_result = $conn->query("SELECT COUNT(*) AS total_messages FROM formdata");
$messages_count = $messages_result->fetch_assoc()['total_messages'] ?? 0;

// Get total admins
$admins_result = $conn->query("SELECT COUNT(*) AS total_admins FROM zeta_admins");
$admins_count = $admins_result->fetch_assoc()['total_admins'] ?? 0;

// Future: Total shipments (placeholder)
$total_shipments = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Zeta Admin Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="#">Zeta Admin</a>
			<div class="d-flex">
				<a href="messages.php" class="btn btn-outline-light me-2">Messages</a>
				<a href="logout.php" class="btn btn-danger">Logout</a>
			</div>
		</div>
	</nav>

	<div class="container mt-4">
		<div class="my-5">
			<h2>Welcome, <?= htmlspecialchars($_SESSION['admin_username']) ?> 👋</h2>
			<p class="lead">Use the buttons above to manage messages and your session.</p>
		</div>
		<div class="row g-4">
			<div class="col-md-4">
				<div class="card shadow-sm p-3">
					<div class="d-flex align-items-center">
						<div class="me-3 card-icon"><i class="fas fa-envelope"></i></div>
						<div>
							<h5>Total Submissions</h5>
							<h3><?= $messages_count ?></h3>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="card shadow-sm p-3">
					<div class="d-flex align-items-center">
						<div class="me-3 card-icon"><i class="fas fa-user-shield"></i></div>
						<div>
							<h5>Admin Users</h5>
							<h3><?= $admins_count ?></h3>
						</div>
					</div> 
				</div>
			</div>

			<div class="col-md-4">
				<div class="card shadow-sm p-3">
					<div class="d-flex align-items-center">
						<div class="me-3 card-icon"><i class="fas fa-box"></i></div>
						<div>
							<h5>Total Shipments</h5>
							<h3><?= $total_shipments ?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="mt-4">
			<a href="messages.php" class="btn btn-outline-primary me-2"><i class="fas fa-eye"></i> View Submissions</a>
			<a href="logout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
		</div>
	</div>


</body>

</html>
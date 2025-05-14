
<?php
require_once '../includes/auth_check.php';
require_once '../connect.php';


// Search
$search = $_GET['search'] ?? '';

// Sort
$sort_column = $_GET['sort'] ?? 'submitted_at';
$allowed_sorts = ['first_name', 'email', 'subject', 'submitted_at'];
$sort_column = in_array($sort_column, $allowed_sorts) ? $sort_column : 'submitted_at';

$sql = "SELECT * FROM formdata 
        WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR subject LIKE ? 
        ORDER BY $sort_column DESC";
$stmt = $conn->prepare($sql);
$search_term = "%$search%";
$stmt->bind_param("ssss", $search_term, $search_term, $search_term, $search_term);
$stmt->execute();
$result = $stmt->get_result();

// Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM formdata WHERE id = $id");
    header("Location: messages.php");
    exit;
}

// Fetch all messages
$result = $conn->query("SELECT * FROM formdata ORDER BY submitted_at DESC");
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Zeta Contact</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Zeta Admin</a>
    <div class="d-flex">
      <a href="dashboard.php" class="btn btn-outline-light me-2">Dashboard</a>
      <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
  </div>
</nav>

<div class="container py-5">
  <h2 class="mb-4">Contact Submissions</h2>
  <form method="get" class="row g-3 my-3">
    <div class="col-md-6">
      <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Search by name, email or subject">
    </div>
    <div class="col-md-2">
      <select name="sort" class="form-select">
        <option value="submitted_at" <?= $sort_column == 'submitted_at' ? 'selected' : '' ?>>Newest</option>
        <option value="first_name" <?= $sort_column == 'first_name' ? 'selected' : '' ?>>First Name</option>
        <option value="email" <?= $sort_column == 'email' ? 'selected' : '' ?>>Email</option>
        <option value="subject" <?= $sort_column == 'subject' ? 'selected' : '' ?>>Subject</option>
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-dark">Filter</button>
    </div>
  </form>

  <table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['first_name']) ?></td>
            <td><?= htmlspecialchars($row['last_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['subject']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
            <td><?= $row['submitted_at'] ?></td>
            <td><a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this data?');">Delete</a></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="7" class="text-center">No messages found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>

<?php $conn->close(); ?>

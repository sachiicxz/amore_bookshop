<?php
include "db.php"; // Ensure this file correctly connects to the database

if (isset($_GET['query'])) {
    $search = trim($_GET['query']); // Remove extra spaces
    $search = strtolower($search); // Convert input to lowercase

    // SQL query for a case-insensitive search
    $query = "SELECT * FROM books WHERE LOWER(title) LIKE ? OR LOWER(author) LIKE ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error); // Show the SQL error
    }

    $search_param = "%{$search}%";
    $stmt->bind_param("ss", $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h2>Search Results</h2>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p><strong>Title:</strong> " . htmlspecialchars($row['title']) . "</p>";
            echo "<p><strong>Author:</strong> " . htmlspecialchars($row['author']) . "</p>";
            echo "<hr>";
        }
    } else {
        echo "<p>No results found for '<strong>" . htmlspecialchars($_GET['query']) . "</strong>'</p>";
    }

    $stmt->close();
    $conn->close();
    //dipa functional yung search.php
}
?>


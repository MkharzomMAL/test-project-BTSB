<?php
$db_host = 'db';
$db_user = 'root';
$db_password = 'root';
$db_name = 'web_DB';

$db = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

// Check if the table exists
$tableExistsSql = "SHOW TABLES LIKE 'users'";
$result = $db->query($tableExistsSql);

if ($result->num_rows > 0) {
    // echo "Table 'users' already exists. Skipping creation and data insertion.\n";
} else {
    // Create the table
    $createTableSql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($db->query($createTableSql) === TRUE) {
        // echo "Table 'users' created successfully\n";

        // Insert sample data
        $insertDataSql = "INSERT INTO users (username, password, email) VALUES
            ('john_doe', 'password123', 'john@example.com'),
            ('jane_smith', 'secret456', 'jane@example.com')";

        if ($db->query($insertDataSql) === TRUE) {
            // echo "Sample data inserted successfully\n";
        } else {
            // echo "Error inserting sample data: " . $db->error . "\n";
        }
    } else {
        // echo "Error creating table: " . $db->error . "\n";
    }
}

?>

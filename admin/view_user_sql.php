<?php
function getUsers() {
    include '../includes/db_connection.php';

    if (!$db) {
        die("Failed to connect to the database.");
    }

    $sql = "SELECT * FROM user

    JOIN
        branch ON user.branch_id = branch.branch_id";

    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    if (!$result) {
        die("Error executing query: " . $db->lastErrorMsg());
    }

    $arrayResult = [];
    while ($row = $result->fetchArray()) {
        $arrayResult[] = $row;
    }

    $db->close();

    return $arrayResult;
}
?>


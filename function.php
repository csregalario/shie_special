<?php

    // use this on my admin side product.php

/**
 * Check if a value exists in a column of a table
 *
 * @param mysqli $conn The database connection object
 * @param string $value The value to check
 * @param string $column The column name to check
 * @param string $table The table name to check
 * @return bool Returns true if the value exists in the column, false otherwise
 */
function is_existing(mysqli $conn, string $value, string $column, string $table): bool
{
    $value = mysqli_real_escape_string($conn, $value);
    $column = mysqli_real_escape_string($conn, $column);
    $table = mysqli_real_escape_string($conn, $table);

    $query = "SELECT COUNT(*) AS count FROM $table WHERE $column = '$value'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return ($row['count'] > 0);
    }

    return false;
}
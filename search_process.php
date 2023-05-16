<?php
include_once 'connection.php';

//check if the search query is submitted
if (isset($_GET['search'])) {
    //Sanitize and store the search query
    $searchQuery = $_GET['search'];

    //prepare SQL statement with a placeholder for the search query
    $sql = "SELECT * FROM item WHERE item_name LIKE :query";
    $stmt = $db->prepare($sql);

    //Bind the search query value to the placeholder
    $searchQuery = "%{$searchQuery}%"; //add wildcards to search for the partial matches
    $stmt->bindParam(':query', $searchQuery, PDO::PARAM_STR);

    //execute the sql statement
    $stmt->execute();

    //fetch the results
    $results = $stmt->fetchALL(PDO::FETCH_ASSOC);

    //display the results
    if ($stmt->rowCount() > 0) {
        echo "<h2>Search Results</h2>";
        echo "<ul>";
        foreach ($results as $row) {
            echo "<li>{$row['item_name']}</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No results found.</p>";
    }
}

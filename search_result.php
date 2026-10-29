<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Used Car </title>
</head>
<body>
    <h1>Search Results</h1>
    <?php
require_once "settings.php";
$conn = @mysqli_connect ($host, $user, $pwd,$sql_db);

if ($conn){
    if (isset($_GET['model'])) {
    $model = mysqli_real_escape_string($conn, $_GET['model']);
    $sql = "SELECT * FROM cars WHERE model LIKE '%$model%'";
    $result = mysqli_query($conn, $sql);
if($result){
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>ID</th><th>Make</th><th>Model</th><th>Price</th><th>Year</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['car_id'] . "</td>";
            echo "<td>" . $row['make'] . "</td>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['yom'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "🚫 No matching cars found.";
    }
        mysqli_free_result($result);
} else {
    echo "<p>Query failed</p>.";
}
 } else   {
echo"Please enter a model to search.";
    }

mysqli_close($conn);
    }else{
       echo "<p>Unable to connect to the db.</p>";
    }
?>
<br>
<a href="search_form.php">Back to search</a>
</body>
</html>
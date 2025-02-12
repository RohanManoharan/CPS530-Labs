<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');

$query = "SELECT * FROM Pictures WHERE location = 'Ontario'";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<div style='text-align: center; font-family: Arial, sans-serif; margin: 20px;'>";

    while ($row = mysqli_fetch_assoc($result)) {
        $pic = $row["picture_url"];
        $subject = $row["subject"];
        $location = $row["location"];
        $date = $row["date_taken"];

        echo "<div style='display: inline-block; margin: 15px; text-align: center;'>";
        echo "<img src=\"https://www.cs.torontomu.ca/~rpmanoha/lab09/$pic\" alt='Image' style='width: 300px; height auto; border: 1px solid #ccc;'><br>";
        echo "<span style='font-size: 1.0em;'><strong>$subject</strong></span><br>";
        echo "<span style='font-size: 0.9em;'>$location </span>";
        echo "<span style='font-size: 0.9em;'>$date</span>";
        echo "</div>";
    }

    echo "</div>";
} else {
    echo "<div style='text-align: center; font-family: Arial, sans-serif; margin: 20px; font-size: 1.2em;'>No pictures taken in Ontario found.</div>";
}
?>

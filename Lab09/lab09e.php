<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');

// Query to get the total number of images in the database
$count_query = "SELECT COUNT(*) AS total_images FROM Pictures";
$count_result = mysqli_query($connect, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_images = $count_row['total_images'];

// Query to get one random image
$random_query = "SELECT * FROM Pictures ORDER BY RAND() LIMIT 1";
$random_result = mysqli_query($connect, $random_query);
$random_row = mysqli_fetch_assoc($random_result);

echo "<div style='text-align: center; font-family: Arial, sans-serif; margin: 20px;'>";

// Check if there is a random image result
if ($random_row) {
    $pic = $random_row["picture_url"];
    $subject = $random_row["subject"];
    $location = $random_row["location"];
    $date = $random_row["date_taken"];

    // Display the random image with a caption
    echo "<div style='display: inline-block; margin: 15px; text-align: center;'>";
    echo "<img src=\"https://www.cs.torontomu.ca/~rpmanoha/lab09/$pic\" alt='Image' style='width: 300px; height auto; border: 1px solid #ccc;'><br>";
    echo "<span style='font-size: 1.0em;'><strong>$subject</strong></span><br>";
    echo "<span style='font-size: 0.9em;'>$location </span>";
    echo "<span style='font-size: 0.9em;'>$date</span>";
    echo "</div>";
} else {
    echo "<div style='text-align: center; font-family: Arial, sans-serif; margin: 20px; font-size: 1.2em;'>No images found in the database.</div>";
}

// Display the total number of images
echo "<div style='text-align: center; font-family: Arial, sans-serif; margin-top: 20px; font-size: 1.2em;'>Total number of images in the database: $total_images</div>";

echo "</div>";

// Free the results
mysqli_free_result($count_result);
mysqli_free_result($random_result);
?>

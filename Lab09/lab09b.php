<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');

$query = "SELECT * FROM Pictures ORDER BY date_taken DESC";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    $current_date = null;

    echo "<div style='text-align: center; font-family: Arial, sans-serif; margin: 20px;'>"; 

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["date_taken"] !== $current_date) {
            // Start a new date group
            $current_date = $row["date_taken"];
            echo "<h2>Pictures from: $current_date</h2>";
        }
        
        $pic = $row["picture_url"];
        $subject = $row["subject"];
        $location = $row["location"];
        $date = $row["date_taken"];
        echo "<div align='center' 
        text-align:center;
        width:40%;height:auto;
        font-size:1.2em;'>";        
        echo "<img src=\"https://www.cs.torontomu.ca/~rpmanoha/lab09/$pic\" alt='Image' style='width: 300px; height auto; border: 1px solid #ccc;'><br>";
        echo "<span style='font-size: 1.0em;'><strong>$subject</strong></span><br>";
        echo "<span style='font-size: 0.9em;'>$location</span>";
        echo "<span style='font-size: 0.9em;'>$date</span>";

        echo "</div>";

        echo  " " . $row["date_taken"] . " " . $row["picture_url"] . "<br>";
    }

    echo "</div>";
} else {
    echo "<div style='text-align: center; font-family: Arial, sans-serif; margin: 20px;'>No results found.</div>";
}
?>

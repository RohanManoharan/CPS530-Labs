<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');

$location_query = "SELECT DISTINCT location FROM Pictures ORDER BY location";
$location_result = mysqli_query($connect, $location_query);

$year_query = "SELECT DISTINCT date_taken AS year FROM Pictures ORDER BY year DESC";
$year_result = mysqli_query($connect, $year_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selected_location = $_POST['location'];
    $selected_year = $_POST['year'];

    $query = "SELECT * FROM Pictures WHERE location = '$selected_location' AND date_taken = '$selected_year'";
    $result = mysqli_query($connect, $query);

    echo "<div style='text-align: center; font-family: Arial, sans-serif; margin: 20px;'>";

    if (mysqli_num_rows($result) > 0) {
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
    } else {
        echo "<div style='text-align: center; font-family: Arial, sans-serif; margin: 20px; font-size: 1.2em;'>No pictures found matching the criteria.</div>";
    }

    echo "</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>lab09d</title>
    <style>
        
        form{
            text-align:center;
        }

        select, input[type="submit"] {
            margin: 5px;
            padding: 5px;
            font-size: 1em;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form method="POST" action="">
            <div>
                <label for="location">Select Location:</label>
                <select name="location" id="location">
                    <option value="">Select Location</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($location_result)) {
                        echo "<option value='" . htmlspecialchars($row['location']) . "'>" . htmlspecialchars($row['location']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="year">Select Year:</label>
                <select name="year" id="year">
                    <option value="">Select Year</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($year_result)) {
                        echo "<option value='" . htmlspecialchars($row['year']) . "'>" . htmlspecialchars($row['year']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <input type="submit" value="Search">
            </div>
        </form>
    </div>
</body>
</html>

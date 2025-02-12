<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');

$drop = "DROP TABLE IF EXISTS Pictures;";

if (mysqli_query($connect, $drop)) {
    echo "Table dropped successfully: " . $drop . "<br>";
} else {
    echo "Error dropping table: " . mysqli_error($connect) . "<br>";
}

$table = "CREATE TABLE Pictures (
            picture_number INT(2) PRIMARY KEY, 
            subject VARCHAR(255) NOT NULL,
            location VARCHAR (255) NOT NULL,
            date_taken VARCHAR(255) NOT NULL,
            picture_url VARCHAR(255) NOT NULL);";

if (mysqli_query($connect, $table)) {
    echo "Table Successfully Created<br>";
} else {
    echo "Error: " . $table . "<br>" . mysqli_error($connect);
}

$insert = [
    "INSERT INTO Pictures (picture_number, subject, location, date_taken, picture_url) VALUES (01, 'CN Tower', 'Ontario', '2024', 'cntower.jpg');",
    "INSERT INTO Pictures (picture_number, subject, location, date_taken, picture_url) VALUES (02, 'Mountains', 'Alberta', '2020', 'mountain.jpg');",
    "INSERT INTO Pictures (picture_number, subject, location, date_taken, picture_url) VALUES (03, 'Park', 'Alberta', '2021', 'banff.jpg');",
    "INSERT INTO Pictures (picture_number, subject, location, date_taken, picture_url) VALUES (04, 'Snow', 'British Columbia', '2023', 'whistler.jpg');",
    "INSERT INTO Pictures (picture_number, subject, location, date_taken, picture_url) VALUES (05, 'Harbor', 'Prince Edward Island', '2023', 'harbor.jpg');",
    "INSERT INTO Pictures (picture_number, subject, location, date_taken, picture_url) VALUES (06, 'Cuisine', 'Montreal', '2020', 'cuisine.jpg');",
    "INSERT INTO Pictures (picture_number, subject, location, date_taken, picture_url) VALUES (07, 'Niagara', 'Alberta', '2012', 'Niagara.jpg');",
    "INSERT INTO Pictures (picture_number, subject, location, date_taken, picture_url) VALUES (08, 'Toronto', 'Ontario', '2011', 'toronto.jpg');",
    "INSERT INTO Pictures (picture_number, subject, location, date_taken, picture_url) VALUES (09, 'Kelowna', 'British Columbia', '2021', 'Kelowna.jpg');",
    "INSERT INTO Pictures (picture_number, subject, location, date_taken, picture_url) VALUES (10, 'Vancouver', 'British Columbia', '2022', 'vancouver.jpg');"
];

foreach ($insert as $query) {
    if (mysqli_query($connect, $query)) {
        echo "Record inserted successfully: $query<br>";
    } else {
        echo "Error inserting record: " . mysqli_error($connect) . "<br>";
    }
}

for ($i = 1; $i <= 10; ++$i) {
    $result = mysqli_query($connect, "SELECT * FROM Pictures WHERE picture_number = $i");
    $line = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($line) {
        $cover = $line["picture_url"];
        echo "<div align='center' 
                    style='float:left;
                    text-align:center;
                    width:40%;height:auto;
                    font-size:1.2em;'>";
        echo "<span style='font-size:1.0em;'># $i</span><br>";
        echo "<img src=\"https://www.cs.torontomu.ca/~rpmanoha/lab09/$cover\" alt='Image' style='width: 300px; height auto;'><br>";
        echo "</div>";
    }

    mysqli_free_result($result);
}

?>
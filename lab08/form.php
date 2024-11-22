<?php 
$X = $_POST['x'];
$Y = $_POST['y'];

validate($X, $Y);

function validate($X, $Y) {
    if (($X >= 3 && $X <= 12) && ($Y >= 3 && $Y <= 12)) {
        echo "<style>
        table {
            border: 1px solid; 
            border-collapse: collapse;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }
        td, th {
            padding: 15px;
            border: 1px solid;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        th {
            background-color: #8d1fc0;
            color: white;
        }
      </style>";


        echo "<table>";        
        echo "<tr>";
        echo "<th></th>"; 
        for ($col = 1; $col <= $Y; $col++) {
            echo "<th>" . $col . "</th>"; 
        }
        echo "</tr>";

        for ($row = 1; $row <= $X; $row++) {
            echo "<tr>";
            echo "<th>" . $row . "</th>"; 
            for ($col = 1; $col <= $Y; $col++) {
                echo "<td>" . ($col * $row) . "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<h1 style='color:red; text-align: center;'>
                One or both of these numbers are not between 3 and 12!
              </h1><br>";
    }
}

?>
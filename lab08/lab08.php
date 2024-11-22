<?php
// Debugging: Display all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start output buffering to prevent header issues

// Handle image selection and set cookie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image_click'])) {
    // Sanitize the input to prevent security issues
    $selectedImage = htmlspecialchars($_POST['image_click']);
    setcookie('favorite_image', $selectedImage, time() + 60 * 60 * 24, "/"); // 86400 seconds = 24 hours
    // Redirect to avoid form resubmission on page refresh
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Retrieve favorite image from cookie if set
$favoriteImage = isset($_COOKIE['favorite_image']) ? $_COOKIE['favorite_image'] : null;

$currentHour = date("H");
if ($currentHour >= 5 && $currentHour < 12) {
    $message = "Good Morning!";
    $customStyle = "background-image: url('morning.jpg'); background-position: center -4000px; width: 100%; height: 100%;";
} elseif ($currentHour >= 12 && $currentHour < 18) {
    $message = "Good Afternoon!";
    $customStyle = "background-image: url('afternoon.jpg'); background-position: center -2000px; width: 100%; height: 100%;";
} elseif ($currentHour >= 18 && $currentHour < 21) {
    $message = "Good Evening!";
    $customStyle = "background-image: url('evening.jpg'); background-position: center; width: 100%; height: 100%;";
} else {
    $message = "Good Night!";
    $customStyle = "background-image: url('night.jpg'); background-position: center; width: 100%; height: 100%;";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab08</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #P1 {
            padding: 20px;
            color: white;
        }

        #P2,
        #P3 {
            text-align: center;
        }

        #thanks {
            height: 200px;
            width: auto;
        }

        iframe {
            width: 60%;
            height: auto;
            border: 2px solid black;
            padding: 10px;
        }

        #error-message {
            color: red;
        }

        .cookie-display {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
        }
    </style>

    <script>
        function validateAndSubmit(event) {
            event.preventDefault();
            const x = parseInt(document.getElementById('x').value);
            const y = parseInt(document.getElementById('y').value);

            if ((x >= 3 && x <= 12) && (y >= 3 && y <= 12)) {
                // Submit the form to the iframe
                document.getElementById('form').submit();
                document.getElementById('error-message').textContent = "";
            } else {
                document.getElementById('error-message').textContent =
                    "Both numbers must be between 3 and 12.";
            }
        }
    </script>

</head>

<body>

<div id="P1" style="<?php echo $customStyle; ?>">
            <h1><?php echo $message; ?></h1>
        </div>

    <div id="P2">
        <h1>Multiplication Table</h1>
        <form id="form" action="form.php" method="POST" target="output-iframe">
            <label for="x">Number of Rows:</label>
            <input type="number" id="x" name="x" required>
            <label for="y">Number of Columns:</label>
            <input type="number" id="y" name="y" required>
            <button type="submit" onclick="validateAndSubmit(event)">Generate Table</button>
        </form>
        <div id="error-message" class="error"></div>
        <br>
        <iframe name="output-iframe"></iframe>
    </div>

    <div id="P3">
        <h1>Image Cookies</h1>
        <p>Click one of these images to mark it as your favorite! The cookie will expire in one day.</p>
        <div id="images">
            <?php
            $images = [
                'hat1.png' => 'Hat',
                'pilgrim01.png' => 'Pilgrim',
                'thanks_icon.png' => 'Thanks Icon',
                'cornucopia.png' => 'Cornucopia',
                'wheat.png' => 'Wheat'
            ];
            foreach ($images as $filename => $label): ?>
                <form method="post" style="display: inline;">
                    <input type="hidden" name="image_click" value="<?php echo htmlspecialchars($filename); ?>">
                    <button type="submit" class="image-button">
                        <img id="thanks" src="<?php echo htmlspecialchars($filename); ?>" alt="<?php echo htmlspecialchars($label); ?>">
                    </button>
                </form>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if ($favoriteImage): ?>
        <div class="cookie-display">
            <img id="thanks" src="<?php echo htmlspecialchars($favoriteImage); ?>" alt="Favorite Image">
            <p style="font-size: 1.2em; margin: 0;"><?php echo htmlspecialchars($favoriteImage); ?></p>
        </div>
    <?php else: ?>
        <div class="cookie-display">
            <p style="font-size: 1.2em; margin: 0;">No favorite image selected yet!</p>
        </div>
    <?php endif; ?>

</body>

</html>
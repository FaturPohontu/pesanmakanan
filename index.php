<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/projek/styles.css">
</head>

<body>
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'home.php';
    ?>
    <?php include 'header.php';
    ?>
    <div class="container mt-4">
        <?php
        // Allowed pages
        $allowed_pages = ['home.php', 'beli.php', 'proses/proses_keluar.php', 'riwayat.php', 'd_admin.php'];

        // Get the page name and sanitize
        $page = isset($_GET['page']) ? basename($_GET['page']) : 'home.php';

        // Check if the page is allowed
        if (in_array($page, $allowed_pages)) {
            include $page;
        } else {
            echo "<h1>404 - Page Not Found</h1>";
        }
        ?>
    </div>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- includes/footer.php -->
    <footer class="fixed-bottom text-center bg-light">
        <p>&copy; 2024 My Website</p>
    </footer>
</body>

</html>
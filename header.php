<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="?page=home.php">Rice Bowl</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="?page=home.php">Home</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                <?php 
                // Pastikan session dimulai
                if (isset($_SESSION['username'])) {
                    echo "<span class='navbar-text'>Hello, " . $_SESSION['username'] . "</span>";
                } else {
                    echo "<span class='navbar-text'>Welcome, Guest</span>";
                }
                ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
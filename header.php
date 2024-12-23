<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <div class="container-lg">
            <a class="navbar-brand text-light" href="?page=home.php">Rice Bowl</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
                    // Pastikan session dimulai
                    if (isset($_SESSION['username'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= htmlspecialchars($_SESSION['username']); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="proses/proses_keluar.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="guestDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Welcome, Guest
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="guestDropdown">
                                <li><a class="dropdown-item" href="?page=login.php">Login</a></li>
                                <li><a class="dropdown-item" href="?page=register.php">Daftar</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
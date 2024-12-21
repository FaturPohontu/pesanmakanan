<!-- form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/login.css">
    <title>Document</title>
</head>
<body>
<div class="container">
        <h2 class="text-center mt-5">Login</h2>
        <div class="card shadow-sm mt-4">
            <div class="card-body">
                <form action="" method="POST">
                    <!-- Nama Input -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Anda</label>
                        <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" required>
                        <div class="invalid-feedback">Harap isi Nama Anda</div>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" required>
                        <div class="invalid-feedback">Harap Isi Password</div>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                    <a href="register.php">Register</a>
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link rel="icon" type="image/png" href="./public/images/itats_icon.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .error-container {
            max-width: 500px;
            padding: 20px;
        }
        .error-code {
            font-size: 100px;
            font-weight: bold;
            color: #dc3545;
        }
        .error-message {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .logo-container {
            margin-bottom: 20px;
        }
        .logo-container img {
            max-width: 150px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <!-- Logo Instansi -->
        <div class="logo-container">
            <img src="./public/images/Logo_ITATS.png" alt="Logo Instansi">
        </div>

        <div class="error-code">404</div>
        <h3 class="error-message"><i class="fas fa-exclamation-triangle text-danger"></i> Halaman Tidak Ditemukan</h3>
        <p>
            Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.<br>
            Silakan kembali ke halaman utama.
        </p>
        <a href="index.php" class="btn btn-primary"><i class="fas fa-home"></i> Kembali ke Dashboard</a>
    </div>
</body>
</html>

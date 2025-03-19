<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik - Pengguna</title>
    <link rel="icon" type="image/png" href="./public/images/itats_icon.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include './resources/views/include/navbarSistem.php'; ?>
        <?php include './resources/views/include/sidebar.php'; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Manajemen Pengguna</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Daftar Pengguna</h3>
                            <a href="index.php?modul=pengguna&fitur=create" class="btn btn-primary btn-sm ml-auto">
                                <i class="fas fa-plus"></i> Tambah Pengguna
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="penggunaTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Pengguna</th>
                                        <th>Nama Pengguna</th>
                                        <th>Email Pengguna</th>
                                        <th>Username Pengguna</th>
                                        <th>Peran Pengguna</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($penggunas as $index => $pengguna) : ?>
                                        <tr>
                                            <td><?= $index + 1; ?></td>
                                            <td><?= htmlspecialchars($pengguna['id_user']); ?></td>
                                            <td><?= htmlspecialchars($pengguna['nama_user']); ?></td>
                                            <td><?= htmlspecialchars($pengguna['email_user']); ?></td>
                                            <td><?= htmlspecialchars($pengguna['username']); ?></td>
                                            <td><?= htmlspecialchars($pengguna['role_name']); ?></td>
                                            <td>
                                                <a href="index.php?modul=pengguna&fitur=edit&id_user=<?= $pengguna['id_user']; ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="index.php?modul=pengguna&fitur=delete&id_user=<?= $pengguna['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include './resources/views/include/footerSistem.php' ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#penggunaTable").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
        });
    </script>
</body>
</html>

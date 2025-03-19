<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
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
                            <h1 class="m-0">Update Data Pengguna</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <?php if (isset($error)) : ?>
                                <div class="alert alert-danger"> <?= htmlspecialchars($error); ?> </div>
                            <?php endif; ?>

                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama_user">Nama Pengguna</label>
                                    <input type="text" class="form-control" name="nama_user" value="<?= htmlspecialchars($pengguna['nama_user'] ?? '') ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email_user">Email Pengguna</label>
                                    <input type="email" class="form-control" name="email_user" value="<?= htmlspecialchars($pengguna['email_user'] ?? '') ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username Pengguna</label>
                                    <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($pengguna['username'] ?? '') ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="role_id">Peran Pengguna</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                        </div>
                                        <select class="form-control" id="role_id" name="role_id" required>
                                            <option value="" disabled>Pilih Peran</option>
                                            <?php foreach ($roles as $role) { ?>
                                                <option value="<?= htmlspecialchars($role['role_id']) ?>" 
                                                    <?= (isset($pengguna['role_id']) && $pengguna['role_id'] == $role['role_id']) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($role['role_name']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                <a href="index.php?modul=pengguna&fitur=list" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include './resources/views/include/footerSistem.php'; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = "block";
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>

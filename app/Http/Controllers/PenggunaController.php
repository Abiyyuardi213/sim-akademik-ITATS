<?php
include './app/Models/Pengguna.php';
include './app/Models/Role.php';

class ControllerPengguna {
    private $modelPengguna;
    private $modelRole;

    public function __construct() {
        $this->modelPengguna = new ModelPengguna();
        $this->modelRole = new ModelRole();
    }

    public function handleRequestPengguna($fitur) {
        $id_user = $_GET['id_user'] ?? null;

        switch ($fitur) {
            case 'create':
                $this->createPengguna();
                break;
            case 'edit':
                $this->editPengguna($id_user);
                // if ($pegawai_id) {
                //     $this->editPegawai($pegawai_id);
                // } else {
                //     header("Location: index.php?modul=pegawai&fitur=list");
                // }
                break;
            case 'delete':
                $this->deletePengguna();
                break;
            case 'list':
                $this->listPengguna();
                break;
            case 'detail':
                if ($id_user) {
                    $this->detailPengguna($id_user);
                } else {
                    header("Location: index.php?modul=pengguna&fitur=list");
                }
                break;
            // case 'login':
            //     $this->loginPengguna();
            //     break;
            default:
                $this->listPengguna();
                break;
        }
    }

    public function createPengguna() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_user = $_POST['nama_user'];
            $email_user = $_POST['email_user'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role_id = $_POST['role_id'];

            $isAdded = $this->modelPengguna->addPengguna($nama_user, $email_user, $username, $password, $role_id);

            if ($isAdded) {
                header('Location: index.php?modul=pengguna&fitur=list&message=Pengguna Berhasil Ditambahkan');
            } else {
                header('Location: index.php?modul=pengguna&fitur=create&message=Gagal Menambahkan Pengguna');
            }
            exit;
        }

        $roles = $this->modelRole->getRoles();
        include './resources/views/pengguna/PenggunaAdd.php';
    }

    public function editPengguna($id_user) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_POST['id_user'];
            $nama_user = $_POST['nama_user'];
            $email_user = $_POST['email_user'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role_id = $_POST['role_id'];

            $pengguna = $this->modelPengguna->getPenggunaById($id_user);

            $isUpdated = $this->modelPengguna->updatePengguna(
                $id_user, $nama_user, $email_user, $username,
                $password, $role_id
            );

            if ($isUpdated) {
                header('Location: index.php?modul=pengguna&fitur=list&message=Pengguna Berhasil Diubah');
            } else {
                header('Location: index.php?modul=pengguna&fitur=edit&id_user=' . $id_user . '&message=Gagal Mengubah Pengguna');
            }
            exit();
        }
        
        $pengguna = $this->modelPengguna->getPenggunaById($id_user);
        $roles = $this->modelRole->getRoles();
        include './resources/views/pengguna/PenggunaUpdate.php';
    }

    public function deletePengguna() {
        $id_user = $_GET['id_user'] ?? null;
        if ($id_user) {
            $this->modelPengguna->deletePengguna($id_user);
        }
        header("Location: index.php?modul=pengguna&fitur=list&message=Pengguna Berhasil Dihapus");
        exit();
    }

    public function detailPengguna($id_user) {
        $pengguna = $this->modelPengguna->getPenggunaById($id_user);
        include './resources/views/pengguna/PenggunaDetail.php';
    }

    public function listPengguna() {
        $searchTerm = $_GET['search'] ?? null;
        if ($searchTerm) {
            $penggunas = $this->modelPengguna->searchPenggunaByName($searchTerm);
        } else {
            $penggunas = $this->modelPengguna->getPenggunas();
        }
        include './resources/views/pengguna/PenggunaList.php';
    }

    // public function loginPengguna() {
    //     if (session_status() == PHP_SESSION_NONE) {
    //         session_start();
    //     }
    
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $username = $_POST['username'];
    //         $password = $_POST['password'];
    
    //         $pengguna = $this->modelPengguna->loginPengguna($username, $password);
    
    //         if ($pengguna) {
    //             $_SESSION['id_user'] = $pengguna['id_user'];
    //             $_SESSION['nama_user'] = $pengguna['nama_user'];
    //             $_SESSION['email_user'] = $pengguna['email_user'];
    //             $_SESSION['username'] = $pengguna['username'];
    //             $_SESSION['role_id'] = $pengguna['role_id'];
    //             $_SESSION['role_name'] = $pengguna['role_name'];
    //             $_SESSION['profile_picture'] = $pengguna['profile_picture'];
    //             $_SESSION['login_success'] = true;
    
    //             header('Location: index.php?modul=dashboard&message=Login Berhasil');
    //             exit();
    //         } else {
    //             header('Location: index.php?modul=pengguna&fitur=login&error=Username atau Password Salah');
    //             exit();
    //         }
    //     }
    //     include './resources/views/home/LoginView.php';
    // }
}

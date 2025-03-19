<?php
include './app/Models/Role.php';

class controllerRole {
    private $model;

    public function __construct() {
        $this->model = new modelRole();
    }

    public function handleRequestRole($fitur) {
        $role_id = $_GET['role_id'] ?? null;

        switch ($fitur) {
            case 'create':
                $this->createRole();
                break;
            case 'edit':
                if ($role_id) {
                    $this->updateRole((int)$role_id);
                } else {
                    header('Location: index.php?modul=role&fitur=list');
                }
                break;
            case 'delete':
                if ($role_id) {
                    $this->deleteRole((int)$role_id);
                } else {
                    header('Location: index.php?modul=role&fitur=list');
                }
                break;
            default:
                $this->listRoles();
                break;
        }
    }

    public function listRoles() {
        $searchTerm = $_GET['search'] ?? null;
        if ($searchTerm) {
            $roles = $this->model->searchRoleByName($searchTerm);
        } else {
            $roles = $this->model->getRoles();
        }
        include './resources/views/role/RoleList.php';
    }

    public function createRole() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role_name = $_POST['role_name'] ?? '';
            $role_description = $_POST['role_description'] ?? '';
            $role_status = $_POST['role_status'] ?? 0;

            $isAdded = $this->model->addRole($role_name, $role_description, (int)$role_status);

            if ($isAdded) {
                header('Location: index.php?modul=role&fitur=list&message=Peran Berhasil Ditambahkan');
            } else {
                header('Location: index.php?modul=role&fitur=create&message=Gagal Menambahkan Peran');
            }
            exit;
        } else {
            include './resources/views/role/roleAdd.php';
        }
    }

    public function updateRole($role_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role_name = $_POST['role_name'] ?? '';
            $role_description = $_POST['role_description'] ?? '';
            $role_status = $_POST['role_status'] ?? 0;

            $isUpdated = $this->model->updateRole($role_id, $role_name, $role_description, (int)$role_status);

            if ($isUpdated) {
                header('Location: index.php?modul=role&fitur=list&message=Peran Berhasil Diupdate');
            } else {
                header('Location: index.php?modul=role&fitur=update&message=Gagal Mengupdate Peran');
            }
            exit;
        } else {
            $role = $this->model->getRoleById($role_id);
            if (!$role) {
                header('Location: index.php?modul=role&fitur=list&message=Peran Tidak Ditemukan');
                exit;
            }
            include './resources/views/role/roleUpdate.php';
        }
    }

    public function deleteRole($role_id) {
        $result = $this->model->deleteRole($role_id);

        if ($result['success']) {
            header('Location: index.php?modul=role&fitur=list&message=Peran Berhasil Dihapus');
        } else {
            $error = $result['error'] ?? 'Gagal Menghapus Peran';
            header("Location: index.php?modul=role&fitur=list&error=$error");
        }
        exit;
    }
}
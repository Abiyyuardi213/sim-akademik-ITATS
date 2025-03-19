<?php
include './config/db_connect.php';

class modelRole {
    public function getRoles() {
        global $conn;
        $sql = "SELECT * FROM tb_role";
        $result = $conn->query($sql);

        $roles = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $roles[] = $row;
            }
        }
        return $roles;
    }

    public function getRoleById($role_id) {
        global $conn;
        $sql = "SELECT * FROM tb_role WHERE role_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $role_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addRole($role_name, $role_description, $role_status) {
        global $conn;
        $sql = "INSERT INTO tb_role (role_name, role_description, role_status) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $role_name, $role_description, $role_status);
        return $stmt->execute();
    }

    public function updateRole($role_id, $role_name, $role_description, $role_status) {
        global $conn;
        $sql = "UPDATE tb_role SET role_name = ?, role_description = ?, role_status = ? WHERE role_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $role_name, $role_description, $role_status, $role_id);
        return $stmt->execute();
    }

    public function deleteRole($role_id) {
        global $conn;
        $sqlCheck = "SELECT COUNT(*) AS count FROM tb_anggota WHERE role_id = ?";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param("i", $role_id);
        $stmtCheck->execute();
        $result = $stmtCheck->get_result();
        $count = $result->fetch_assoc()['count'];

        if ($count > 0) {
            return ['success' => false, 'error' => 'Role tidak bisa dihapus karena masih digunakan oleh user'];
        }

        $sql = "DELETE FROM tb_role WHERE role_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $role_id);

        if ($stmt->execute()) {
            return ['success' => true];
        }

        return ['success' => false, 'error' => 'Gagal menghapus role'];
    }

    public function searchRoleByName($searchTerm) {
        global $conn;
        $sql = "SELECT * FROM tb_role WHERE role_name LIKE ?";
        $stmt = $conn->prepare($sql);
        $likeTerm = "%$searchTerm%";
        $stmt->bind_param("s", $likeTerm);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $roles = [];
        while ($row = $result->fetch_assoc()) {
            $roles[] = $row;
        }
        return $roles;
    }

    public function getAllRoles() {
        return $this->getRoles();
    }
}
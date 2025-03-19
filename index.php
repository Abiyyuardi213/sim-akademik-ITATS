<?php
date_default_timezone_set('Asia/Jakarta');
session_start();

$modul = $_GET['modul'] ?? 'dashboard';
$fitur = $_GET['fitur'] ?? 'list';

switch ($modul) {
    case 'dashboard':
        include './resources/views/Dashboard.php';
        break;

    case 'role':
        require_once './app/Http/Controllers/RoleController.php';
        $controllerRole = new controllerRole();
        $controllerRole->handleRequestRole($fitur);
        break;

    case 'pengguna':
        require_once './app/Http/Controllers/PenggunaController.php';
        $controllerPengguna = new ControllerPengguna();
        $controllerPengguna->handleRequestPengguna($fitur);
        break;

    default:
        include './services/404notfound.php';
        break;
}
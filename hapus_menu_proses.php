<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    mysqli_query($conn, "DELETE FROM menu WHERE ID_Menu = $id");
}

header("Location: hapus_menu.php");
exit;

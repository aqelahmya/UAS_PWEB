<?php
session_start();
session_unset();
session_destroy();
header("Location: ../index.php"); // Sesuaikan file login Anda
exit;
?>
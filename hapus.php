<?php
require_once '../Database.php'; require_once '../AsetModel.php';
$model = new AsetModel((new Database())->getConnection());
if (isset($_GET['id'])) {
    $model->delete($_GET['id']);
}
header("Location: dashboard.php");
?>
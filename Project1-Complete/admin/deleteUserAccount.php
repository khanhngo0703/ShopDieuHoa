<?php
require_once 'connect.php';
require_once 'utils.php';

if (isset($_GET['id'])) {
    $id = sanitize($_GET['id']);
    try {
        $conn->begin_transaction();
        
        $sql = "DELETE FROM users WHERE id = $id";
        $conn->query($sql);
        
        $conn->commit();
        
        header('Location: index.php');
        exit; 
    } catch (Exception $e) {
        echo $e->getMessage();
        $conn->rollback();
    }
}
?>

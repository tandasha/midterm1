<?php
    require "init.php";

    $id = $_GET['id'];

    delete($id);

    back();
?>

<?php

session_start();
require_once '../database/db-con.php';

?>

<?php
session_destroy();
?>

<script>
    window.location = 'login.php';
</script>
<?php

session_start();
require_once 'database/db-con.php';

?>

<?php
session_destroy();
?>

<script>
    window.location = '<?php echo $very_global_absolute_url; ?>';
</script>
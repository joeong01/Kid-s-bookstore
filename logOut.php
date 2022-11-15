<?php
session_start();
session_unset();
echo "
    <script>
        alert('Log Out and continued as guest');
    </script>";

    header('Location: http://localhost/Kid-s-bookstore/index.php');
session_destroy();
?>
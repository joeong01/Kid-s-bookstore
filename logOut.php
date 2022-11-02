<?php
session_start();
session_unset();
echo "
    <script>
        alert('Log Out and continued as guest');
    </script>"
    ;

    header('Location: index.php');
session_destroy();
?>
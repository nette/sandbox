<?php
declare(strict_types=1);
header('Content-Type: application/javascript');
?>
nginxChecker = <?php echo isset($_GET['ok']) ? 1 : 0; ?>;

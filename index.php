<?php
// index.php
require_once 'config/config.php';

// Redirect langsung ke dashboard admin
header("Location: views/dashboard/admin.php");
exit();

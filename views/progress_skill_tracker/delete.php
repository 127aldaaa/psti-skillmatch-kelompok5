<?php
require_once '../../config/config.php';
require_once '../../functions/helper.php';
require_once '../../functions/progress_skill_tracker.php';

if (isset($_GET['id'])) {
    $id = sanitizeInput($_GET['id']);
    deleteProgressSkillTracker($id);
}

header("Location: index.php");
exit;
?>

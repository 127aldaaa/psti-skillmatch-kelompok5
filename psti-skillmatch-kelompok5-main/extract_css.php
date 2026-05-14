<?php
$content = file_get_contents(__DIR__ . '/views/dashboard/admin.php');
if (preg_match('/<style>(.*?)<\/style>/s', $content, $matches)) {
    if (!is_dir(__DIR__ . '/assets/css')) {
        mkdir(__DIR__ . '/assets/css', 0777, true);
    }
    file_put_contents(__DIR__ . '/assets/css/admin.css', trim($matches[1]));
    echo "CSS Extracted successfully.";
} else {
    echo "No style block found.";
}
?>

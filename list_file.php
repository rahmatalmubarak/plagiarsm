<?php

include('class.pdf2text.php');
include('copyscape_premium_api.php');
$dirUpload = "upload/";
$uploadedFiles = array_diff(scandir($dirUpload), array('..', '.'));

foreach ($uploadedFiles as $file) {
    echo "<li><a =\"$file\" target=\"_blank\">$file</a></li>";
}
?>

<?php
/*echo "<pre>";
print_r($_FILES);
echo "</pre>";*/
?>

<?php
session_start();
session_unset();
session_destroy();
header("Location: index.html");
exit();
?>

<?php
if ($img1_name != "") {
    @copy("img1", "photo/$img1_name")
    or die("Error: файл не скопирован!");
} else {
    die("Error: файл не найден");
}

?>

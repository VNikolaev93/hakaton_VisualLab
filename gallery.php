<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <a href="index.css"></a>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Посетитель мероприятия</title>
</head>
<body>

<!--<div class="padding">-->

<nav class="navbar" style="background-color: black;">
    <a class="nav-link" href="mainSTR.html"><img src="PNG/menu.png"> </a>
    <a class="nav-link active" href="organisator.html">1</a>
    <div class="logotype"><img src="PNG/web_logo.png"></div>
    <a class="nav-link" href="#">2</a>
    <div class="logotype"><img src="PNG/user.png"></div>
 </nav>
 <br>
    <div class="container">
        <h3>Фотографии с мероприятия: Хакатон</h3>
    </div>
<div class="container" style="display: flex; flex-direction: row; flex-wrap: wrap;">
<?php
    $folder = "./gallery";
    $items = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($folder)
    );
    $files = array();
    foreach ($items as $item) {
        if (!$item->isDir() && $item->getFilename() != basename($_SERVER['PHP_SELF']))
            $files[] = $item->getPathname();
    }
    $files = array_map(function ($item) use ($folder)
        {
            return mb_substr($item, mb_strlen($folder));
        }, 
        $files
    );
    usort($files, function($a, $b)
    {
        return strcmp(basename($a), basename($b));
    });
    //$str = implode(';', $files);
    $src = __DIR__;
    foreach ($files as $file)
    {
        echo '<div style="margin: 15px">' . "<a href='./gallery$file'" . 'target="_blank"> <image src=' . "/gallery" . $file . " width=240 height=240></a></div>";
    }
?>
</div> 
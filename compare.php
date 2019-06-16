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
            return substr($item, strlen($folder));
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
		`python3 ./my_script.py --img1 ./image/1.jpg --img2 ./gallery$file`;
    }
?>

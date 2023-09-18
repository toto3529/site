<?php


// Test changement droits du répertoire 'imgtest'
echo __FILE__.'<hr>';

$dirname = 'album-photo';
$filename = $dirname.'/0b2b970cc4b4bc752f78f06261d2c868.jpeg';

if (is_readable($dirname)) {
    echo 'Le répertoire est accessible en lecture';
} else {
    echo 'Le répertoire n\'est pas accessible en lecture !';
}

echo '<hr>';

if (is_readable($filename)) {
    echo 'Le fichier est accessible en lecture';
} else {
    echo 'Le fichier n\'est pas accessible en lecture !';
}

echo '<hr>';

echo fileperms($filename);

// chmod("imgtest", 0777);
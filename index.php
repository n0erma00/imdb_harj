<?php
    require_once('functions.php');

    $html = "<h2>IMDB listaukset</h2>";
    $html .= '<h3>Valitse genre</h3><form action="GET">';
    $html .= createGenreDropDown();

    $path = 'datasets';
     if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if ('.' === $file) continue;
            if ('..' === $file) continue;
            
            $html .= '<div><input type="submit" value="' . basename($file, ".php") . '"formaction="' . $path . "/" . $file . '"></div>';
        }
        closedir($handle); 
    }
    $html .= '</form>';

    echo $html;
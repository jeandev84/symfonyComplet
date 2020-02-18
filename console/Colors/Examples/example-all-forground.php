<?php

/*
All Foreground and background colors printed
*/
/* require_once __DIR__.'/../vendor/autoload.php'; */

use Framework\Colors\Color;


// Create new Colors class
$color = new Color();

// Get Foreground Colors
$fgs = $color->getForegroundColors();


// Get Background Colors
$bgs = $color->getBackgroundColors();

// Loop through all foreground and background colors
$count = count($fgs);
for ($i = 0; $i < $count; $i++) {
    echo $color->getColoredString("Test Foreground colors", $fgs[$i]) . "\t";
    if (isset($bgs[$i])) {
        echo $color->getColoredString("Test Background colors", null, $bgs[$i]);
    }
    echo "\n";
}
echo "\n";

// Loop through all foreground and background colors
foreach ($fgs as $fg) 
{
    foreach ($bgs as $bg) 
    {
        echo $color->getColoredString("Test Colors", $fg, $bg) . "\t";
    }
    echo "\n";
}

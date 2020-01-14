<?php
/*
Colors class basic usage examples
*/
/* require_once __DIR__.'/../vendor/autoload.php'; */

use Framework\Colors\Color;

// Create new Color class
$color = new Color();

// Test some basic printing with Color class
echo $color->getColoredString("Testing Colors class, this is purple string on yellow background.", "purple", "yellow") . "\n";
echo $color->getColoredString("Testing Colors class, this is blue string on light gray background.", "blue", "light_gray") . "\n";
echo $color->getColoredString("Testing Colors class, this is red string on black background.", "red", "black") . "\n";
echo $color->getColoredString("Testing Colors class, this is cyan string on green background.", "cyan", "green") . "\n";
echo $color->getColoredString("Testing Colors class, this is cyan string on default background.", "cyan") . "\n";
echo $color->getColoredString("Testing Colors class, this is default string on cyan background.", null, "cyan") . "\n";


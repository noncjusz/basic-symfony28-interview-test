<?php

// Bonus tasks
// 1.

$str1 = 'foobardoo';
$str2 = 'foo';

if (strpos($str1, $str2) !== false) {
    echo "\"" . $str1 . "\" contains \"" . $str2 . "\"";
} else {
    echo "\"" . $str1 . "\" does not contain \"" . $str2 . "\"";
}

// ---
// 3.

echo "Butter cost: " . (1.10 - 1) / 2 . "E"; // Butter cost: 0.05E

// ---
// 4. Solution in config.yml
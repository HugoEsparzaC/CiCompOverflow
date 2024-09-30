<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escape / Sanitize HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}
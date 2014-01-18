<?php

function checkMsg($message, $parse) {

    if (strpos($message, $parse) !== FALSE)
    return true;
    else
    return false;
}

function removeChunk($message, $keyword) {
    $index = strpos($keyword." ");
    $editted = str_replace($keyword.'',$message);
    return $editted;
}
?>
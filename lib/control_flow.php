<?php
require(__DIR__.DIRECTORY_SEPARATOR."parser_help.php")

define('SAVE',"@save")



if(checkMsg($msg, "@save")) {
    doSave($msg);
    $msg = removeChunk("@save")
}=
elseif (checkMsg($msg, "@invite") {
    # code...
}
?>
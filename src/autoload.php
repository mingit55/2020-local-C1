<?php
function classLoader($c){
    $className = str_replace("\\", DS, $c);
    $classPath = _SRC.DS.$className . ".php";
    if(is_file($classPath)){
        require $classPath;
    }
}

spl_autoload_register("classLoader");
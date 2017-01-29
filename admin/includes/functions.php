<?php
/*function classAutoLoader($class)
{
    $class = strtolower($class);
    $path  = "includes/{$class}.php";
    
    if (is_file($path) && !class_exists($class)) {
        include_once($path);
    } else {
        die("You need to declare {$class}.php ");
    }
}*/
function redirect($location)
{
    header("Location: {$location}");
}
/*
spl_autoload_register("classAutoLoader");*/
?>
<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */


spl_autoload_register(function ($nombre_clase) {

    $dirs = [CONTROLLERS_FOLDER, MODELS_FOLDER, REPOSITORIES_FOLDER];
    
    foreach ($dirs as $dir) {
        $ruta = dirname(__DIR__) . '\\' . $dir . '\\' . $nombre_clase . '.php';
        $ruta = str_replace("\\", DIRECTORY_SEPARATOR, $ruta);
        
        
        
        if (file_exists($ruta)) {
            require_once $ruta;
            return;
        }
    }
});

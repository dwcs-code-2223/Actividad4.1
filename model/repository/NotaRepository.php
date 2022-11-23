<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of noteRepository
 *
 * @author maria
 */
class NotaRepository implements INotaRepository{

    const RUTA_FICHERO = "config" . DIRECTORY_SEPARATOR . "notas.json";

    private $filePath;

    public function __construct() {
        $this->filePath = dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . self::RUTA_FICHERO;
       
    }

    public function getNotas(): array {

        return json_decode(file_get_contents($this->filePath), true);
    }

    public function saveNotas(array $notas): bool {

        $writtenBytes = file_put_contents($this->filePath, json_encode($notas));

        return ($writtenBytes !== false);
    }

  
}

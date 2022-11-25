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
class NotaRepository implements INotaRepository {

    const RUTA_FICHERO = "config" . DIRECTORY_SEPARATOR . "notas.json";

    private $filePath;
    //Array de objetos de la clase Nota
    private $arrayNotas = [];

    public function __construct() {
        $this->filePath = dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . self::RUTA_FICHERO;
        $arrayAsoc = json_decode(file_get_contents($this->filePath), true);
        foreach ($arrayAsoc as $key => $value) {
            $nota = Util::json_decode_array_to_class($value, "Nota");
            $this->arrayNotas[] = $nota;
        }
        // echo "## $this->filePath";
    }

    public function getNotas(): array {

        return $this->arrayNotas;
    }

    public function saveNotas(array $notas): bool {

        $writtenBytes = file_put_contents($this->filePath, json_encode($notas));

        return ($writtenBytes !== false);
    }

    public function getNotaById(int $id) {

        foreach ($this->arrayNotas as $key => $nota) {
            if ($nota->getId() === $id) {
                return $nota;
            }
        }
        return null;
    }

    public function updateNota($notaToUpdate): bool {

        $encontrado = false;

        foreach ($this->arrayNotas as $key => $nota) {
            if ($nota["id"] === $notaToUpdate["id"]) {
                $encontrado = true;
                $this->arrayNotas[$key]["titulo"] = $notaToUpdate["titulo"];
                $this->arrayNotas[$key]["contenido"] = $notaToUpdate["contenido"];
            }
        }

        if ($encontrado) {
            $this->saveNotas($this->arrayNotas);
        }
        return $encontrado;
    }

    public function deleteNota(int $id): bool {


        $clave = null;

        foreach ($this->arrayNotas as $key => $nota) {
            if ($nota["id"] === $id) {
                $clave = $key;

                break;
            }
        }
        unset($this->arrayNotas[$clave]);

        if ($clave !== null) {
            return $this->saveNotas($this->arrayNotas);
        } else
            return false;
    }

    public function create($nota) {

        $id = $this->getMaxId($this->arrayNotas);
        $nota["id"] = $id;

        array_push($this->arrayNotas, $nota);
        if ($this->saveNotas($this->arrayNotas)) {

            return $nota;
        } else {
            return null;
        }
    }

    private function getMaxId() {

        $arrayNotas = array_values($this->arrayNotas);

        $array_ids = array_map(function ($nota) {
            return $nota["id"];
        }, $arrayNotas
        );

        $max_id = max($array_ids);

        return ++$max_id;
    }

}

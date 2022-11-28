<?php

//require 'repository/NotaRepository.php';

class NotaServicio {

 
    private INotaRepository $repository;

    public function __construct() {
        $this->repository = new NotaRepository();
    }

    /* Set conection */

   

    /* Get all notes */

    public function getNotas(): array {

        return $this->repository->getNotas();
    }

    /* Get note by id */

    public function getNoteById($id) {
        if (is_null($id)) {
            return false;
        }
        return $this->repository->getNotaById($id);
    }

    /* Save note */
//Se usa para crear una nueva nota y para editar una ya existente
    public function save($httpMethod) {

        /* Set default values */
        $title = $content = "";

        /* Check if exists */
        $exists = false;
        if (isset($httpMethod["id"]) and $httpMethod["id"] != '') {
            $actualNote = $this->repository->getNotaById($httpMethod["id"]);
            if (isset($actualNote)) {
                $exists = true;          
           }
        }

        /* Received values */
        if (isset($httpMethod["title"])) {
            $title = $httpMethod["title"];
        }
        if (isset($httpMethod["content"])) {
            $content = $httpMethod["content"];
        }


        if ($exists) {
            $actualNote->setTitulo( $title);
            $actualNote->setContenido($content);
            if ($this->repository->updateNota($actualNote)) {
                $notaToVista = $actualNote;
            }
            else{
                $notaToVista = null;
            }
        } else {
            $newNote = new Nota();
            $newNote->setTitulo($title);
            $newNote->setContenido($content);

            $notaToVista = $this->repository->create($newNote);
          
        }
        
        return $notaToVista;
    }

     /* Delete note by id */

    public function deleteNoteById($id) :bool{
        return $this->repository->deleteNota($id);
    }

}

?>
<?php

class NotaController {

    public $page_title;
    public $view;
    private $noteObj;

    public function __construct() {
        $this->view = 'list_note';
        $this->page_title = '';
        $this->noteObj = new Note();
    }

    /* List all notes */

    public function list() {
        $this->page_title = 'Listado de notas';
        return $this->noteObj->getNotas();
    }

    /* Load note for edit */

    public function edit($id = null) {
        $this->page_title = 'Editar nota';
        $this->view = 'edit_note';
        /* Id can from get param or method param */
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            $nota = $this->noteObj->getNoteById($id);
        } else {
            //para creación
            $nota = ["id" => "", "titulo" => "", "contenido" => ""];
        }
        return $nota;
    }

    /* Create or update note */

    public function save() {
        $this->view = 'edit_note';
        $this->page_title = 'Editar nota';

        $notaGuardada = $this->noteObj->save($_POST);    
        //para saber si ha habido error o no
        //Solo se establece un campo "error" si se ha realizado un (save) exitoso o no
        if ($notaGuardada == null) {
            $notaGuardada["error"] = true;
        } else {
            $notaGuardada["error"] = ($notaGuardada == null);
        }

    
        return $notaGuardada;
    }

    /* Confirm to delete */

    public function confirmDelete() {
        $this->page_title = 'Eliminar nota';
        $this->view = 'confirm_delete_note';
        return $this->noteObj->getNoteById($_GET["id"]);
    }

    /* Delete */

    public function delete(): bool {
        $this->page_title = 'Listado de notas';
        $this->view = 'delete_note';
        return $this->noteObj->deleteNoteById($_POST["id"]);
    }

}

?>
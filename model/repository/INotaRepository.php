<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPInterface.php to edit this template
 */

/**
 *
 * @author mfernandez
 */
interface INotaRepository {

    public function getNotas(): array; 

    function getNotaById(int $id):Nota;

    public function updateNota(Nota $notaToUpdate): bool;

    public function deleteNota(int $id): bool;
    
    public function create(Nota $nota):Nota;
}

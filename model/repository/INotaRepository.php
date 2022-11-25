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

    public function saveNotas(array $notas): bool;

    function getNotaById(int $id);

    public function updateNota($notaToUpdate): bool;

    public function deleteNota(int $id): bool;
    
    public function create($nota);
}

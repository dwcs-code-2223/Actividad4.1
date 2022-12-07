<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of VisitasServicio
 *
 * @author mfernandez
 */
class VisitasServicio {

    private int $visitas = 0;

    public function __construct() {

        if (!isset($_COOKIE[VISITAS_COOKIE_KEY])) {
            $this->visitas = 1;
        } else {
            $this->visitas = $_COOKIE[VISITAS_COOKIE_KEY];
            $this->visitas++;
        }
        setcookie(VISITAS_COOKIE_KEY, $this->visitas, time() + 60 * 60 * 24 * 30);
    }

    public function getVisitas(): int {
        return $this->visitas;
    }

    public function reset(): void {
        $this->visitas = 1;
        setcookie(VISITAS_COOKIE_KEY, $this->visitas, time() + 60 * 60 * 24 * 30);
    }

}

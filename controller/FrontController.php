<?php

ob_start();
echo "Hola";

require_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'config/config.php';
require_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'includes/autoload.php';

//$visitas = 0;
//if (!isset($_COOKIE[VISITAS_COOKIE_KEY])) {
//    $visitas = 1;
//} else {
//    $visitas = $_COOKIE[VISITAS_COOKIE_KEY];
//    $visitas++;
//}
//setcookie(VISITAS_COOKIE_KEY, $visitas, time() + 60 * 60 * 24 * 30);
$visitasService = new VisitasServicio();

if (isset($_POST["reset"])) {
    $visitasService->reset();
}

if (!isset($_GET["controller"])) {
    $_GET["controller"] = DEFAULT_CONTROLLER;
}

if (!isset($_GET["action"])) {
    $_GET["action"] = DEFAULT_ACTION;
}

$controller_path = $_GET["controller"] . '.php';

/* Check if controller exists */
if (!file_exists($controller_path)) {
    $controller_path = DEFAULT_CONTROLLER . 'Controller.php';
}

/* Load controller */
//require_once $controller_path; //Se hace en autoload.php

$controllerName = $_GET["controller"] . 'Controller';
$controller = new $controllerName();

//Se preparan los datos para que estén disponibles en la vista
$dataToView["data"] = array();

/* Check if method is defined */
if (method_exists($controller, $_GET["action"])) {
    //Se establecen los datos que devuelve el controlador  para que estén disponibles para la vista
    $dataToView["data"] = $controller->{$_GET["action"]}();
}
//No podemos modificar la cabecera después de hacer el primer flush
//setcookie("testCookie", "test", time() + 60 * 60);
//ob_flush();


/* Load views */
require_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'view/template/header.php';
require_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'view/' . $controller->view . '.php';
require_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'view/template/footer.php';

//If output buffering is still active when the script ends, PHP outputs the contents automatically. 
//setcookie("testCookie", "test", time() + 60 * 60);
ob_end_flush();
?>
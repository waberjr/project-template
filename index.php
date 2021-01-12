<?php
ob_start();

require __DIR__."/vendor/autoload.php";

use \CoffeeCode\Router\Router;

$router = new Router(url(), ":");
$router->namespace("Source\Controller");

$router->group(null);
$router->get("/", "Web:login");
$router->post("/", "Web:login");
$router->get("/registrar", "Web:register");
$router->post("/registrar", "Web:register");
$router->get("/recuperar", "Web:forget");
$router->post("/recuperar", "Web:forget");
$router->get("/recuperar/{code}", "Web:reset");
$router->post("/recuperar/resetar", "Web:reset");

/**
 * APP
 */
$router->group("/app");

//HOME
$router->get("/", "App:home");

//LOGOUT
$router->get("/sair", "App:logout");

/**
 * ERROR ROUTES
 */
$router->group("/ops");
$router->get("/{errcode}", "Web:error");

$router->dispatch();

if($router->error()){
    $router->redirect("/ops/{$router->error()}");
}

ob_end_flush();
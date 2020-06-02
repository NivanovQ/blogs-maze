<?php
// Routes

//====================Pusher======================


use controller\blogs\BlogController;
use controller\labyrinth\LabyrinthController;

$app->get("/blogs/all",                    BlogController::class . ":getAll");
$app->post("/blogs",                    BlogController::class . ":add");
$app->get("/blogs/{id}",                    BlogController::class . ":getById");
$app->post("/test",                    LabyrinthController::class . ":generete");



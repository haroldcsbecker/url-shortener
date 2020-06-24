<?php

use Slim\App;

return function (App $app) {
    $app->get('/:id', \App\Action\HomeAction::class);
    $app->get('/users/:userId', \App\Action\UserStatsAction::class);
    $app->get('/users/:userid/stats', \App\Action\UserStatsAction::class);
    $app->post('/users', \App\Action\UserCreateAction::class);
    $app->post('/users/:userid/urls', \App\Action\UserUrlCreateAction::class);
    $app->delete('/urls/:id', \App\Action\DeleteUrlAction::class);
    $app->delete('/users/:userId', \App\Action\DeleteUserAction::class);
};

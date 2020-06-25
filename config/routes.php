<?php

use Slim\App;

return function (App $app) {
    $app->get('/stats', \App\Action\StatsAction::class);
    $app->get('/users/{userId}/stats', \App\Action\UserStatsAction::class);

    $app->get('/stats/{id}', \App\Action\SingleStatAction::class);
    $app->get('/{id}', \App\Action\UrlAction::class);
    $app->post('/users', \App\Action\UserCreateAction::class);
    $app->post('/users/{userId}/urls', \App\Action\UrlCreateAction::class);
    $app->delete('/users/{userId}', \App\Action\RemoveUserAction::class);
    $app->delete('/urls/{id}', \App\Action\RemoveUrlAction::class);
};

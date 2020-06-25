<?php

namespace App\Action;

use App\Domain\Stats\Service\StatsGetter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class StatsAction
{
    private $statsGetter;

    public function __construct(StatsGetter $statsGetter)
    {
        $this->statsGetter = $statsGetter;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        $result = $this->statsGetter->getStats($args);

        if (!$result) {
            return $response->withStatus(404);
        }

        $response->getBody()->write((string) json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}

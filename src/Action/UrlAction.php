<?php

namespace App\Action;

use App\Domain\URL\Service\UrlUpdater;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UrlAction
{
    private $urlUpdater;

    public function __construct(UrlUpdater $urlUpdater)
    {
        $this->urlUpdater = $urlUpdater;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        $urlToRedirect = $this->urlUpdater->getAndUpdateUrl($args);

        return $response
            ->withHeader('Location', $urlToRedirect)
            ->withStatus(301);
    }
}

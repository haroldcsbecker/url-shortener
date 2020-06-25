<?php

namespace App\Action;

use App\Domain\URL\Service\UrlGetter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UrlAction
{
    private $urlGetter;

    public function __construct(UrlGetter $urlGetter)
    {
        $this->urlGetter = $urlGetter;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        $urlToRedirect = $this->urlGetter->getAndUpdateUrl($args);

        return $response
            ->withHeader('Location', $urlToRedirect)
            ->withStatus(301);
    }
}

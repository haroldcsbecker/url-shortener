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
        $result = $this->urlGetter->getAndUpdateUrl($args);

        if (!$result->url) {
            return $response->withStatus(404);
        }

        return $response
            ->withHeader('Location', $result->url)
            ->withStatus(301);
    }
}

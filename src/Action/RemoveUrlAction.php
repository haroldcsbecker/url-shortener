<?php

namespace App\Action;

use App\Domain\URL\Service\UrlRemover;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class RemoveUrlAction
{
    private $userRemover;

    public function __construct(UrlRemover $userRemover)
    {
        $this->userRemover = $userRemover;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        $this->userRemover->removeUrl($args);

        return $response->withStatus(204);
    }
}

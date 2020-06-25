<?php

namespace App\Action;

use App\Domain\User\Service\UserRemover;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class RemoveUserAction
{
    private $userRemover;

    public function __construct(UserRemover $userRemover)
    {
        $this->userRemover = $userRemover;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        $this->userRemover->removeUser($args);

        return $response->withStatus(204);
    }
}

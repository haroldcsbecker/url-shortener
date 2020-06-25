<?php

namespace App\Action;

use App\Domain\URL\Service\UrlCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UrlCreateAction
{
    private $urlCreator;

    public function __construct(UrlCreator $urlCreator)
    {
        $this->urlCreator = $urlCreator;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        $data = (array) $request->getParsedBody();
        $data['userId'] = $args['userId'];
        $result = $this->urlCreator->createUrl($data);
        unset($result['userId']);
        $result['hits'] = 0;
        $response->getBody()->write((string) json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}

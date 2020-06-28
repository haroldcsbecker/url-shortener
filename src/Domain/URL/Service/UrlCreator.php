<?php

namespace App\Domain\URL\Service;

use App\Domain\URL\Repository\UrlRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class UrlCreator
{
    const DEFAULT_URL = 'http://short.com/';
    /**
     * @var UrlRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UrlRepository $repository The repository
     */
    public function __construct(UrlRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new url.
     *
     * @param array $data The form data
     *
     * @return array The data of new url
     */
    public function createUrl(array $data): array
    {
        $this->validateInput($data);
        $data['shortUrl'] = $this->createShortUrl($data);
        $data['id'] = $this->repository->insert($data);

        return $data;
    }

    /**
     * Create short url.
     *
     * @param void
     *
     * @throws ValidationException
     *
     * @return array $data
     */
    private function createShortUrl(): string
    {
        $ramdomHexChars = sprintf('%06X', mt_rand(0, 16777215));
        $shortUrl = sprintf(self::DEFAULT_URL . '%s', $ramdomHexChars);

        return $shortUrl;
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function validateInput(array $data): void
    {
        $errors = [];
        if (empty($data['url'])) {
            $errors['url'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}

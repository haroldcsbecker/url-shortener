<?php

namespace App\Domain\URL\Service;

use App\Domain\URL\Repository\UrlRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class UrlGetter
{
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
     * Remove url.
     *
     * @param array $data The form data
     *
     * @return string
     */
    public function getAndUpdateUrl(array $data): string
    {
        $this->validateInput($data);
        $result = $this->repository->getById($data);

        $data['hits'] = (int) $result->hits;
        $this->repository->update($data);

        return $result->url;
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
        if (empty($data['id'])) {
            $errors['id'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}

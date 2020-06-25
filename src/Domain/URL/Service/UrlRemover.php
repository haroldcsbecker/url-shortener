<?php

namespace App\Domain\URL\Service;

use App\Domain\URl\Repository\UrlRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class UrlRemover
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
     * @return void
     */
    public function removeUrl(array $data): void
    {
        $this->validateInput($data);
        $this->repository->delete($data);
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

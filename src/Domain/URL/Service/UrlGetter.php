<?php

namespace App\Domain\URL\Service;

use App\Domain\URL\Repository\UrlRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
class UrlGetter
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
     */
    public function getAndUpdateUrl(array $data)
    {
        $this->validateInput($data);
        $result = $this->repository->getById($data);

        if (!$result) {
            return;
        }

        $data['hits'] = (int) $result->hits;
        $this->repository->update($data);

        return $result;
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

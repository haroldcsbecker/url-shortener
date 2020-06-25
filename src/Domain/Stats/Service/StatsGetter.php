<?php

namespace App\Domain\Stats\Service;

use App\Domain\Stats\Repository\StatsRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class StatsGetter
{
    /**
     * @var StatsRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param StatsRepository $repository The repository
     */
    public function __construct(StatsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get stats of url by id.
     *
     * @param array $data The form data
     *
     * @return UrlData
     */
    public function getStatsById(array $data)
    {
        $this->validateInput($data);
        $result = $this->repository->getById($data);

        return $result;
    }

    /**
     * Get stats of url by id.
     *
     * @param array $data The form data
     *
     * @return UrlData
     */
    public function getStatsByUser(array $data)
    {
        $this->validateUserInput($data);
        $result = $this->repository->getStatsByUser($data);

        return $result;
    }

    /**
     * Get stats of urls.
     *
     * @param array $data The form data
     *
     * @return array
     */
    public function getStats(array $data): array
    {
        $result = $this->repository->get($data);

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

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function validateUserInput(array $data): void
    {
        $errors = [];
        if (empty($data['userId'])) {
            $errors['userId'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}

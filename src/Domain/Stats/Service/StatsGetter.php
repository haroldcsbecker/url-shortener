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
     * Remove url.
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
     * Remove url.
     *
     * @param array $data The form data
     *
     * @return UrlData
     */
    public function getStats(array $data)
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
}

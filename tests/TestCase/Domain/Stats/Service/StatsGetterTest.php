<?php

namespace App\Test\TestCase\Domain\Stats\Service;

use PHPUnit\Framework\TestCase;
use App\Domain\URL\Data\UrlData;
use Prophecy\PhpUnit\ProphecyTrait;
use App\Domain\Stats\Service\StatsGetter;
use App\Exception\ValidationException;
use App\Domain\Stats\Repository\StatsRepository;

class StatsGetterTest extends TestCase
{
    use ProphecyTrait;

    public function testGetStatsByIdShouldThrowExceptionToInputError()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Please check your input');

        $repository = $this->prophesize(StatsRepository::class);
        $service = new StatsGetter($repository->reveal());
        $service->getStatsById([]);
    }

    public function testGetStatsByUserShouldThrowExceptionToInputError()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Please check your input');

        $repository = $this->prophesize(StatsRepository::class);
        $service = new StatsGetter($repository->reveal());
        $service->getStatsByUser([]);
    }

    public function  testGetStatsByIdShouldBeReturnSpecificUrl()
    {
        $repository = $this->prophesize(StatsRepository::class);
        $repository->getById(\Prophecy\Argument::any())
            ->shouldBeCalled()
            ->willReturn(new UrlData());

        $service = new StatsGetter($repository->reveal());
        $result = $service->getStatsById(['id' => 1]);
    }

    public function  testGetStatsByUserShouldBeReturnUserUrls()
    {
        $return = ['hits' => 0, 'urlCount' => 0, 'topUrls' => []];
        $repository = $this->prophesize(StatsRepository::class);
        $repository->getStatsByUser(\Prophecy\Argument::any())
            ->shouldBeCalled()
            ->willReturn($return);

        $service = new StatsGetter($repository->reveal());
        $result = $service->getStatsByUser(['userId' => 1]);
    }

    public function  testGetStatsByUserShouldBeReturnAllUrls()
    {
        $return = ['hits' => 0, 'urlCount' => 0, 'topUrls' => []];
        $repository = $this->prophesize(StatsRepository::class);
        $repository->get(\Prophecy\Argument::any())
            ->shouldBeCalled()
            ->willReturn($return);

        $service = new StatsGetter($repository->reveal());
        $result = $service->getStats(['userId' => 1]);
    }
}

<?php

namespace App\Test\TestCase\Domain\URL\Service;

use PHPUnit\Framework\TestCase;
use App\Domain\URL\Data\UrlData;
use Prophecy\PhpUnit\ProphecyTrait;
use App\Domain\URL\Service\UrlGetter;
use App\Exception\ValidationException;
use App\Domain\URL\Repository\UrlRepository;

class UrlGetterTest extends TestCase
{
    use ProphecyTrait;

    public function testGetAndUpdateUrlShouldThrowExceptionToInputError()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Please check your input');

        $repository = $this->prophesize(UrlRepository::class);
        $service = new UrlGetter($repository->reveal());
        $service->getAndUpdateUrl([]);
    }

    public function testGetAndUpdateUrlShouldBeReturnData()
    {
        $urlData = new UrlData();
        $urlData->hits = 5;

        $repository = $this->prophesize(UrlRepository::class);
        $repository->getById(\Prophecy\Argument::any())
            ->shouldBeCalled()
            ->willReturn($urlData);

        $repository->update(['id' => 5, 'hits' => 5])
            ->shouldBeCalled();

        $service = new UrlGetter($repository->reveal());
        $service->getAndUpdateUrl(['id' => 5]);
    }

    public function testGetAndUpdateUrlShouldBeReturnNull()
    {
        $repository = $this->prophesize(UrlRepository::class);
        $repository->getById(\Prophecy\Argument::any())
            ->shouldBeCalled()
            ->willReturn(null);

        $repository->update(\Prophecy\Argument::any())
            ->shouldNotBeCalled();

        $service = new UrlGetter($repository->reveal());
        $result = $service->getAndUpdateUrl(['id' => 5]);
    }
}

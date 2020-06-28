<?php

namespace App\Test\TestCase\Domain\URL\Service;

use PHPUnit\Framework\TestCase;
use App\Domain\Url\Data\UrlData;
use Prophecy\PhpUnit\ProphecyTrait;
use App\Domain\Url\Service\UrlRemover;
use App\Exception\ValidationException;
use App\Domain\Url\Repository\UrlRepository;

class UrlRemoverTest extends TestCase
{
    use ProphecyTrait;

    public function testRemoveUrlShouldThrowExceptionToInputError()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Please check your input');

        $repository = $this->prophesize(UrlRepository::class);
        $service = new UrlRemover($repository->reveal());
        $service->removeUrl([]);
    }

    public function testRemoveUrlShouldBeDeleteData()
    {
        $repository = $this->prophesize(UrlRepository::class);
        $repository->delete(\Prophecy\Argument::any())
            ->shouldBeCalled();

        $service = new UrlRemover($repository->reveal());
        $service->removeUrl(['id' => 5]);
    }
}

<?php

namespace App\Test\TestCase\Domain\URL\Service;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use App\Domain\URL\Service\UrlCreator;
use App\Exception\ValidationException;
use App\Domain\URL\Repository\UrlRepository;

class UrlCreatorTest extends TestCase
{
    use ProphecyTrait;

    public function testCreateUrlShouldThrowExceptionToInputError()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Please check your input');

        $repository = $this->prophesize(UrlRepository::class);
        $service = new UrlCreator($repository->reveal());
        $service->createUrl([]);
    }

    public function testCreateUrlShouldBeCreateShortUrl()
    {
        $repository = $this->prophesize(UrlRepository::class);
        $repository->insert(\Prophecy\Argument::any())
            ->shouldBeCalled()
            ->willReturn(1);

        $service = new UrlCreator($repository->reveal());
        $result = $service->createUrl(['url' => 'http://google.com.br']);

        $this->assertSame(1, $result['id']);
        $this->assertStringContainsString(UrlCreator::DEFAULT_URL, $result['shortUrl']);
    }
}

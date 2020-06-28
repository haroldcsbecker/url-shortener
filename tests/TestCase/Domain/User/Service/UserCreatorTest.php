<?php

namespace App\Test\TestCase\Domain\User\Service;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use App\Exception\ValidationException;
use App\Domain\User\Service\UserCreator;
use App\Domain\User\Repository\UserRepository;

class UserCreatorTest extends TestCase
{
    use ProphecyTrait;

    public function testCreateUserShouldThrowExceptionToInputError()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Please check your input');

        $repository = $this->prophesize(UserRepository::class);
        $service = new UserCreator($repository->reveal());
        $service->createUser([]);
    }

    public function testCreateUserShouldBeCreateNewUser()
    {
        $repository = $this->prophesize(UserRepository::class);
        $repository->insert(\Prophecy\Argument::any())
            ->shouldBeCalled()
            ->willReturn(1);

        $service = new UserCreator($repository->reveal());
        $service->createUser(['id' => 'joao']);
    }
}

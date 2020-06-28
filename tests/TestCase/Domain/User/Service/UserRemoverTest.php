<?php

namespace App\Test\TestCase\Domain\User\Service;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use App\Exception\ValidationException;
use App\Domain\User\Service\UserRemover;
use App\Domain\User\Repository\UserRepository;

class UserRemoverTest extends TestCase
{
    use ProphecyTrait;

    public function testRemoveUserShouldThrowExceptionToInputError()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Please check your input');

        $repository = $this->prophesize(UserRepository::class);
        $service = new UserRemover($repository->reveal());
        $service->removeUser([]);
    }

    public function testRemoveUserShouldBeDeleteData()
    {
        $repository = $this->prophesize(UserRepository::class);
        $repository->delete(\Prophecy\Argument::any())
            ->shouldBeCalled();

        $service = new UserRemover($repository->reveal());
        $service->removeUser(['userId' => 66]);
    }
}

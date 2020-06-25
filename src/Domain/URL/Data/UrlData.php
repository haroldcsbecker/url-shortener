<?php

namespace App\Domain\URL\Data;

final class UrlData
{
    /**
     * @var int
     */
    public $id;

    /** @var int */
    public $hits;

    /** @var string */
    public $url;

    /** @var string */
    public $shortUrl;

    /** @var \App\Domain\User\Data\UserData */
    public $user;
}

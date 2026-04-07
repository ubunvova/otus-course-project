<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Domain\User\User;

interface UserExtractorInterface
{
    public function getUser(): User;
}

<?php

declare(strict_types=1);

namespace App\Application\Common;

interface FlusherInterface
{
    public function flush(): void;
}

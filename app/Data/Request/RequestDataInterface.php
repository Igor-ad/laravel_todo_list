<?php

declare(strict_types=1);

namespace App\Data\Request;

use Illuminate\Support\Collection;

interface RequestDataInterface
{
    public function getData(): Collection;
}

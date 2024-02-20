<?php

declare(strict_types=1);

namespace App\Data\Request;

use Illuminate\Support\Collection;

interface RequestDataInterface
{
    public static function fromArray(array $data): self;

    public function getData(): Collection;
}

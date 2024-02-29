<?php

declare(strict_types=1);

namespace App\Data\Response;

use Illuminate\Support\Collection;

interface ResponseDataInterface
{
    public static function fromCollect(array|Collection $collection): self;
    public function toCollect(): Collection;
}

<?php

namespace App\Data\Request;

use Illuminate\Support\Collection;

interface RequestDataInterface
{
    /**
     * @return Collection
     */
    public function getData(): Collection;
}

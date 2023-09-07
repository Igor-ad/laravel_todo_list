<?php

namespace App\Data\Response;

use Illuminate\Support\Collection;

interface ResponseDataInterface
{
    /**
     * @return Collection
     */
    public function getData(): Collection;
}

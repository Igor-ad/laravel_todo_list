<?php

namespace App\Http\Controllers\Api;

use Exception;

trait TaskHelper
{
    /**
     * @param Exception $e
     * @return void
     */
    protected function getCatch(Exception $e): void
    {
        $this->ans->status = 500;
        $this->ans->error = $e->getMessage();
    }
}

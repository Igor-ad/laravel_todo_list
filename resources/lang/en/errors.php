<?php

use App\Enums\TaskStatusEnum;

return [
    'status' => sprintf(
        "The selected status is invalid. '%s' and '%s' only.",
        TaskStatusEnum::DONE->value, TaskStatusEnum::TODO->value
    )
];

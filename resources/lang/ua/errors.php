<?php

use App\Enums\TaskStatusEnum;

return [
    'status' => sprintf(
        "Цей статус не їснує. Оберїть будь ласка з цього набору - '%s' and '%s'.",
        TaskStatusEnum::DONE->value, TaskStatusEnum::TODO->value
    )
];

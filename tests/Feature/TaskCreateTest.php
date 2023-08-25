<?php

namespace Tests\Feature;

use App\Enums\TaskPathEnum as Path;
use App\Enums\TaskStatusEnum;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskCreateTest extends TestCase
{
    use TaskTestHelper;

    /**
     * test_the_task_sample_created_successfully
     */
    public function test_the_task_sample_created_successfully(): void
    {
        $this->userInit();

        $response = $this->post(uri: sprintf(
            '%s?api_token=%s&parent_id=%d&status=%s&priority=%d&title=%s&description=%s',
            Path::create->value,
            $this->user->getAttribute('api_token'),
            1,
            TaskStatusEnum::TODO->value,
            rand(1, 5),
            fake()->jobTitle,
            fake()->paragraph(1)
        ));

//        $this->deleteTask($response->json(0)['data']['id']);

        $response->assertStatus(201);
    }

    /**
     * test_the_task_sample_does_not_created_with_the_wrong_field
     */
    public function test_the_task_sample_does_not_created_with_the_wrong_field(): void
    {
        $this->userInit();

        $this->post(uri: sprintf(
            '%s?api_token=%s&parent_id=%d&status=%s&priority=%d&title=%s&description=%s',
            Path::create->value,
            $this->user->getAttribute('api_token'),
            1,
            TaskStatusEnum::TODO->value,
            7, // The priority field must be at least 1 and must not be greater than 5.
            fake()->jobTitle,
            fake()->paragraph(1)
        ))->assertStatus(422);
    }
}

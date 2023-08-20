<?php

namespace Tests\Feature;

use App\Enums\TaskPathEnum as Path;
use App\Enums\TaskStatusEnum;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskCreateTest extends TestCase
{
    use TaskTestHelper;

    /**
     * test_task_sample_create_successful
     */
    public function test_task_sample_create_successful(): void
    {
        $this->userInit();

        $response = $this->post(uri: sprintf(
            '%s?api_token=%s&parent_id=%d&status=%s&priority=%d&title=%s&description=%s',
            Path::create->value,
            $this->user->api_token,
            1,
            TaskStatusEnum::TODO->value,
            rand(1, 5),
            fake()->jobTitle,
            fake()->paragraph(1)
        ));

        $this->deleteTask($response->json(0)['data']['id']);

        $response->assertStatus(201);
    }
}

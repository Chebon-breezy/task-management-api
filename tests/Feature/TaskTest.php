<?php

namespace Tests\Feature;

use App\Models\Task;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_create_task()
    {
        $taskData = [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => 'pending',
            'due_date' => date('Y-m-d', strtotime('+1 day')),
        ];

        $this->post('/api/tasks', $taskData)
            ->seeStatusCode(201)
            ->seeJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'description',
                    'status',
                    'due_date',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function test_can_list_tasks()
    {
        Task::create([
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => 'pending',
            'due_date' => date('Y-m-d', strtotime('+1 day')),
        ]);

        $this->get('/api/tasks')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'description',
                        'status',
                        'due_date',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->task = Task::create([
            'title' => 'テストタスク',
            'executed' => false,
        ]);
    }

    public function test_タスク一覧ルーティング()
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200);
    }

    public function test_タスク詳細ルーティング()
    {
        $response = $this->get("/tasks/{$this->task->id}");

        $response->assertStatus(200);
    }

    public function test_タスク詳細不正ルーティング()
    {
        $response = $this->get('/tasks/0');

        $response->assertStatus(404);
    }

    public function test_タスク更新ルーティング1()
    {
        $data = [
            'title' => 'test title',
        ];
        $this->assertDatabaseMissing('tasks', $data);

        $response = $this->put("/tasks/{$this->task->id}", $data);

        $response->assertStatus(302)
            ->assertRedirect("/tasks/{$this->task->id}");

        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_タスク更新ルーティング2()
    {
        $data = [
            'title' => 'テストタスク2',
            'executed' => true,
        ];
        $this->assertDatabaseMissing('tasks', $data);

        $response = $this->put("/tasks/{$this->task->id}", $data);

        $response->assertStatus(302)
            ->assertRedirect("/tasks/{$this->task->id}");

        $this->assertDatabaseHas('tasks', $data);
    }
}

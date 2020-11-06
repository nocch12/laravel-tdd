<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

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

    public function test_新規作成画面ルーティング()
    {
        $response = $this->get('/tasks/create');

        $response->assertStatus(200);
    }

    public function test_タイトルなしで新規作成()
    {
        $data = [];
        $response = $this->from('tasks/create')
            ->post('/tasks', $data);

        $response->assertSessionHasErrors(['title' => 'The title field is required.']);

        $response->assertStatus(302)
            ->assertRedirect('/tasks/create');
    }

    public function test_タイトル未入力で新規作成()
    {
        $data = ['title' => ''];
        $response = $this->from('tasks/create')
            ->post('/tasks', $data);

        $response->assertSessionHasErrors(['title' => 'The title field is required.']);

        $response->assertStatus(302)
            ->assertRedirect('/tasks/create');
    }

    public function test_タイトル最大文字数で新規作成()
    {
        $data = ['title' => Str::random(512)];

        $this->assertDatabaseMissing('tasks', $data);
        $response = $this->post('/tasks', $data);

        $response->assertStatus(302)
            ->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_タイトル最大文字数プラス1文字で新規作成()
    {
        $data = ['title' => Str::random(513)];
        $response = $this->from('tasks/create')
            ->post('/tasks', $data);

        $response->assertSessionHasErrors(['title' => 'The title may not be greater than 512 characters.']);

        $response->assertStatus(302)
            ->assertRedirect('/tasks/create');
    }
}

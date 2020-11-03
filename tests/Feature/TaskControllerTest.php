<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    public function test_タスク一覧ルーティング()
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200);
    }

    public function test_タスク詳細ルーティング()
    {
        $response = $this->get('/tasks/1');

        $response->assertStatus(200);
    }

    public function test_タスク詳細不正ルーティング()
    {
        $response = $this->get('/tasks/0');

        $response->assertStatus(404);
    }

    public function test_タスク更新ルーティング()
    {
        $data = [];

        $response = $this->put('/tasks/1', $data);

        $response->assertStatus(302);
    }
}

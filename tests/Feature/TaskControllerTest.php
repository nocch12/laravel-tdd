<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    /**
     * Get All Tasks Path Test
     *
     * @return void
     */
    public function test_全てのタスクを取得()
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TaskCreateTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_タスク新規作成画面のテスト()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("/tasks/create")
                    ->assertSee('New Task')
                    ->screenshot('task_create');
        });
    }

    public function test_タスク新規作成()
    {
        $data = [
            'title' => 'test title',
        ];
        $this->assertDatabaseMissing('tasks', $data);

        $response = $this->post('/tasks', $data);

        $response->assertStatus(302)
            ->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', $data);
    }
}

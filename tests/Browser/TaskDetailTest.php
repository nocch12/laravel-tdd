<?php

namespace Tests\Browser;

use App\Models\Task;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TaskDetailTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $task;

    protected function setUp(): void
    {
        parent::setUp();
        $this->task = Task::create([
            'title' => 'テストタスク',
            'executed' => false,
        ]);
    }

    public function test_タスク詳細画面のテスト()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("/tasks/{$this->task->id}")
                    ->assertInputValue('#title', 'テストタスク')
                    ->screenshot('task_detail');
        });
    }

    public function test_タスク詳細画面でフォーム送信()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("/tasks/{$this->task->id}")
                ->assertInputValue('#title', 'テストタスク')
                ->type('#title', 'test task')
                ->screenshot('task_post_typed')
                ->press('更新')
                ->pause(1000)
                ->assertPathIs("/tasks/{$this->task->id}")
                ->assertInputValue('#title', 'test task')
                ->screenshot('task_post_pressed');
        });
    }
}

<?php

namespace Tests\Browser;

use App\Models\Task;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TasksIndexTest extends DuskTestCase
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

    public function test_一覧画面()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tasks')
                ->assertSee('テストタスク')
                ->screenshot("tasks_index");
        });
    }

    public function test_一覧画面から詳細画面に遷移()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tasks')
                ->assertSeeLink('テストタスク')
                ->clickLink('テストタスク')
                ->waitForLocation("/tasks/{$this->task->id}", 1)
                ->assertPathIs("/tasks/{$this->task->id}")
                ->assertInputValue('#title', 'テストタスク');
        });
    }
}

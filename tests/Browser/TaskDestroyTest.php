<?php

namespace Tests\Browser;

use App\Models\Task;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TaskDestroyTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->task = Task::create([
            'title' => 'テストタスク',
            'executed' => 0,
        ]);
    }

    public function test_詳細画面で削除()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("/tasks/{$this->task->id}")
                ->press('削除')
                ->pause(1000)
                ->assertPathIs('/tasks');
        });
    }

}

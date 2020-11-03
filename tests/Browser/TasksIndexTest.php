<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TasksIndexTest extends DuskTestCase
{
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
                ->waitForLocation('/tasks/2', 1)
                ->assertPathIs('/tasks/2')
                ->assertSee('テストタスク');
        });
    }
}

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
            $browser->visit('/tasks/create')
                ->assertSee('New Task')
                ->screenshot('task_create');
        });
    }

    public function test_タイトル空でタスク新規作成()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tasks/create')
                ->press('登録')
                ->pause(1000)
                ->assertPathIs('/tasks/create')
                ->assertSee('The title field is required.')
                ->screenshot('task_create_empty_value');
        });
    }
}

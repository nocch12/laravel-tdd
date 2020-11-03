<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TaskDetailTest extends DuskTestCase
{
    public function test_タスク詳細画面のテスト()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tasks/2')
                    ->assertInputValue('#title', 'テストタスク')
                    ->screenshot('task_detail');
        });
    }

    public function test_タスク詳細画面でフォーム送信()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tasks/2')
                ->assertInputValue('#title', 'テストタスク')
                ->type('#title', 'test task')
                ->screenshot('task_post_typed')
                ->press('更新')
                ->pause(1000)
                ->assertPathIs('/tasks/2')
                ->screenshot('task_post_pressed');
        });
    }
}

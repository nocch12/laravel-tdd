<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TaskDetailTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_タスク詳細画面のテスト()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tasks/2')
                    ->assertSee('テストタスク')
                    ->screenshot('task_detail');
        });
    }
}

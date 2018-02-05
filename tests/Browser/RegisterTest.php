<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Register')
                    ->value('#name', 'Testare')
                    ->value('#email', 'testare1@yahoo.com')
                    ->value('#password', '123456')
                    ->value('#password-confirm', '123456')
                    ->click('button[type="submit"]')
                    ->pause(500)
                    ->assertPathIs('/')
                    ->assertSee('Bine ati venit!');
        });
    }
}

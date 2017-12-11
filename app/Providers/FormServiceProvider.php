<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('bsText', 'components.text', ['name', 'value' => null, 'attributes' => []]);
        Form::component('bsTextArea', 'components.textarea', ['name', 'value' => null, 'attributes' => []]);
        Form::component('bsSubmit', 'components.submit', ['value' => 'Submit', 'attributes' => []]);
        Form::component('hidden', 'components.hidden', ['name', 'value' => null, 'attributes' => []]);
        Form::component('bsfile', 'components.file', ['name', 'attributes' =>[]]);

   
       
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

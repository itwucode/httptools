<?php

namespace Wuhttp;

use Illuminate\Support\ServiceProvider;

class HttpToolsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // 注册
        $this->app->singleton('httptools',function (){
            return new HttpTools();
        });
    }
}

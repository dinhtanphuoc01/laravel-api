<?php

namespace Tests;
use Artisan;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected $baseUrl = 'http://laravel.dev';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        
        return $app;
    }

    public function setUp()
    {
        parent::setUp();
        @unlink(base_path('storage/database.sqlite'));
        @copy(base_path('storage/database.sqlite.blank'), base_path('storage/database.sqlite'));
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}

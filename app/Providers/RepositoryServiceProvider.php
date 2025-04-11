<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\StudentRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            StudentRepositoryInterface::class,
            StudentRepository::class
        );
    }
}
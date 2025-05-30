<?php

namespace App\Providers;

use App\Repositories\TaskRepository;
use App\Services\Task\CompleteService;
use App\Services\Task\CreateService;
use App\Services\Task\DeleteService;
use App\Services\Task\FilterService;
use App\Services\Task\IndexService;
use App\Services\Task\OrderService;
use App\Services\Task\ShowService;
use App\Services\Task\UpdateService;
use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CompleteService::class, function ($app) {
            return new CompleteService(
                $app->make(TaskRepository::class),
            );
        });

        $this->app->singleton(CreateService::class, function ($app) {
            return new CreateService(
                $app->make(TaskRepository::class),
            );
        });

        $this->app->singleton(DeleteService::class, function ($app) {
            return new DeleteService(
                $app->make(TaskRepository::class),
            );
        });

        $this->app->singleton(FilterService::class, function () {
            return new FilterService();
        });

        $this->app->singleton(IndexService::class, function ($app) {
            return new IndexService(
                $app->make(TaskRepository::class),
            );
        });

        $this->app->singleton(OrderService::class, function () {
            return new OrderService();
        });

        $this->app->singleton('showSrv', function ($app) {
            return new ShowService(
                $app->make(TaskRepository::class),
            );
        });

        $this->app->singleton(TaskRepository::class, function ($app) {
            return new TaskRepository(
                $app->make(FilterService::class),
                $app->make(OrderService::class),
            );
        });

        $this->app->singleton(UpdateService::class, function ($app) {
            return new UpdateService(
                $app->make(TaskRepository::class),
            );
        });
    }

    public function boot(): void
    {
    }
}

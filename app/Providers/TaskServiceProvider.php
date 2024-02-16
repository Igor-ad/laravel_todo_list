<?php

namespace App\Providers;

use App\Data\Request\Factories\Task\CreateDataFactory;
use App\Data\Request\Factories\Task\UpdateDataFactory;
use App\Data\Request\Factories\Task\IndexDataFactory;
use App\Repositories\TaskRepository;
use App\Services\AnswerService;
use App\Services\ResponseService;
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
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('answerSrv', fn() => new AnswerService());

        $this->app->singleton('responseSrv', fn() => new ResponseService());

        $this->app->singleton(CompleteService::class, function ($app) {
            return new CompleteService(
                $app->make(TaskRepository::class),
                $app->make(ResponseService::class),
            );
        });

        $this->app->singleton(CreateService::class, function ($app) {
            return new CreateService(
                $app->make(CreateDataFactory::class),
                $app->make(TaskRepository::class),
                $app->make(ResponseService::class),
            );
        });

        $this->app->singleton(DeleteService::class, function ($app) {
            return new DeleteService(
                $app->make(TaskRepository::class),
                $app->make(ResponseService::class),
            );
        });

        $this->app->singleton(FilterService::class, function () {
            return new FilterService();
        });

        $this->app->singleton(IndexService::class, function ($app) {
            return new IndexService(
                $app->make(IndexDataFactory::class),
                $app->make(TaskRepository::class),
                $app->make(ResponseService::class),
            );
        });

        $this->app->singleton(OrderService::class, function () {
            return new OrderService();
        });

        $this->app->singleton('showSrv', function ($app) {
            return new ShowService(
                $app->make(TaskRepository::class),
                $app->make(ResponseService::class),
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
                $app->make(UpdateDataFactory::class),
                $app->make(TaskRepository::class),
                $app->make(ResponseService::class),
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

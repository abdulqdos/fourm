<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;

class TestingServerProveder extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if(!$this->app->runningInConsole()) {
            return ;
        }

        AssertableInertia::macro('hasResource' , function (string $key,JsonResource $resource) {

            // check the prop if is existing
            $this->has($key);

            // check the data of prop if it correct with our data
            expect($this->prop($key))->toEqual($resource->response()->getData(true));

            return $this;
        });

        AssertableInertia::macro('hasPaginatedResource' , function (string $key,ResourceCollection $resource) {

            // check resource if is exsit
            $this->hasResource("{$key}.data" , $resource);

            // check the resource if it pagination
            expect(($this->prop($key))->toEqual($resource->response()->getData(true))->toHaveKeys(['data' , 'links' , 'meta']));

            return $this;
        });


        // make a new assert test
        TestResponse::macro('assertHasResource' , function (string $key,JsonResource $resource) {
            return $this->assertInertia(fn (AssertableInertia $inertia) => $inertia->hasResource($key , $resource));
        });

        // make a new assert test
        TestResponse::macro('assertHasPaginatedResource' , function (string $key , ResourceCollection $resource) {
            return $this->assertInertia(fn (AssertableInertia $inertia) => $inertia->hasPaginatedResource($key , $resource));
        });
    }
}

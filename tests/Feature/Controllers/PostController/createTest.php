<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('require authenticate' ,  function () {
    get(route('posts.create'))
        ->assertRedirect(route('login'));
});

//it('return the correct component' ,  function () {
//     actingAs(User::factory()->create())
//     ->get('posts.create')
//     ->assertComponent('Posts/Create');
//});

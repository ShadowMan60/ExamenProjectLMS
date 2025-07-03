<?php

use Tests\TestCase;

uses(TestCase::class);

it('shows the select quiz page', function () {
    $response = $this->get(route('selectquiz'));

    $response->assertStatus(200);
    $response->assertSee('Select Quiz');
});

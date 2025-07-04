<?php

pest()->extend(Tests\DuskTestCase::class)
    ->in('Browser');

use Pest\Laravel;
use function Pest\Laravel\get;

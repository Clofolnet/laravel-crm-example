<?php

namespace Tests;

use Tests\Traits\ApiSignIn;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTestCase extends TestCase
{
    use ApiSignIn,
        DatabaseTransactions;
}
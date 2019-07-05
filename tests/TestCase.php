<?php

namespace Tests;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Overrides the default actingsAs method provided by Laravel
     *
     * @param User $user
     */
    public function actingAs(Authenticatable $user = null, $driver = null)
    {
        $user = $user ?? factory(User::class)->create();

        $token = JWTAuth::fromUser($user);

        $this->withHeader('Authorization', "Bearer {$token}");

        return $this;
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    protected function setUp(): void
    {
        User::factory()->create([
            'name' => 'Test Login User',
            'email' => 'test@login.com',
            'password' => 'password'
        ]);
    }

    protected function tearDown(): void
    {
        User::where('email', '=', 'test@login.com')->delete();
    }

//  TODO: refactor test name
    public function test_login(): void
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'test@login.com',
            'password'=> 'password'
        ]);

        $response->assertStatus(200);
    }
}

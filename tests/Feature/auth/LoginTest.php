<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase; 

    public function test_user_cannot_login_with_empty_credentials()
    {
        $response = $this->post('/login', []);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email', 'password']);
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'email' => 'admin@inventaris.com',
            'password' => Hash::make('admin123')
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@inventaris.com',
            'password' => Hash::make('admin1234')
        ]);

        $response->assertStatus(302);
        $this->assertGuest(); 
    }

    public function test_user_successfully_logs_in()
    {
        $user = User::factory()->create([
            'email' => 'admin@inventaris.com',
            'password' => Hash::make('admin123')
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@inventaris.com',
            'password' => 'admin123'
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }
}
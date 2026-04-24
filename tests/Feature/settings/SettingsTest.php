<?php

namespace Tests\Feature\settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'password' => Hash::make('password123')
        ]);
    }

    public function test_user_can_view_settings_page()
    {
        $response = $this->actingAs($this->user)->get('/pengaturan');

        $response->assertStatus(200);
        $response->assertViewIs('settings.settings');
    }

    public function test_user_can_update_password_successfully()
    {
        $response = $this->actingAs($this->user)->put(route('pengaturan.password.update'), [
            'current_password' => 'password123',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('alert.config');
        $response->assertSessionHas('active_tab', 'keamanan');

        $this->assertTrue(Hash::check('newpassword123', $this->user->fresh()->password));
    }

    public function test_user_cannot_update_password_with_incorrect_current_password()
    {
        $response = $this->actingAs($this->user)->put(route('pengaturan.password.update'), [
            'current_password' => 'wrongpassword',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertSessionHasErrors('current_password');

        $this->assertTrue(Hash::check('password123', $this->user->fresh()->password));
    }

    public function test_user_can_update_app_name()
    {
        $response = $this->actingAs($this->user)->put(route('pengaturan.system.update'), [
            'app_name' => 'InvSys',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('alert.config');
        $response->assertSessionHas('active_tab', 'sistem');

        $this->assertDatabaseHas('settings', [
            'key' => 'app_name',
            'value' => 'InvSys',
        ]);
    }

    public function test_user_cannot_update_app_name_with_empty_value()
    {
        $response = $this->actingAs($this->user)->put(route('pengaturan.system.update'), [
            'app_name' => '',
        ]);

        $response->assertSessionHasErrors('app_name');

        $this->assertDatabaseMissing('settings', [
            'key' => 'app_name',
            'value' => '',
        ]);
    }
}

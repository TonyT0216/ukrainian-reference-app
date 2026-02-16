<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AccessPanelTest extends TestCase
{
    use RefreshDatabase;

    private function createUserWithRole(string $role): User
    {
        Role::findOrCreate($role);
        $user = User::factory()->create();
        $user->assignRole($role);

        return $user;
    }

    public function test_can_access_panel(): void
    {
        $user = $this->createUserWithRole('admin');
        $response = $this->actingAs($user)->get('/admin');
        $response->assertOk();
    }

    public function test_cant_access_panel(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/admin');
        $response->assertForbidden();
    }

    public function test_editor_can_access_panel(): void
    {
        $user = $this->createUserWithRole('editor');
        $response = $this->actingAs($user)->get('/admin');
        $response->assertOk();
    }

    public function test_admin_can_view_any(): void
    {
        $user = $this->createUserWithRole('admin');
        $this->actingAs($user)->get('/admin/users')->assertOk();
    }

    public function test_editor_cant_view_any(): void
    {
        $user = $this->createUserWithRole('editor');
        $this->actingAs($user)->get('/admin/users')->assertForbidden();
    }

    public function test_user_cant_view_any(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get('/admin/users')->assertForbidden();
    }
}

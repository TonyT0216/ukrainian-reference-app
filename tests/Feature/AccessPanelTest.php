<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AccessPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_access_panel(): void
    {
        Role::findOrCreate('admin');
        $user = User::factory()->create();
        $user->assignRole('admin');
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
        Role::findOrCreate('editor');
        $user = User::factory()->create();
        $user->assignRole('editor');
        $response = $this->actingAs($user)->get('/admin');
        $response->assertOk();
    }
}

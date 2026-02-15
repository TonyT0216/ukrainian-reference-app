<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
        ]);
        $admin->assignRole('admin');

        $editor = User::factory()->create([
            'name' => 'Test Editor',
            'email' => 'editor@test.com',
        ]);
        $editor->assignRole('editor');

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@test.com',
        ]);
    }
}

<?php

namespace Tests;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\Concerns\InteractsWithSession;

trait UserLogin
{
    use InteractsWithSession;

    public $user;

    public function setUser()
    {
        // Create the admin user
        $this->user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        // Simulate admin login
        $response = $this->post('login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        // Check if login was successful and the user is authenticated
        $this->assertAuthenticatedAs($this->user);
    }
}

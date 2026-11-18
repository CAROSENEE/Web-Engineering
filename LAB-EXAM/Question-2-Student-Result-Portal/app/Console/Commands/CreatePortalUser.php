<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreatePortalUser extends Command
{
    protected $signature = 'portal:user';
    protected $description = 'Create a user account for the Student Result Portal';

    public function handle(): int
    {
        $name = $this->ask('Name');
        $email = $this->ask('Email address');
        $password = $this->secret('Password (at least 8 characters)');

        if (strlen((string) $password) < 8) {
            $this->error('Password must contain at least 8 characters.');
            return self::FAILURE;
        }
        if (User::where('email', $email)->exists()) {
            $this->error('An account already exists for that email address.');
            return self::FAILURE;
        }

        User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        $this->info('Portal account created. You can now sign in.');
        return self::SUCCESS;
    }
}

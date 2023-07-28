<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Name');
        $email = $this->ask('Email');

        $passwordConfirmed = false;

        while (! $passwordConfirmed) {
            $password = $this->secret('Password');
            $passwordConfirmation = $this->secret('Confirm Password');

            if ($password === $passwordConfirmation) {
                $passwordConfirmed = true;
            } else {
                $this->error('Passwords do not match');
            }
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->info('User '.$user->name.' created successfully!');

    }
}

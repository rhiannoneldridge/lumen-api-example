<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Repositories\UserRepository;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRepo = new UserRepository(new User());

        // create our base user
        $userRepo->create([
            'name'      => 'Example User',
            'email'     => 'someone@example.com',
            'password'  => 'test123',
            'api_key'   => 'test',
        ]);

        // add 25 random users
        factory(App\Models\User::class, 25)->create();
    }
}

<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Arr;

use App\Models\User;
use App\Repositories\UserRepository;

use App\Models\Role;
use App\Repositories\RoleRepository;

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
        $user = $userRepo->create([
            'name'      => 'Example User',
            'email'     => 'someone@example.com',
            'password'  => 'test123',
            'api_key'   => 'test',
        ]);

        $roleRepo = new RoleRepository(new Role());

        $role = $roleRepo->create([
            'name'      => 'Administrator',
        ]);

        $userRepo->assignRolesToUser(Arr::wrap($role->id), $user->id);

        $roleRepo->create([
            'name'      => 'Manager',
        ]);

        $roleRepo->create([
            'name'      => 'Staff',
        ]);

        $roleRepo->create([
            'name'      => 'Customer',
        ]);

        // add 25 random users
        factory(App\Models\User::class, 25)->create();
    }
}

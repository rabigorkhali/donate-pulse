<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superUser = Role::where('name', 'superuser')->first();
        if (!isset($superUser)) {
            Role::create([
                'name' => 'superuser',
            ]);
        }

        $publicUser = Role::where('name', 'public-user')->first();
        Role::updateOrCreate(
            [
                'name' => 'public-user'
            ],
            [
                'permissions' => [
                    ['url' => '/campaign-categories', 'method' => 'get'],
                    ['url' => '/campaign-categories/create', 'method' => 'get'],
                    ['url' => '/campaign-categories', 'method' => 'post'],
                    ['url' => '/campaign-categories/*/edit', 'method' => 'get'],
                    ['url' => '/campaign-categories/*', 'method' => 'put'],
                    ['url' => '/campaign-categories/*', 'method' => 'delete'],
                    ['url' => '/campaigns', 'method' => 'get'],
                    ['url' => '/campaigns/create', 'method' => 'get'],
                    ['url' => '/campaigns', 'method' => 'post'],
                    ['url' => '/campaigns/*/edit', 'method' => 'get'],
                    ['url' => '/campaigns/*', 'method' => 'put'],
                    ['url' => '/campaigns/*', 'method' => 'delete'],
                    ['url' => '/donations', 'method' => 'get'],
                    ['url' => '/withdrawals', 'method' => 'get'],
                    ['url' => '/withdrawals/create', 'method' => 'get'],
                    ['url' => '/withdrawals', 'method' => 'post'],
                    ['url' => '/withdrawals/*/edit', 'method' => 'get'],
                    ['url' => '/withdrawals/*', 'method' => 'put'],
                    ['url' => '/withdrawals/*', 'method' => 'delete'],
                    ['url' => '/payment-gateways', 'method' => 'get'],
                    ['url' => '/payment-gateways/create', 'method' => 'get'],
                    ['url' => '/payment-gateways', 'method' => 'post'],
                    ['url' => '/payment-gateways/*', 'method' => 'delete']
                ]
            ]
        );

    }
}

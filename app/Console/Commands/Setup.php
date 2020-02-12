<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \Bouncer;
use \App\Models\User;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup app';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Bouncer::role()->firstOrCreate(['name' => 'admin', 'title' => 'Administrator']);
        Bouncer::role()->firstOrCreate(['name' => 'client', 'title' => 'Client']);

        Bouncer::ability()->firstOrCreate(['name' => 'users.create',  'title' => 'Редактирование пользователей' ]);
        Bouncer::ability()->firstOrCreate(['name' => 'users.view',    'title' => 'Просмотр пользователей']);

        Bouncer::ability()->firstOrCreate(['name' => 'roles.create',  'title' => 'Редактирование ролей' ]);
        Bouncer::ability()->firstOrCreate(['name' => 'roles.view',    'title' => 'Просмотр ролей']);

        Bouncer::allow('admin')->everything();

        $admin = User::find(1);
        if(!$admin) {
            $admin = new User();
            $admin->id = 1;
        }
        $admin->email = 'admin@test.com';
        $admin->first_name = 'John';
        $admin->last_name = 'Dow';
        $admin->password = bcrypt('admin');
        $admin->email_verified_at = date('Y-m-d H:i:s');
        $admin->api_token = md5($admin->email . $admin->password . time());

        $admin->save();
        Bouncer::sync($admin)->roles(['admin']);

        $client = User::find(2);
        if(!$client) {
            $client = new User();
            $client->id = 2;
        }
        $client->email = 'client@test.com';
        $client->first_name = 'Evan';
        $client->last_name = 'Dow';
        $client->password = bcrypt('admin');
        $client->email_verified_at = date('Y-m-d H:i:s');
        $client->api_token = md5($client->email . $client->password . time());

        $client->save();

        Bouncer::sync($client)->roles(['client']);
    }
}

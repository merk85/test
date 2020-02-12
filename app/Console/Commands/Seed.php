<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \Bouncer;
use \App\Models\User;

class Seed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed';

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
    		$counter = 0;
        for($i = 1; $i < 100000; $i++) {
        		$client = new User();

		        $client->email = md5(time() . rand(1, 10000)) . $i . '@test.com';
		        $client->first_name = substr(md5(time() . rand(1, 10000)) . $i, 1, 5);
		        $client->last_name = substr(md5(time() . rand(1, 10000)) . $i, 5, 10);;
		        $client->password = bcrypt('admin');
		        $client->email_verified_at = date('Y-m-d H:i:s');
		        $client->api_token = md5($client->email . $client->password . time());

		        $client->save();

		        Bouncer::sync($client)->roles(['client']);

		        $counter++;
		        if($counter >= 50) {
		        		$this->info('Добавлено ' . $counter);
		        		$counter = 0;
		        }
        }
    }
}

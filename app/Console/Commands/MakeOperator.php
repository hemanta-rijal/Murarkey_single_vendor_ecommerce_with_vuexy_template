<?php

namespace App\Console\Commands;

use App\Models\AdminUser;
use App\Models\Operator;
use Illuminate\Console\Command;

class MakeOperator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make-operator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command creates operator account';

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
        $data['name'] = $this->ask('Enter name:');
        $data['email'] = $this->ask('Enter email:');
        $password = $this->secret('Enter password:');
        $rePassword = $this->secret('Enter re-enter password:');
        if ($password == $rePassword) {
            $data['password'] = bcrypt($password);
            Operator::create($data);

            $this->info('Operator created!!' . PHP_EOL . 'Have a good day!!');
        } else {
            $this->info('Password mismatch, Please Try again');
        }


    }
}

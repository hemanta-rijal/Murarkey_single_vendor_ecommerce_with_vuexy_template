<?php

namespace App\Console;

use App\Console\Commands\ApplyDiscountCommand;
use App\Console\Commands\CancelOrderItem;
use App\Console\Commands\ConfirmOrderItem;
use App\Console\Commands\DeleteAwb;
use App\Console\Commands\FixCategoryCount;
use App\Console\Commands\FixLocationProductCount;
use App\Console\Commands\MakeOperator;
use App\Console\Commands\MakeWebAdmin;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        FixCategoryCount::class,
        FixLocationProductCount::class,
        MakeWebAdmin::class,
        MakeOperator::class,
        DeleteAwb::class,
        CancelOrderItem::class,
        ConfirmOrderItem::class,
        ApplyDiscountCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('delete:awb')
            ->daily();

        $schedule->command('cancel:order-item')->dailyAt('2:00');

        $schedule->command('confirmed:order-item')->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

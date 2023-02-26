<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\TodoReminder;
use App\Models\Task;
use Carbon\Carbon;
use Mail;

class AutoTodoDueReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:todoreminer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now()->toDateString();
        $nextDay = Carbon::now()->addDays(1)->toDateString();

        $tasks = Task::with('userDetails')
                ->whereBetween('due_date', [$today, $nextDay])
                ->where('status', '!=', 3)
                ->get();

        if ($tasks->count() > 0) {
            foreach ($tasks as $task) {
                Mail::to($task['userDetails'])->send(new TodoReminder($task['userDetails'],$task));
            }
        }
        return 0;
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Tasks;
use App\Mail\TaskReminderMail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schedule::call(function(){

            // Send email to users who have tasks due in 3 days
            $tasksDueSoon = Tasks::where('due_date','<=',Carbon::now()->addDays(3))
                                    ->where('due_date','>',Carbon::now())
                                    ->where('isCompleted',false)
                                    ->get();

            //Send email to users who have tasks is Overdue
            $tasksOverdue = Tasks::where('due_date','<',Carbon::now())
                                    ->where('isCompleted',false)
                                    ->get();

            foreach ($tasksDueSoon as $task){
                $messageContent = "Your task \"{$task->title}\" is due on  {$task->due_date}.
                Please complete it soon!";
                Mail::to('tanshiyang0621@gmail.com')
                ->send(new TaskReminderMail($task,$messageContent));
            }

            foreach ($tasksOverdue as $task) {
                $messageContent = "Your task \"{$task->title}\" was due on {$task->due_date}.
                Please complete it soon!"; // 使用双引号
                Mail::to('tanshiyang0621@gmail.com')
                    ->send(new TaskReminderMail($task, $messageContent));
            }

        })->everyMinute();
    }
}

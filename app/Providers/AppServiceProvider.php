<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schedule;
use Carbon\Carbon;
use App\Models\Tasks;
use Illumnate\Support\Facades\Mail;
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
        Schedule::call(function () {
            $tasksDueSoon = Tasks::where('due_date', '<=', Carbon::now()->addDays(2))
                ->where('due_date', '>', Carbon::now())
                ->where('isCompleted', false)
                ->get();

            $tasksOverdue = Tasks::where('due_date', '<', Carbon::now())
                ->where('isCompleted', false)
                ->get();

            foreach ($tasksDueSoon as $task) {
                $messageContent = 'Your Task "{$task->title}" is due on "{$task->due_date}".
                Please complete it as soon as possible.';
                Mail::to('yizhangyoong25@gmail.com')
                ->send(new TaskReminderMail($task,$messageContent));
            }

            foreach ($taskOverdue as $task) {
                $messageContent = 'Your Task "{$task->title}" is due on "{$task->due_date}".
                Please complete it as soon as possible.';
                Mail::to('yizhangyoong25@gmail.com')
                ->send(new TaskReminderMail($task,$messageContent));
            }


   })->everyMinute();

}
}

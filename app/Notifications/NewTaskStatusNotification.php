<?php

namespace App\Notifications;

use App\Proyecto;
use App\Tarea;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewTaskStatusNotification extends Notification {
    use Queueable;

    public $task;
    public $project;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Tarea $task) {
        $this->task    = $task;
        $this->project = Proyecto::find($task->id_proyecto)->get();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            'updatedBy' => auth()->user()->nombres,
            'idProject' => $this->project[0]->id,
            'project'   => $this->project[0]->nombre,
            'taskName'  => $this->task->nombre,
        ];
    }

/*    public function toBroadcast($notifiable) {
return new BroadcastMessage([
'updatedBy' => auth()->user()->nombres,
'project'   => $this->project[0]->nombre,
'taskName'  => $this->task->nombre, ,
]);
}*/
}

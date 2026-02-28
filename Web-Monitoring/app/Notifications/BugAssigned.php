<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BugAssigned extends Notification
{
    use Queueable;
    public $issue;

    public function __construct($issue) { $this->issue = $issue; }

    public function via($notifiable) { return ['database']; }

    public function toArray($notifiable)
    {
        return [
            'issue_id' => $this->issue->issue_id,
            'message' => 'Kamu ditugaskan untuk memperbaiki: ' . $this->issue->title,
            'url' => route('issues.show', $this->issue->issue_id),
        ];
    }
}
<?php

namespace App\Traits;

use App\Models\Notification;
use App\Models\NotificationOnForum;

trait Notifiable
{
    public function createNotification($emailUser, $type, $title, $message, $link = null, $isRead = false, $forumId = null, $forumResponseId = null, $sumOfReport = 0)
    {
        $notification = Notification::create([
            'email_user' => $emailUser,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'link' => $link,
            'is_read' => $isRead,
        ]);

        // Optionally create an entry in the notification_on_forum table
        if ($forumId || $forumResponseId) {
            NotificationOnForum::create([
                'notification_id' => $notification->notification_id,
                'forum_id' => $forumId,
                'forum_response_id' => $forumResponseId,
                'sum_of_report' => $sumOfReport,
            ]);
        }

        return $notification;
    }
}

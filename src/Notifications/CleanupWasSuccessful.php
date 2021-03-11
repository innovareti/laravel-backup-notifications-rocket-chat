<?php

namespace LaravelAux\Notifications;

use Spatie\Backup\Notifications\Notifications\CleanupWasSuccessful as BaseNotification;
use NotificationChannels\RocketChat\RocketChatMessage;

class CleanupWasSuccessful extends BaseNotification
{
    public function toRocketChat($notifiable): RocketChatMessage
    {
        $backupAttachments = $this->backupDestinationProperties()->toArray();

        $fields = [];

        foreach ($backupAttachments as $key => $value) {
            array_push(
                $fields,
                [
                    'title' => $key,
                    'value' => $value
                ]
            );
        }

        $attachments = [
            'color' => '#00CC00',
            'fields' => $fields,
        ];

        return RocketChatMessage::create(trans('backup::notifications.cleanup_successful_subject_title'))
            ->alias('MoisesBot')
            ->emoji(':moises:')
            ->attachment($attachments);
    }
}

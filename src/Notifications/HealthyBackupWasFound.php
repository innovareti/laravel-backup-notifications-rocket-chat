<?php

namespace LaravelAux\Notifications;

use Spatie\Backup\Notifications\Notifications\HealthyBackupWasFound as BaseNotification;
use NotificationChannels\RocketChat\RocketChatMessage;

class HealthyBackupWasFound extends BaseNotification
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

        return RocketChatMessage::create(trans('backup::notifications.healthy_backup_found_subject_title', ['application_name' => $this->applicationName()]))
            ->alias('MoisesBot')
            ->emoji(':moises:')
            ->attachment($attachments);
    }
}

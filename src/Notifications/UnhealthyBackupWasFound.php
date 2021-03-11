<?php

namespace LaravelAux\Notifications;

use Spatie\Backup\Notifications\Notifications\UnhealthyBackupWasFound as BaseNotification;
use NotificationChannels\RocketChat\RocketChatMessage;

class UnhealthyBackupWasFound extends BaseNotification
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
            'color' => '#CC0000',
            'fields' => $fields,
        ];

        return RocketChatMessage::create(trans('backup::notifications.unhealthy_backup_found_subject_title', ['application_name' => $this->applicationName(), 'problem' => $this->problemDescription()]))
            ->alias('MoisesBot')
            ->emoji(':moises:')
            ->attachment($attachments);
    }
}

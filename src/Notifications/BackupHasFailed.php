<?php

namespace LaravelAux\Notifications;

use Spatie\Backup\Notifications\Notifications\BackupHasFailed as BaseNotification;
use NotificationChannels\RocketChat\RocketChatMessage;

class BackupHasFailed extends BaseNotification
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

        array_push(
            $fields,
            [
                'title' => trans('backup::notifications.exception_message_title'),
                'value' => $this->event->exception->getMessage()
            ]
        );

        array_push(
            $fields,
            [
                'title' => trans('backup::notifications.exception_message_trace'),
                'value' => $this->event->exception->getTraceAsString()
            ]
        );

        $attachments = [
            'color' => '#CC0000',
            'fields' => $fields,
        ];

        return RocketChatMessage::create(trans('backup::notifications.backup_failed_subject', ['application_name' => $this->applicationName()]))
            ->alias('MoisesBot')
            ->emoji(':moises:')
            ->attachment($attachments);
    }
}

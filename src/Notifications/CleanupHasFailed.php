<?php

namespace LaravelAux\Notifications;

use Spatie\Backup\Notifications\Notifications\CleanupHasFailed as BaseNotification;
use NotificationChannels\RocketChat\RocketChatMessage;

class CleanupHasFailed extends BaseNotification
{
    public function toRocketChat($notifiable): RocketChatMessage
    {

        $fields = [
            [
                'title' => trans('backup::notifications.exception_message_title'),
                'value' => $this->event->exception->getMessage()
            ],
            [
                'title' => trans('backup::notifications.exception_message_trace'),
                'value' => $this->event->exception->getTraceAsString()
            ],
        ];

        $backupAttachments = $this->backupDestinationProperties()->toArray();

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

        return RocketChatMessage::create(trans('backup::notifications.cleanup_failed_subject', ['application_name' => $this->applicationName()]))
            ->alias('MoisesBot')
            ->emoji(':moises:')
            ->attachment($attachments);
    }
}

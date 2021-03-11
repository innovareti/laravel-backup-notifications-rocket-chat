# laravel-backup-notifications-rocket-chat

## Usage

```shell script
$ composer require innovareti/laravel-backup-notifications-rocket-chat
```

Add this to your ```config/backup.php``` config file:

```json
    'notifications' => [

        'notifications' => [
            \NotificationsRocketChat\Notifications\BackupHasFailed::class                                 => [RocketChatWebhookChannel::class, ... (other providers)],
            \NotificationsRocketChat\Notifications\UnhealthyBackupWasFound::class                         => [RocketChatWebhookChannel::class, ... (other providers)],
            \NotificationsRocketChat\Notifications\CleanupHasFailed::class                                => [RocketChatWebhookChannel::class, ... (other providers)],
            \NotificationsRocketChat\Notifications\BackupWasSuccessful::class                             => [RocketChatWebhookChannel::class, ... (other providers)],
            \NotificationsRocketChat\Notifications\HealthyBackupWasFound::class                           => [RocketChatWebhookChannel::class, ... (other providers)],
            \NotificationsRocketChat\Notifications\CleanupWasSuccessful::class                            => [RocketChatWebhookChannel::class, ... (other providers)],
        ],
        ...
```

<?php

namespace Modules\PushNotification\Services;

use Modules\PushNotification\Services\FirebaseAndroidNotificationService;
use Modules\PushNotification\Services\FirebaseIosNotificationService;
use Modules\PushNotification\Entities\PushNotification; // Import the PushNotification entity
use Modules\PushNotification\Entities\DeviceToken; // Import the DeviceToken entity
use Modules\PushNotification\Entities\Notifiable;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use function PHPUnit\Framework\isEmpty;

/**
 * Firebase Notification Service Class
 *
 * @category Service
 * @package  FirebaseNotificationService
 */
class FirebaseNotificationService
{

    private function sendAndroidNotification($deviceToken, $title, $body)
    {
        $firebaseAndroidService = new FirebaseAndroidNotificationService();
        $result = $firebaseAndroidService->sendNotification($deviceToken, $title, $body);
        return $result;
    }

    private function sendIosNotification($deviceToken, $title, $body)
    {
        $firebaseIosService = new FirebaseIosNotificationService();
        $result = $firebaseIosService->sendNotification($deviceToken, $title, $body);
        return $result;
    }

    private function sendNotificationByNotifiableId($notifiableId)
    {
        // Retrieve the notifiable records where notifiable_type is equal to the provided type
        // $notifiable = Notifiable::where('notifiable_id', $notifiableId)->get();
        $notifiable = Notifiable::where('push_notification_id', $notifiableId)->get();

        if ($notifiable->isEmpty()) {
            return ['success' => false, 'error' => 'Notifiable records not found', 'code' => 404];
        }

        $response = [];

        foreach ($notifiable as $record) {
            $userIds = [];

            if ($record->notifiable_type === 'App\Models\User') {
                $user_data = User::where('id', $record->notifiable_id)->first();
                $userIds[] = $user_data->id;
            } elseif ($record->notifiable_type === 'Modules\User\Entities\Role') {
                $roleUsers = DB::table('role_user')
                    ->where('role_id', $record->notifiable_id)
                    ->get();

                if (!$roleUsers->isEmpty()) {
                    $userIds = $roleUsers->pluck('user_id')->toArray();
                }
            }

            $notification_responses = $this->sendNotificationsToUsers($this->getDevicetokensForNotification($userIds), $record->pushNotification);

            $response[] = [
                'notifiable_id' => $record->notifiable_id,
                'user_ids' => $userIds,
                'push_notification_title' => $record->pushNotification->title,
                'push_notification_content' => $record->pushNotification->contents,
                'users_device_token_data' => $this->getDevicetokensForNotification($userIds),
                'notification_responses' => $notification_responses
            ];
        }

        return ['success' => true, 'data' => $response, 'code' => 200];
    }

    private function getDevicetokensForNotification(array $userIds)
    {
        // Get all device tokens where user_id exists in the array of user IDs and push_yn is true
        $deviceTokens = DeviceToken::whereIn('user_id', $userIds)
            ->where('push_yn', true)
            ->get();

        // Extract the user IDs from the retrieved device tokens
        $usersForNotification = $deviceTokens->pluck('device_token')->toArray();

        return $usersForNotification;
    }

    private function sendNotificationsToUsers($deviceTokens, $pushNotification)
    {
        $notificationLogs = [];

        foreach ($deviceTokens as $deviceToken) {
            $response = $this->sendAndroidNotification($deviceToken, $pushNotification->title, $pushNotification->contents);

            // Log the response for each device token
            $notificationLogs[] = [
                'device_token' => $deviceToken,
                'response' => $response
            ];
        }

        return $notificationLogs;
    }

    public function notificationTrigger(int $id)
    {
        // Call sendNotificationByNotifiableId method based on the provided ID
        return $this->sendNotificationByNotifiableId($id);
    }
}

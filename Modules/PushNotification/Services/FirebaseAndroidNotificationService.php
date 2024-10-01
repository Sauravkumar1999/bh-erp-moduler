<?php

namespace Modules\PushNotification\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

/**
 * Firebase Notification Service Class
 *
 * @category Service
 * @package  FirebaseNotificationService
 */
class FirebaseAndroidNotificationService
{
    private $messaging;

    /**
     * Constructor for the class.
     *
     * @return void
     */
    public function __construct()
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__ . '/../firebase-admin-credentials.json')
            ->createMessaging();

        $this->messaging = $firebase;
    }

    /**
     * Send a push notification to an Android device
     *
     * @param string $toDeviceToken The device token of the recipient
     * @param string $title The title of the notification
     * @param string $body The body text of the notification
     *
     * @return mixed
     */
    public function sendNotification($toDeviceToken, $title, $body)
    {
        $message = CloudMessage::withTarget('token', $toDeviceToken)
            ->withNotification(Notification::create($title, $body))
            ->withData(['key' => 'value']);

        try {
            $result = $this->messaging->send($message);
            return $result;
        } catch (\Kreait\Firebase\Exception\MessagingException $e) {
            return 'Messaging exception: ' . $e->getMessage();
        } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
            return 'Firebase exception: ' . $e->getMessage();
        }
    }
}

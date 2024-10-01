<?php

namespace Modules\PushNotification\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

/**
 * Firebase iOS Notification Service Class
 *
 * @category Service
 * @package  FirebaseIosNotificationService
 */
class FirebaseIosNotificationService
{
    private $messaging;

    /**
     * Constructor for the class.
     *
     * Initializes Firebase messaging service.
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
     * Send a push notification to an iOS device
     *
     * @param string $toDeviceToken The device token of the recipient
     * @param string $title The title of the notification
     * @param string $body The body text of the notification
     * @param array $options Additional APNS options
     *
     * @return mixed
     */
    public function sendNotification($toDeviceToken, $title, $body, array $options = [])
    {
        $notification = Notification::create($title, $body);
        $apnsConfig = ApnsConfig::fromArray($options);

        $message = CloudMessage::withTarget('token', $toDeviceToken)
            ->withNotification($notification)
            ->withApnsConfig($apnsConfig);

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

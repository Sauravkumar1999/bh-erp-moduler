<?php

namespace Modules\Core\Services;

use Aws\Credentials\CredentialProvider;
use Aws\Ses\SesClient;

/**
 * Email Service Class
 *
 * @category Service
 * @package  EmailService
 * @author   Author <r.samar@mufin.co.kr>
 */

class EmailService
{
    private $_SesClient;

    /**
     * Constructor for the class.
     *
     * @return void
     */
    public function __construct()
    {
        $provider = CredentialProvider::defaultProvider();
        $memoizedProvider = CredentialProvider::memoize($provider);

        $this->_SesClient = new SesClient([
            'region' => env('AWS_DEFAULT_REGION', 'ap-northeast-1'),
            'version' => 'latest', //latest
            'credentials' => $memoizedProvider
        ]);
    }

    /**
     * Send an email message
     *
     * @param string $to The recipient's email address
     * @param string $subject The subject of the email
     * @param string $body The body of the email
     *
     * @return \Aws\Result
     */
    public function send($to, $subject, $body, $from = null)
    {
        if (!$from) {
            $from = env('MAIL_FROM_ADDRESS', 'info@businesshub.co.kr');
        }
        return $this->_SesClient->sendEmail([
            'Destination'      => [
                'ToAddresses' => [$to],
            ],
            'ReplyToAddresses' => [$from],
            'Source'           => $from,
            'Message'          => [
                'Body'    => [
                    'Html' => [
                        'Charset' => 'UTF-8',
                        'Data'    => $body,
                    ]
                ],
                'Subject' => [
                    'Charset' => 'UTF-8',
                    'Data'    => $subject,
                ],
            ]
        ]);
    }
}

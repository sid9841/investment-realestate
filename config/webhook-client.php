<?php

return [
    'configs' => [
        [
            'name' => 'facebook-lead',
            'signing_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'signature_header_name' => 'X-Hub-Signature',
            'signature_validator' => \Marshmallow\LaravelFacebookWebhook\SignatureValidator\FacebookSignatureValidator::class,
            'process_webhook_job' => \Marshmallow\LaravelFacebookWebhook\Jobs\ProcessFacebookLeadWebhookJob::class,

        ],
    ],

    /*
     * The integer amount of days after which models should be deleted.
     *
     * 7 deletes all records after 1 week. Set to null if no models should be deleted.
     */
    'delete_after_days' => 30,
];

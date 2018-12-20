<?php

return [
    /*
     * Default facebook ad account
     */
    'default' => 'default',

    /*
     * Developer mode must be on in order to obtain new user access tokens
     *
     * default: false
     */
    'developer_mode' => false,

    /*
     * Facebook accounts
     */
    'accounts' => [
        'default' => [
            'appId' => '514487839054408',
            'appSecret' => 'aa341c3129ab9657c25750c7083ed0e7',

            /*
             * Your domain, ex. http://demo.com/ with trailing slash
             */
            'redirectUri' => '',

            /*
             * Your app- or user access token
             */
            'token' => '',
        ],
    ],
];

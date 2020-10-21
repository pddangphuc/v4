<?php

declare(strict_types=1);

return [
    'plugin' => [
        'name' => 'Tweestapsverificatie',
        'description' => 'Voegt extra beveiliging toe aan October CMS backend.',
    ],
    '2fa' => [
        'invalid_authentication_code' => 'Ongeldige authenticatiecode opgegeven, probeer het opnieuw.',
        'enable_2fa' => 'Tweestapsverificatie inschakelen',
        'disable_2fa' => 'Tweestapsverificatie uitschakelen',
        'disable_2fa_confirm' => 'Weet je zeker dat je tweestapsverificatie wilt uitschakelen voor deze gebruiker?',
        'disable_2fa_not_allowed' => 'Je mag niet tweestapsverificatie uitschakelen voor deze gebruiker.',
        'disable_2fa_success' => 'Tweestapsverificatie is uitgeschakeld voor deze gebruiker.',
        'account_enabled' => 'Tweestapsverificatie is ingeschakeld voor je account.',
        'account_disabled' => 'Tweestapsverificatie is niet ingeschakeld voor je account.',
        'verify_authentication_code' => 'Verifieer',
        'authentication_code' => 'Authenticatiecode',
        'enter_code' => 'Voer authenticatie code in',
    ],
    'users' => [
        'scan_qr_code' => 'Scan de QR-code of gebruik de geheime sleutel voor je authenticator-app.',
        'supported_applications' => 'Ondersteunde applicaties:',
        'secret_key_qr' => 'Geheime sleutel (QR-code)',
        'secret_key_text' => 'Geheime sleutel',
        'authentication_code_comment' => 'Authenticatiecode',
        'enable_two_factor_authentication' => 'Inschakelen',
        'disable_two_factor_authentication' => 'Uitschakelen',
        'two_factor_authentication' => 'Tweestapsverificatie',
    ],
];

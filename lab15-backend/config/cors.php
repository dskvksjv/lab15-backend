<?php
return [
    'paths' => ['api/*', 'book', 'csrf-token'], // Додайте ваші маршрути
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:4200'], // Додайте фронтенд
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];

<?php

return [
    'hosts' => explode(',', env('ES_HOST', 'localhost')),
    'retries' => 2,
];
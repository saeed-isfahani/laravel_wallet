<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Payment Language Lines
    |--------------------------------------------------------------------------
    |
    |
    */

    'enumes' => [],
    'messages' => [
        'create_successfull' => 'payment created successfully',
        'approve_successfull' => 'payment approved successfully',
        'reject_successfull' => 'payment rejected successfully',
        'found_successfull' => 'payment founded successfully'
    ],
    'validations' => [],
    'errors' => [
        'not_found' => 'payment not found',
        'not_pending' => 'payment is not in pending status',
        'payment_creation_time_limit' => 'a payment in :currency created less than :minute minutes ago for this user, try again later please'
    ],

];
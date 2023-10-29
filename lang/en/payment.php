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
        'delete_successfull' => 'payment deleted successfully',
        'approve_successfull' => 'payment approved successfully',
        'reject_successfull' => 'payment rejected successfully',
        'found_successfull' => 'payment founded successfully'
    ],
    'validations' => [],
    'errors' => [
        'not_found' => 'payment not found',
        'not_pending' => 'payment is not in pending status',
        'payment_creation_time_limit' => 'a payment in :currency created less than :minute minutes ago for this user, try again later please',
        'currency_key_not_found_or_deactive' => 'sended urrency key not found or deactive',
        'payment_cant_delete' => 'payent can not delete'
    ],

];
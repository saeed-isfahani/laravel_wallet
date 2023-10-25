<?php
namespace App\Enums\Payments;
use App\Enums\BaseEnum;

enum PaymentStatus: string
{
    use BaseEnum;
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}

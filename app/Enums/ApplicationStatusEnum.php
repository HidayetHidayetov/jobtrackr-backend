<?php

namespace App\Enums;

enum ApplicationStatusEnum: string
{
    case WAITING     = 'waiting';
    case ACCEPTED    = 'accepted';
    case REJECTED    = 'rejected';
    case NO_RESPONSE = 'no_response';
    case CANCELED    = 'canceled';
} 
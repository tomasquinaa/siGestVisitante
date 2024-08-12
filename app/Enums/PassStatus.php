<?php 

namespace App\Enums;

enum PassStatus: string
{
    case RECEIVED = 'recebido';
    case NOT_RECEIVED = 'não recebido';
}
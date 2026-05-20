<?php

namespace App\Enum;

enum DocumentType: string
{
    case MEDICAL_CERTIFICATE = 'medical_certificate';
    case ID_CARD = 'id_card';
}
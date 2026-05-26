<?php

namespace App\Enum;

enum ContactFormType: string
{
    case CONTACT = 'contact';
    case CONSULTATION = 'consultation';
    case SUPPORT = 'support';
}

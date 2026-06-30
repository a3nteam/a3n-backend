<?php

namespace App\Enum;

enum BlogStatus: string
{
    case PUBLISHED = 'published';
    case DRAFT = 'draft';
    case SCHEDULED = 'scheduled';
}


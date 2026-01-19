<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UserType: string implements HasColor, HasLabel
{
    case ADMIN = 'admin';
    case EDITOR = 'editor';
    case VISITOR = 'visitor';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::EDITOR => 'Editor',
            self::VISITOR => 'Visitor',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::ADMIN => 'blue',
            self::EDITOR => 'yellow',
            self::VISITOR => 'purple'
        };
    }
}

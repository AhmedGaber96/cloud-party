<?php

namespace App;

enum HcpDeclarationEnum: string
{
    case HCP = 'HCP';
    case NonHCP = 'Non-HCP';
    case Industry = 'Industry';

    public static function options(): array
    {
        return [
            self::HCP->value => 'HCP',
            self::NonHCP->value => 'Non-HCP',
            self::Industry->value => 'Industry',
        ];
    }
}
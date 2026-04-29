<?php

namespace App;

enum PrescriberEnum: string
{
    case Prescriber = 'P';
    case NonPrescriber = 'NP';

    public static function options(): array
    {
        return [
            self::Prescriber->value => 'Prescriber (P)',
            self::NonPrescriber->value => 'Non-Prescriber (NP)',
        ];
    }
}
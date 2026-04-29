<?php

namespace App;

enum WorkplaceEnum: string
{
    case Government = 'Government / Ministry of Health';
    case Hospital = 'Hospital/ University Hospital';
    case Industry = 'Industry';
    case PrivatePractice = 'Private Practice';
    case ResearchInstitute = 'Research Institute';
    case University = 'University (Academics)';
    case Other = 'Other';

    public static function options(): array
    {
        return [
            self::Government->value => self::Government->value,
            self::Hospital->value => self::Hospital->value,
            self::Industry->value => self::Industry->value,
            self::PrivatePractice->value => self::PrivatePractice->value,
            self::ResearchInstitute->value => self::ResearchInstitute->value,
            self::University->value => self::University->value,
            self::Other->value => self::Other->value,
        ];
    }
}
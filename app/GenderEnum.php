<?php

namespace App;

enum GenderEnum: string
{
    case Male = 'male';
    case Female = 'female';
    case Other = 'other';

    public static function options(): array
    {
        return [
            self::Male->value => 'Male',
            self::Female->value => 'Female',
            self::Other->value => 'Other',
        ];
    }
}
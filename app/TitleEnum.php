<?php

namespace App;

enum TitleEnum: string
{
    case Dr = 'Dr';
    case Prof = 'Prof';
    case Mr = 'Mr';
    case Mrs = 'Mrs';
    case Ms = 'Ms';

    public static function options(): array
    {
        return [
            self::Dr->value => 'Dr.',
            self::Prof->value => 'Prof.',
            self::Mr->value => 'Mr.',
            self::Mrs->value => 'Mrs.',
            self::Ms->value => 'Ms.',
        ];
    }
}

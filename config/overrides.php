<?php

return [
    'tables' => [
        'Torre' => App\Tables\Torre::class,
        'TorreAdmin' => App\Tables\TorreAdmin::class,
    ],
    'forms' => [
    ],
    'models' => [
        'Plan' => App\Models\Plan::class,
        'PlanLine' => App\Models\PlanLine::class,
        'Unit' => App\Models\Unit::class,
        'User' => App\Models\User::class,
    ],
    'datas' => [
        'UnitData' => App\Data\UnitData::class,
    ],
    'controllers' => [
    ],
    'views' => [
        'calculos-plan' => 'calculos-plan',
        'disponibilidad-data' => 'disponibilidad-data',
        'footer' => 'footer',
        'header' => 'header',
        'mail-body' => 'mail-body',
        'post-data' => 'post-data',
        'simple-login' => 'simple-login',
        'unavailable' => 'unavailable',
    ],
    'image_map_pro' => App\ImageMapPro\ImageMapPro::class,
    'plans'=>\App\Plans\Plans::class,
];

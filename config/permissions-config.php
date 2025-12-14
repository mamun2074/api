<?php 

    return [
        'rolepermission-enable' => env('ROLEPERMISSION_ENABLE', false),
        'do-migration' => true,
        'model' => 'App\User',
        'primary-key' => 'id',
        'name' => 'name',
        'login-route' => 'login',
        'table-prefix' => 'permission_'
    ];
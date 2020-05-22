<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/provider/request/*',
        '/provider/profile/available',
        '/account/kit',
        'admin/logout',
        'crm/logout',
        'cms/logout',
        'accouunt/logout',
        'fleet/logout',
        'support/logout'
    ];
}

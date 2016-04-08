<?php namespace utbvirtual\openldapsavio;

/**
 * @package   savio\openldapsavio
 * @author    Santiago <contacto@santiagomendoza.org>
 * @copyright Copyright (c) Santiago
 * @licence   http://mit-license.org/
 * @link      https://github.com/santiagoutb/openldap-savio
 */

use Auth;
use Illuminate\Auth\Guard;
use Illuminate\Support\ServiceProvider;

class LdapAuthServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::extend('ldap', function($app) {
            $provider = new LdapAuthUserProvider();
            return new Guard($provider, $app['session.store']);
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('auth');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;

class Locale
{

    public function __construct(Application $app){
        $this->app = $app;
        $this->configRepository = $this->app['config'];

        // set default locale
        $this->defaultLocale = $this->configRepository->get('app.locale');
        $this->fallbackLocale = $this->configRepository->get('app.fallback_locale');
        $this->supportedLocales = $this->configRepository->get('translatable.locales');
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(2);

        if (!in_array($locale, $this->supportedLocales)){
            throw new \Exception('Locale is not in the translatable.locales array.');
        }

        $this->app->setLocale($locale);
        $request->route()->forgetParameter('locale');

        return $next($request);
    }
}

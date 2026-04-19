<?php

namespace App\Http\Middleware;

use App\Models\CountriesModel;
use App\Models\VisitorIPModel;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpFoundation\Response;

class PersonalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $ip = $request->ip();
        $personal = Location::get($ip);
        $recentvisit = VisitorIPModel::where('ip', $ip)
            ->whereDate('created_at', '>', Carbon::now()->subDays(1))->get();


        if ($personal && !session('location_user')) {
            $m = CountriesModel::where('iso', $personal->countryCode)->select('flag', 'currency', 'name', 'iso3')->first();
            if ($m->currency == null) {
                $currency = 'USD';
            } else {
                $currency = $m->currency;
            }
            $sessionData = [
                'location_user' => $m->iso3,
                'ip' => $ip,
                'flag_image' => $m->flag,
                'session_currency' => $currency,

            ];
            session($sessionData);
            if (count($recentvisit) == 0) {
                $visitor = new VisitorIpModel();
                $visitor->ip = $ip;
                $visitor->location = $personal->countryName;
                $visitor->updated_at = Carbon::now();
                $visitor->save();

            }
        } else {
            if (!session('location_user')) {
                $m = CountriesModel::where('name', 'KENYA')->select('flag', 'iso3')->first();
                $sessionData = [
                    'location_user' => 'KEN',
                    'ip' => $ip,
                    'flag_image' => $m->flag,
                    'session_currency' => 'USD',
                ];
                session($sessionData);

            }


        }
        return $next($request);


    }
}

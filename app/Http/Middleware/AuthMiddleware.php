<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT; //panggil library JWT
use Firebase\JWT\Key; //panggil library tambahan dari JWT

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // ambil token dan masukkan ke variable $token
        $jwt = $request->bearerToken();

        // cek jika jwt null kosong
        if($jwt == 'null' || $jwt == '') {
            // jika ya maka response ini muncul
            return response()->json([
                'msg' => 'Akses ditolak, token tidak memenuhi'
            ],401);

        } else {

            // decode token
            $jwtDecoded = JWT::decode($jwt, new Key(env('JWT_SECRET_KEY'), 'HS256'));

            // jika token itu milik admin
            if($jwtDecoded->role == 'admin') {
              return $next($request);
            }

            // jika tidak maka response ini muncul
            return response()->json([
                'msg' => 'Akses ditolak, token tidak memenuhi'
            ],401);
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class aksesProdi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $testing = DB::table('role')
            ->select('nama_role')
            ->where('id',auth()->user()->role)->first();
        $namaRole = Str::upper($testing->nama_role);

        if($namaRole == 'PRODI'){
            return $next($request);
        }else{
            return  redirect(route('unauthorized'));
        }
    }
}

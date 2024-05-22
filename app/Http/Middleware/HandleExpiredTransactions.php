<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleExpiredTransactions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Transaction::where('expiry', '<', now())
            ->where('status', 'pending')
            ->get()
            ->each(function ($transaction) {
                $transaction->status = 'expired';
                $transaction->save();
            });

        return $next($request);
    }
}

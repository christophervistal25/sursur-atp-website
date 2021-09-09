<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\QuickStat;
use App\Jobs\SendEmailJob;
use App\Jobs\FetchCovidQuickJob;
use DB;

class FetchQuickCovidMiddleware
{

    private function isItNeedToFetch() :bool
    {
        $latestJob = DB::table('jobs')->latest()->first();

        $now = Carbon::now();

        // Jobs table has records.
        if(!is_null($latestJob)) {
            // Get the what is the date of latest job.
            $processTheTimeStampToExactDate = Carbon::parse(date('m/d/Y h:i:s A', $latestJob->created_at));

            return $now->diffInDays($processTheTimeStampToExactDate) != 0;

        } else {
            // Get the latest record in quick stats table.
            $latestQuickStat = QuickStat::latest()
                                        ->first();

            // Check if there is a record or empty.
            if(!is_null($latestQuickStat)) {
                $differenceInDays = $now->diffInDays($latestQuickStat->created_at);

                if($differenceInDays != 0) {
                    return true;
                }

                return false;

            } else { // This means that there is not data in quick stat.
                return true;
            }

        }
        return false;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $latestQuickStat = QuickStat::latest()
                                    ->first();

        $now = Carbon::now();

        if(!is_null($latestQuickStat)) {

            $differenceInDays = $now->diffInDays($latestQuickStat->created_at);

            if($differenceInDays != 0 && $this->isItNeedToFetch()) {
                $fetchJob = (new FetchCovidQuickJob())->onQueue('high')->delay(Carbon::now()->addSeconds(5));
                dispatch($fetchJob);
            }
        } else {
            if($this->isItNeedToFetch()) {
                $fetchJob = (new FetchCovidQuickJob())->onQueue('high')->delay(Carbon::now()->addSeconds(5));
                dispatch($fetchJob);
            }

        }

        return $next($request);
    }
}

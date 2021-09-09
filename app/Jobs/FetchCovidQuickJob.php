<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\QuickStat;
use Carbon\Carbon;

class FetchCovidQuickJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function fetch()
    {
        $client = new \GuzzleHttp\Client();
        // Send an asynchronous request.
        $request = new \GuzzleHttp\Psr7\Request('GET', 'https://covid19stats.ph/api/stats/location');
        $promise = $client->sendAsync($request)->then(function ($response) {

            $data   = json_decode($response->getBody(), true);

            foreach($data['cities'] as $key => $city) {
                if(\Str::contains($city['slug'], 'surigao-del-sur')) {
                        QuickStat::updateOrCreate(
                            [
                            'name'      => $city['name'],
                            'confirmed' => $city['total'],
                            'recovered' => $city['recovered'],
                            'deaths'    => $city['deaths'],
                            ]
                     );
                }
            }



        });
        $promise->wait();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->fetch();
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }
}

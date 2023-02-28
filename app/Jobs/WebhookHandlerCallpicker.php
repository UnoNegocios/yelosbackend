<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\ProcessWebhookJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\CallpickerCall;
use App\Events\Test;


class WebhookHandlerCallpicker extends ProcessWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->webhookCall['payload'];

       $test = new CallpickerCall();

        $test->request_id = $data['request_id'];
        $test->call_type = $data['call_type'];
        $test->call_status = $data['call_status'];
        $test->date = $data['date'];
        $test->caller_id = $data['caller_id'];
        $test->duration = $data['duration'];
        $test->callpicker_number = $data['callpicker_number'];
        $test->dialed_number = $data['dialed_number'];
        $test->answered_by = $data['answered_by'];
        $test->dialed_by = $data['dialed_by'];
        $test->records = json_encode($data['records']);
        $test->city = $data['city'];
        $test->state = $data['state'];
        //$test->record_keys = $data['record_keys'];

        //Log::debug(json_encode($test));
        


        //$call = json_decode($test);
        $test->save();
        broadcast(new Test());
       
    }
}

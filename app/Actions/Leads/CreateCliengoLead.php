<?php
namespace App\Actions\Leads;

use App\Models\Lead;
use Illuminate\Support\Facades\Log;

class CreateCliengoLead
{
    public function execute($data){  
        if(isset($data['customParams']['final_question'])){
            $final_question = $data['customParams']['final_question'];
        }else{
            $final_question = 'null';
        }

        if(isset($data['customParams']['contact_time'])){
            $contact_time = $data['customParams']['contact_time'];
        }else{
            $contact_time = 'null';
        }

        $geoip = [
            'latitude' => $data['geoip']['latitude'],
            'longitude' => $data['geoip']['longitude'],
            'country' => $data['geoip']['country'],
            'state' => $data['geoip']['state'],
            'city' => $data['geoip']['city'],
            'zipCode' => $data['geoip']['zipCode'],
        ];
        $newLead = new Lead();
        $newLead->name = $data['name'];
        $newLead->last = $data['lastName'];
        $newLead->phone = $data['phone'];
        $newLead->email = $data['email'];
        $newLead->status = $data['status'];
        $newLead->origin_id = '3';
        $newLead->funnel_phase_id = '1';
        $newLead->additional_data = [
            'final_question' => $final_question,
            'contact_time' => $contact_time,
            'geoip' => $geoip,
            'conversation' => $data['message'],
        ];
        $newLead->channel = 'cliengo';
        

        $newLead->save();

        return $newLead->id;

    }
}
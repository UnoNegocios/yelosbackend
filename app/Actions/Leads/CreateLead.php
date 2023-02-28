<?php
namespace App\Actions\Leads;

use App\Models\Lead;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

class CreateLead{

    public static function execute($data){
        $newLead = new Lead();
        $newLead->phone = $data['message']['from'];
        $newLead->origin_id = '1';
        $newLead->funnel_phase_id = '1';

        if(Arr::exists($data['message']['visitor'],'firstName')){
            $newLead->name = $data['message']['visitor']['firstName'];
        }else{
            $newLead->name = $data['message']['visitor']['name'];
        }
        if(Arr::exists($data['message']['visitor'],'lastName')){
            $newLead->last = $data['message']['visitor']['lastName'];
        }


        $newLead->save();

        return $newLead->id;

    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FacebookLeadService;
class WebhookController extends Controller
{
    public function handleFbLeads ( Request $request ){
        $hubChallenge = $request->input('hub_challenge');
        $hubVerifyToken = $request->input('hub_verify_token');

        if( $hubVerifyToken == 'investment-realestae-sydney'){
            return $hubChallenge;
        }

        // We read all the payload of the request
        $requestData = $request->all();

        // We fetched the entry data from the request
        $entry = data_get( $requestData, 'entry' );

        if( !empty( $entry ) ){

            $fbLeadServiceObj = new FacebookLeadService;

            // Entry data is the array so we have to iterate it.
            foreach( $entry as $item ){
                // We get the chages key inside the each item
                $changes = data_get( $item, 'changes' );

                // Again changes is array element
                foreach( $changes as $changeItem ){

                    // Facebook will send the lead data wrap into the field.
                    $fieldName = data_get( $changeItem, 'field');

                    // We match the field name must be lead data or not.
                    if( $fieldName == 'leadgen' ){

                        // Facebook only send the ids of the form and lead generation id into the webhook.
                        // We have to get the lead if and form id and based on that we have to fetched the lead data from the Facebook Graph API
                        $leadGenData = data_get( $changeItem, 'value' );
                        $formId = data_get( $leadGenData, 'form_id' );
                        $leadGenId = data_get( $leadGenData, 'leadgen_id' );

                        // We pass the lead id and form id to the Facebook graph to read the lead data
                        $fbLeadServiceObj->fetchLeadData( $leadGenId, $formId );
                    }
                }
            }
        }
    }
}

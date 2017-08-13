<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenCloud\Rackspace;

class RackspaceController extends Controller
{
    //
    public function index()
    {
        $client = new Rackspace(Rackspace::US_IDENTITY_ENDPOINT, array(
            'username' => 'pvdevelopers',
            'apiKey'   => '8bdb4718de4b4d65aba53c0cc4637801'
        ));
        $service = $client->dnsService();
        $domainService = $service->domain('5570930');
//       $record = $domainService->record('A-18921899');
//        dd($record);
//        $record->data = '111.113.113.123';
//        $record->update();
//        dump($record);
//        $test = $domainService->record(['name' => 'damna.pvdemo.com',
//                                        'data' =>'111.112.113.114',
//                                        'ttl' => 5]);
//        $test->create();
        $record = $domainService->record(array(
            'type' => 'NS',
            'name' => 'asd.pvdemo.com',
            'data' => '111.113.113.125',
            'ttl'  => 3600
        ));

        $record->create();
//        dump($domainService->record($domainService->id));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PulkitJalan\Google\Client as client;

class TestController extends Controller
{
    //
    public function index()
    {
        $config = Config::get('google');
        $client = new client($config);
        $googleClient = $client->getClient();
        $storage = $client->make('webmasters');

////        $storage->buckets->listBuckets('project id');
        dump($storage->sites->add('mula.com'));
//
//        $storage = $client->make('SiteVerification');
        // list buckets example
//        $storage->buckets->listBuckets('project id');
//        dd($storage->webResource->methods->list());
//        dd($storage->webResource);
//        dump($storage->sites->add('doman.com'));

    }
}

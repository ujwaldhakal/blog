<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NativeController extends Controller
{
    //
    public function index()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/blog/pagevamp-api-e2cb81a881c9.json');
       $google = new \Google_Client();
      $google->useApplicationDefaultCredentials();
        $google->addScope('https://www.googleapis.com/auth/webmasters');


            $sqladmin = new \Google_Service_Webmasters($google);
//            dump($sqladmin);
       dd($sqladmin->sites->listSites());
//        dd($sqladmin->webResource->getToken($request));
    }

    public function addSites()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/blog/pagevamp-api-e2cb81a881c9.json');
        $google = new \Google_Client();
        $google->useApplicationDefaultCredentials();
        $google->addScope('https://www.googleapis.com/auth/webmasters');


        $sqladmin = new \Google_Service_Webmasters($google);
//        dd($sqladmin->sites->delete('http://128.199.244.1/'));
        $a= $sqladmin->sites->add('http://128.199.244.1/');
            dd($a);

    }

    public function listSites()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/blog/pagevamp-api-e2cb81a881c9.json');
        $google = new \Google_Client();
        $google->useApplicationDefaultCredentials();
        $google->addScope('https://www.googleapis.com/auth/webmasters');


        $sqladmin = new \Google_Service_Webmasters($google);
        $a= $sqladmin->sites->listSites();
        dd($a);
    }

    public function addSiteMaps()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/blog/pagevamp-api-e2cb81a881c9.json');
        $google = new \Google_Client();
        $google->useApplicationDefaultCredentials();
        $google->addScope('https://www.googleapis.com/auth/webmasters');


        $sqladmin = new \Google_Service_Webmasters($google);

        dd($sqladmin->sitemaps->submit('http://128.199.244.1/','http://128.199.244.1/sitemaps.xml'));

    }

    public function listSiteMaps()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/blog/pagevamp-api-e2cb81a881c9.json');
        $google = new \Google_Client();
        $google->useApplicationDefaultCredentials();
        $google->addScope('https://www.googleapis.com/auth/webmasters');


        $sqladmin = new \Google_Service_Webmasters($google);

        dd($sqladmin->sitemaps->listSitemaps('http://128.199.244.1/'));

    }

    public function verify()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/blog/pagevamp-api-e2cb81a881c9.json');
        $google = new \Google_Client();
        $google->useApplicationDefaultCredentials();
        $google->addScope('https://www.googleapis.com/auth/siteverification');
        $site = new \Google_Service_SiteVerification_SiteVerificationWebResourceGettokenRequestSite();
        $site->setIdentifier('http://128.199.244.1/');
        $site->setType('SITE');

        $request1 = new \Google_Service_SiteVerification_SiteVerificationWebResourceGettokenRequest();
        $request1->setSite($site);
        $request1->setVerificationMethod('Meta');

        $site = new \Google_Service_SiteVerification_SiteVerificationWebResourceResourceSite();
        $site->setIdentifier('http://128.199.244.1/');
        $site->setType('SITE');

        $request = new \Google_Service_SiteVerification_SiteVerificationWebResourceResource();
        $request->setSite($site);

        $service = new \Google_Service_SiteVerification($google);
        $webResource = $service->webResource;
//        dd($webResource->getToken($request1));
        $result = $webResource->insert('Meta',$request);
        dd($webResource->listWebResource());
//        dd($token);
    }

    public function getToken()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/blog/pagevamp-api-e2cb81a881c9.json');
        $google = new \Google_Client();
        $google->useApplicationDefaultCredentials();
        $google->addScope('https://www.googleapis.com/auth/siteverification');
        $site = new \Google_Service_SiteVerification_SiteVerificationWebResourceGettokenRequestSite();
        $site->setIdentifier('http://128.199.244.1/');
        $site->setType('SITE');

        $request1 = new \Google_Service_SiteVerification_SiteVerificationWebResourceGettokenRequest();
        $request1->setSite($site);
        $request1->setVerificationMethod('Meta');

        $site = new \Google_Service_SiteVerification_SiteVerificationWebResourceResourceSite();
        $site->setIdentifier('http://128.199.244.1/');
        $site->setType('SITE');

        $request = new \Google_Service_SiteVerification_SiteVerificationWebResourceResource();
        $request->setSite($site);

        $service = new \Google_Service_SiteVerification($google);
        $webResource = $service->webResource;
        dd($webResource->getToken($request1));

    }



    public function analytics()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/blog/pagevamp-api-e2cb81a881c9.json');
        $google = new \Google_Client();
        $google->useApplicationDefaultCredentials();
        $google->addScope('https://www.googleapis.com/auth/analytics');
       $analytics = new \Google_Service_Analytics($google);
       dd($analytics);
       dd($analytics->data_ga->get('hZP1EO5Zgz3iN5NlmaV19TCTbYm4pjh_PdshKIWdHJc','2017/5/1','2017/6/1',[]));

    }
}

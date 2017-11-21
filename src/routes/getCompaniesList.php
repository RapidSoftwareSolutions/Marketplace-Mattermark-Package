<?php

$app->post('/api/Mattermark/getCompaniesList', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $requiredParams = ['apiKey'=>'apiKey'];
    $optionalParams = ['location' => 'location','startAddedDate'=>'startAddedDate','endAddedDate'=>'endAddedDate','domain'=>'domain','companyName'=>'companyName','companyName'=>'company_name','startAddedDate'=>'startAddedDate','endAddedDate'=>'endAddedDate','mattermarkScore'=>'mattermark_score','momentumScore'=>'momentum_score','employees'=>'employees','employeesMonthAgo'=>'employees_month_ago','employeesAddedInMonth'=>'employees_added_in_month','employeesMom'=>'employees_mom','cachedUniques'=>'cached_uniques','cachedUniquesWeekAgo'=>'cached_uniques_week_ago','uniquesWow'=>'uniques_wow','cachedUniquesMonthAgo'=>'cached_uniques_month_ago','uniquesMom'=>'uniques_mom','cachedMobileDownloads'=>'cached_mobile_downloads','cachedMobileDownloadsWeekAgo'=>'cached_mobile_downloads_week_ago','mobileDownloadsWow'=>'mobile_downloads_wow','cachedMobileDownloadsMonthAgo'=>'cached_mobile_downloads_month_ago','mobileDownloadsMom'=>'mobile_downloads_mom','estFoundingDates'=>'est_founding_date','stages'=>'stage','hasGooglePlay'=>'has_google_play','hasItunes'=>'has_itunes','playCategory'=>'play_category','itunesCategory'=>'itunes_category','businessModels'=>'business_models','industries'=>'industries','keywords'=>'keywords','page'=>'page','perPage'=>'per_page'];
    $bodyParams = [
       'query' => ['domain','company_name','added_date','mattermark_score','momentum_score','employees','employees_month_ago','employees_added_in_month','employees_mom','cached_uniques','cached_uniques_week_ago','uniques_wow','cached_uniques_month_ago','uniques_mom','cached_mobile_downloads','cached_mobile_downloads_week_ago','mobile_downloads_wow','cached_mobile_downloads_month_ago','mobile_downloads_mom','est_founding_date','stage','investors','total_funding','last_funding_date','last_funding_amount','location','state','has_google_play','has_itunes','play_category','itunes_category','business_models','industries','keywords','page','per_page']
    ];

    $data = \Models\Params::createParams($requiredParams, $optionalParams, $post_data['args']);

    $exValue = ["location","state","play_category","itunes_category","business_models","industries","keywords"];

    if(!empty($data['est_founding_date']))
    {
        $data['est_founding_date'] = \Models\Params::toString($data['est_founding_date'], '|');
    }

    if(!empty($data['stage']))
    {
        $data['stage'] = \Models\Params::toString($data['stage'], '|');
    }

    $client = $this->httpClient;
    $query_str = "https://api.mattermark.com/companies?";


    $requestParams = \Models\Params::createRequestBody($data, $bodyParams);
    $requestParams['headers'] = ["Authorization"=>"Bearer {$data['apiKey']}"];

    if(!empty($data['startAddedDate']) && empty($data['endAddedDate']))
    {
        $requestParams['query']['added_date'] = $data['startAddedDate'];
    }

    if(!empty($data['startAddedDate']) && !empty($data['endAddedDate']))
    {
        $requestParams['query']['added_date'] = $data['startAddedDate'].'~'.$data['endAddedDate'];
    }

    if(!empty($requestParams['query']))
    {
        foreach($requestParams['query'] as $key => $value)
        {
            if(in_array($key,$exValue))
            {
                foreach($value as $param)
                {
                    $query_str .= '&'.$key.'='.$param;
                }
                continue;
            }

            $query_str .= '&'.$key.'='.$value;
        }

        if(!empty($requestParams['query']))
        {
            unset($requestParams['query']);
        }

    }



    try {
        $resp = $client->get($query_str, $requestParams);
        $responseBody = $resp->getBody()->getContents();

        if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            if(empty($result['contextWrites']['to'])) {
                $result['contextWrites']['to']['status_msg'] = "Api return no results";
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ConnectException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';

    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});
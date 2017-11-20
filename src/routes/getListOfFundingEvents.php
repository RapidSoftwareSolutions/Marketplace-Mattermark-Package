<?php

$app->post('/api/Mattermark/getListOfFundingEvents', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $requiredParams = ['apiKey'=>'apiKey'];
    $optionalParams = ['amount'=>'amount','cities'=>'city','countries'=>'country','startFundingDate'=>'startFundingDate','endFundingDate'=>'endFundingDate','investorIds'=>'investor_ids','investorSlugs'=>'investor_slugs','series'=>'series','page'=>'page','perPage'=>'per_page'];
    $bodyParams = [
       'query' => ['amount','city','country','funding_date_range','investor_ids','investor_slugs','series','page','per_page']
    ];

    $exValue = ["investor_ids","investor_slugs"];

    $data = \Models\Params::createParams($requiredParams, $optionalParams, $post_data['args']);

    if(!empty($data['city']))
    {
        $data['city'] = \Models\Params::toString($data['city'], '|');

    }
    if(!empty($data['country']))
    {
        $data['country'] = \Models\Params::toString($data['country'], '|');

    }


    $client = $this->httpClient;
    $query_str = "https://api.mattermark.com/fundings";

    

    $requestParams = \Models\Params::createRequestBody($data, $bodyParams);
    $requestParams['headers'] = ["Authorization"=>"Bearer {$data['apiKey']}"];


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
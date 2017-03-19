<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.2.2017.
 * Time: 20:18
 */

namespace MediaRatings\Import;
use MediaRatings\Models;
use Phalcon\Mvc\User\Component;
use Phalcon\Paginator\Adapter\Model;

class BaseImport  extends Component
{
    public function getDatabaseMovieResponse($queryParam) {
        $dbAPI = $this->config->movieDatabase;
        $query_prefix = '?';
        if (strpos($queryParam, '?') !== false) {
            $query_prefix = '&';
        }
        $url = sprintf('%s%s%sapi_key=%s', $dbAPI->apiBaseUrl, $queryParam, $query_prefix,  $dbAPI->apiKey);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
            //TODO: log error and handle different kinds of response;
        } else {
            return json_decode($response, JSON_NUMERIC_CHECK);
        }
    }

    public function handleStatusType($statusName){
        $status = Models\MediaStatusType::findFirst("name = '". $statusName ."'");
        if(!isset($status)){
            $new_status = new Models\MediaStatusType();
            $new_status->name = $statusName;
            if ($new_status->save() === true) {
                $status = Models\MediaStatusType::findFirst("name = '". $statusName ."'");
            }
        }
        return $status->id;
    }
}
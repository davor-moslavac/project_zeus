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
            CURLOPT_POSTFIELDS => "{}"
        ));

        $response = json_decode(curl_exec($curl), JSON_NUMERIC_CHECK);
        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);


        if ($httpcode != 200) {
            $this->logger->error(sprintf('Import (TMDB): Status code: %s, Status message: %s; Url: %s;', $response['status_code'], $response['status_message'], $url));
            return null;
        } else if ($err) {
            $this->logger->error(sprintf('Import (TMDB): Error: %s; Url: %s ', $err, $url));
            return null;
        } else {
            return $response;
        }
    }

    public function handleStatusType($statusName){
        $status = Models\MediaStatusType::findFirstByName($statusName);
        if(!$status){
            $new_status = new Models\MediaStatusType();
            $new_status->name = $statusName;
            if ($new_status->save() === true) {
                $status = Models\MediaStatusType::findFirstByName($statusName);
            }
        }
        return $status->id;
    }
}
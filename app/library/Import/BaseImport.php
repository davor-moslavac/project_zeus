<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.2.2017.
 * Time: 20:18
 */

namespace MediaRatings\Import;
use Phalcon\Mvc\User\Component;

class BaseImport  extends Component
{
    private $requestLatency = 0.2;
    public function __construct()
    {
        $date = new \DateTime();
        $this->session->set("last-request-time-check", $date);
    }

    public function getDatabaseMovieResponse($queryParam)
    {
        $this->waitFoRateLimit();
        $dbAPI = $this->config->movieDatabase;
        $query_prefix = '?';
        if (strpos($queryParam, '?') !== false) {
            $query_prefix = '&';
        }
        $url = sprintf('%s%s%sapi_key=%s', $dbAPI->apiBaseUrl, $queryParam, $query_prefix, $dbAPI->apiKey);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        list($headerContent, $response) = explode("\r\n\r\n", $response, 2);
        $headers = $this->processHeaders($headerContent);

        $limitRemaining = $headers['X-RateLimit-Remaining'];
        $limitReset = $headers['X-RateLimit-Reset'];

        $this->updateRateLimit($limitRemaining, $limitReset);
        $result = json_decode($response, JSON_NUMERIC_CHECK);
        if ($httpcode != 200) {
            $this->logger->error(sprintf('Import (TMDB): Status code: %s, Status message: %s; Url: %s;', $result['status_code'], $result['status_message'], $url));
            return null;
        } else if ($err) {
            $this->logger->error(sprintf('Import (TMDB): Error: %s; Url: %s ', $err, $url));
            return null;
        } else {
            return $result;
        }
    }

    public function getTrailerUrl($videos){
        if(isset($videos) && isset($videos['results'])) {
            if(count($videos['results']) > 0) {
                $video = $videos['results'][0];
                $filteredVideos = array_values(array_filter($videos['results'], function ($value) {
                    return ($value['type'] == 'Trailer');
                }));

                if (isset($filteredVideos) && count($filteredVideos) > 0) {
                    $video = $filteredVideos[0];
                }

                //TODO: check for other providers
                if ($video['site'] == 'YouTube') {
                    return 'https://youtu.be/' . $video['key'];
                }
            }
        }
        return null;
    }

    private function waitFoRateLimit(){
        $now = new \DateTime();
        $next_request_time = $this->session->get("next-request-time");
        if($next_request_time > $now){
            $time = $next_request_time - $now;
            $this->logger->debug('Sleep for: ' . $time . ' seconds.');
            sleep($time);
        }
    }

    private function updateRateLimit($limitRemaining, $limitReset){
        $resetTime = new \DateTime();
        $now = new \DateTime();
        $resetTime = $resetTime->setTimestamp($limitReset);
        $difference = ($resetTime->getTimestamp() - $now->getTimestamp()) /(1.0 + $limitRemaining);
        $delay =  $difference - $this->requestLatency;
        $now = $now->setTimestamp($now->getTimestamp() + $delay);
        $this->session->set("next-request-time", $now);
    }

    private function processHeaders($headerContent){
        $headers = array();
        foreach (explode("\r\n", $headerContent) as $i => $line) {
            if($i===0){
                $headers['http_code'] = $line;
            }else{
                list($key,$value) = explode(':', $line);
                $headers[$key] = $value;
            }
        }
        return $headers;
    }
}
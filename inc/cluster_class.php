<?php

class dxcccluster
{
    private $limit;
    private $clusterurl;
    private $curl_session;

    function __construct($clusterurl)
    {
        $this->clusterurl = $clusterurl;
        $this->curl_session = curl_init();
        curl_setopt($this->curl_session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl_session,  CURLOPT_URL, $clusterurl);
    }
    function __destruct()
    {
        curl_close($this->curl_session);
    }
    function get_cluster_spots($limit, array $filter)
    {
        $resultstring = curl_exec($this->curl_session);
        $jsonarray = json_decode($resultstring, TRUE);
        $i = 0;
        foreach ($jsonarray as $spot) {
            foreach ($filter as $filter_key => $filter_value) {
                if ($filter_key == "bands") {
                    if (!in_array($spot["band"], $filter_value)) {
                        unset($jsonarray[$i]);
                        break;
                    }
                } elseif ($filter_key == "modes") {
                    if (!in_array($spot["mode"], $filter_value)) {
                        unset($jsonarray[$i]);
                        break;
                    }
                } elseif ($spot[$filter_key] != $filter_value) {
                    unset($jsonarray[$i]);
                    break;
                }
            }
            $i += 1;
        }
        return array_slice($jsonarray, 0, $limit);
    }
}

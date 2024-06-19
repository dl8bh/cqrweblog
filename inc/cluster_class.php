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
        $returnarray = array();
        $hitcount = 0;
        foreach ($jsonarray as $spot) {
            $delete = false;
            foreach ($filter as $filter_key => $filter_value) {
                if (!$delete) {
                    if ($filter_key == "bands") {
                        if (isset($filter_value[0])) {
                            if (!in_array($spot["band"], $filter_value)) {
                                $delete = true;
                            }
                        }
                    } elseif ($filter_key == "modes") {
                        if (isset($filter_value[0])) {
                            if (!in_array($spot["mode"], $filter_value)) {
                                $delete = true;
                            }
                        }
                    } elseif ($filter_key == "skimmer_mode") {
                        if ($filter_value == 2 && !$spot["skimmer"]) {
                            $delete = true;
                        } elseif ($filter_value == 1 && $spot["skimmer"]) {
                            $delete = true;
                        }
                    } elseif ($spot[$filter_key] != $filter_value) {
                        $delete = true;
                    }
                }
            }
            if (!$delete) {
                $hitcount += 1;
                $spot["comment"] = strip_tags($spot["comment"]);
                array_push($returnarray, $spot);
            }
            if ($hitcount == $limit) {
                break;
            }
        }
        return $returnarray;
    }
}

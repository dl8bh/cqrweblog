<?php

class Cqrlog_common {
    private $dbobj;
    
    function __construct($dbobj) {
        $this->dbobj = $dbobj;
        $this->dbobj->select_db("cqrlog_common");
    }
    
    function adif_to_dxcc (int $adif) {
        
        $adif = $this->dbobj->real_escape_string($adif);
        $query = sprintf("select pref from dxcc_ref where adif = '%u'", $adif);
        $result = $this->dbobj->query($query);
        return $result->fetch_object()->pref;
}

    function get_iota (string $call, string $pref) {
        $call = $this->dbobj->real_escape_string($call);
        $pref = $this->dbobj->real_escape_string($pref);
        $query = sprintf('SELECT * FROM iota_list WHERE dxcc_ref="%s" AND "%s" RLIKE CONCAT("^",pref) AND pref !=""', $pref, $call);
        $result = $this->dbobj->query($query);
        $iota_nr = NULL;
        $island_name = NULL;
        if ($result->num_rows) {
            $result = $result->fetch_assoc();
            $island_name = $result["island_name"];
            $iota_nr = $result["iota_nr"];
        }
        return array ($iota_nr, $island_name);
    }
    
    function logid_to_call ( $log_id ) {
            
            global $dbconnect;		
            $dbconnect -> select_db("cqrlog_common" );
            
            $log_id = mysqli_real_escape_string($dbconnect ,$log_id);
            $ergebnis = mysqli_query($dbconnect, "SELECT log_name FROM log_list WHERE log_nr=" . $log_id);
            while($row = mysqli_fetch_object($ergebnis)) {
                    return $row->log_name;
            }
                    
                    return NULL;
    }
    
    function freq_to_band_mode ( $inputfreq ) {
                    
            global $dbconnect;
            $dbconnect -> select_db("cqrlog_common");
            
            $inputfreq = mysqli_real_escape_string($dbconnect ,$inputfreq);
            $ergebnis = mysqli_query($dbconnect, "select cw,rtty,ssb,band from bands where b_begin <= " . $inputfreq . " and b_end >=" . $inputfreq  );
            
            while($row = mysqli_fetch_object($ergebnis)) {
                    $returnband=$row->band;
                    if ($inputfreq < $row->cw) {
                            $returnmode = "CW";
                    }
                    
                    else if (($inputfreq >= $row->rtty)&&($inputfreq < $row->ssb)) {
                            $returnmode = "RTTY";
                    }
                    
                    else if ($inputfreq > $row->ssb) {
                            $returnmode = "SSB";
                    }
    
                    return array ($returnband, $returnmode);
            }
    
            return NULL ;
    }
    
    function freq_to_band ( $inputfreq ) {
            $bandmode = freq_to_band_mode($inputfreq);
            return $bandmode[0];
    }
    
    function freq_to_mode ( $inputfreq ) {
            
            $bandmode = freq_to_band_mode($inputfreq);
            return $bandmode[1];
    }
    
    function get_manager ( $call ) {
    
            global $dbconnect;		
            $dbconnect -> select_db("cqrlog_common" );
            
            $call = mysqli_real_escape_string($dbconnect ,$call);
            $ergebnis = mysqli_query($dbconnect, 'SELECT qsl_via FROM qslmgr WHERE callsign ="' . $call . '"');
            
            while($row = mysqli_fetch_object($ergebnis)) {
                    return $row->qsl_via;
            }
            
            return NULL;
    }
    
    function band_to_freq ( $inputband ) {
            
            global $dbconnect;
            $dbconnect -> select_db("cqrlog_common");
            
            $inputband = mysqli_real_escape_string($dbconnect ,$inputband);
            $ergebnis = mysqli_query($dbconnect, "select b_begin from bands where band = '" . $inputband ."'"  );
            
            while($row = mysqli_fetch_object($ergebnis)) {
                    return $row->b_begin;
            }
    
            return NULL;
    }
    
    function validate_freq ( $freq ) {
            
            switch ($freq) {
                //check for lazy WARC band frequency input
                case '10' :
                    return band_to_freq( '30M' );
                    break;
                
                case '18' :
                    return band_to_freq( '17M' );
                    break;
                
                case '24' :
                    return band_to_freq( '12M' );
                
                case '' :
                    return NULL;
                
                //Check if frequency input was in kHz, if true, convert to MHz
                default:
                if (!freq_to_band($freq)) {
                        
                        //kHz/1000 = MHz
                        $newfreq=$freq/1000;
                        
                        if (freq_to_band( $newfreq )) {
                                
                                return $newfreq;
                        }
                }
                
                return $freq;
                break;
            }
    }
    
    function dxcc_to_adif ( $dxcc ) {
    
            global $dbconnect;
            $dbconnect -> select_db("cqrlog_common");
          
            $dxcc = mysqli_real_escape_string($dbconnect ,$dxcc);
            $ergebnis = mysqli_query($dbconnect, "select adif from dxcc_ref where pref = '" . $pref ."'"  );
            
            while($row = mysqli_fetch_object($ergebnis)) {
                    
                    return $row->adif;
            }
    
            return NULL;
    }
    
}
    
    ?> 
    
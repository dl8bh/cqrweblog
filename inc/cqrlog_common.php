<?php

class cqrlog_common {
    private $dbobj;
    
    __construct($dbobj) {
		$this->dbobj = $dbobj;
        $this->dbobj->select_db("cqrlog_common");
    }
	
	function logid_to_tableid ( $log_id ) {
		$log_id = sprintf("%03d", $log_id);	
		return 'cqrlog' . $log_id;
	}
	
	function get_iota (string $call, string $pref) {
			
			global $dbconnect;
			
			$dbconnect -> select_db("cqrlog_common");
			$call = mysqli_real_escape_string($dbconnect ,$call);
			$ergebnis = mysqli_query($dbconnect, 'SELECT * FROM iota_list WHERE dxcc_ref="' . $pref . '" AND "' . $call . '" RLIKE CONCAT("^",pref) AND pref !=""'  );	
			
			while($row = mysqli_fetch_object($ergebnis)) {
				$iota_nr = $row->iota_nr;
				$iota_name = $row->island_name;
				return array ( $iota_nr, $iota_name );
			}
			
			return array ( NULL , NULL);
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
	
	function adif_to_dxcc ( $adif ) {
			
			global $dbconnect;
			$dbconnect -> select_db("cqrlog_common");
			
			$adif = mysqli_real_escape_string($dbconnect , $adif);
			$ergebnis = mysqli_query($dbconnect, "select pref from dxcc_ref where adif = '" . $adif ."'"  );
			
			while($row = mysqli_fetch_object($ergebnis)) {
					
					return $row->pref;
			}
	
			return NULL;
	}
	
}
	
	?> 
	
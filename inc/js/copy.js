function data_copy()
{
document.stats.callsign.value=document.input.call.value;
document.search.call.value=document.input.call.value;
}

function fillClusterData(callsign, freq, mode) {
		document.input.call.value=callsign;
		document.stats.callsign.value=callsign;
		document.search.call.value=callsign;
		newfreq=freq/1000;
		document.input.freq.value=Math.round(newfreq*100000)/100000;
		if (mode!="") {
				document.input.mode.value=mode;
		}
		document.input.remarks.value="";
		document.input.time.value="";
		
		if (mode==="SSB") {
				document.input.rst_rcvd.value="59";
				document.input.rst_sent.value="59";
		}
		else {
				document.input.rst_rcvd.value="599";
				document.input.rst_sent.value="599";
		}
		
		
		document.input.call.focus();
}

function qrz_call() {
		window.open("http://qrz.com/db/".concat(document.input.call.value.toUpperCase()));
}


function wipe_data()
{
		document.input.call.value="";
		document.input.name.value="";
		document.input.remarks.value="";
		document.input.mode.value=document.input.mode.value.toUpperCase();
		if (document.input.mode.value.toUpperCase()==="SSB") {
				document.input.rst_sent.value="59";
				document.input.rst_rcvd.value="59";
		}
		else {
				document.input.rst_rcvd.value="599";
				document.input.rst_sent.value="599";
		}
		document.input.call.focus();
}

function normalize_date(date)
{
		switch (date) {
    case 1:
        return "01";
        break;
    case 2:
        return "02";
				break;
    case 3:
        return "03";
        break;
    case 4:
        return "04";
        break;
    case 5:
        return "05";
        break;
    case 6:
        return "06";
        break;
    case 7:
        return "07";
        break;
    case 8:
        return "08";
        break;
    case 9:
        return "09";
        break;
		default:
				return date;
} 
}
function clearband()
{
		input.band.value="select";
}

function bandtofreq()
{
		var band = input.band.value;
		
		switch (band) {
		
		case "2190M":
			freq="1.8000";
			break;
		case "630M":
			freq="0.4720";
			break;
		case "160M":
			freq="1.8000";
			break;
		case "80M":
			freq="3.5000";
			break;
		case "40M":
			freq="7.0000";
			break;
		case "30M":
			freq="10.1000";
			break;
		case "20M":
			freq="14.0000";
			break;
		case "17M":
			freq="18.0680";
			break;
		case "15M":
			freq="21.0000";
			break;
		case "12M":
			freq="24.8900";
			break;
		case "10M":
			freq="28.0000";
			break;
		case "6M":
			freq="50.0000";
			break;
		case "4M":
			freq="70.0000";
			break;
		case "2M":
			freq="144.0000";
			break;
		case "70CM":
			freq="433.0000";
			break;
		case "23CM":
			freq="1240.0000";
			break;
		case "13CM":
			freq="2300.0000";
			break;
		case "9CM":
			freq="3400.0000";
			break;
		case "6CM":
			freq="5650.0000";
			break;
		case "3CM":
			freq="10000.0000";
			break;
		case "1.25CM":
			freq="24000.0000";
			break;
		case "6MM":
			freq="47000.0000";
			break;
		case "4MM":
			freq="77500.0000";
			break;
		default:
		return;
		}
	input.freq.value=freq;
}

function qslsdate_update()
{
		var d = new Date();
		var month = normalize_date(d.getUTCMonth() + 1);
		document.input.qsls_date.value=d.getUTCFullYear() + "-" + month + "-" + normalize_date(d.getUTCDate());
}


function qslrdate_update()
{
		var d = new Date();
		var month = normalize_date(d.getUTCMonth() + 1);
		document.input.qslr_date.value=d.getUTCFullYear() + "-" + month + "-" + normalize_date(d.getUTCDate());
}

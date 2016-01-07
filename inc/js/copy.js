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

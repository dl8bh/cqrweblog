function data_copy()
{
document.stats.callsign.value=document.input.call.value;
document.search.call.value=document.input.call.value;
}

function fillClusterData(callsign, freq)
{
document.input.call.value=callsign;
document.stats.callsign.value=callsign;
document.search.call.value=callsign;

document.input.freq.value=freq/1000;
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

shortcut.add("Alt+w",function() {
			wipe_data();
});


shortcut.add("F11",function() {
			wipe_data();
});


shortcut.add("Alt+q",function() {
			window.open("http://qrz.com/db/".concat(document.input.call.value.toUpperCase()));
});

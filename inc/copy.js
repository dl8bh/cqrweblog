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
}

shortcut.add("Alt+w",function() {
			wipe_data();
});

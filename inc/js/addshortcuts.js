shortcut.add("Alt+w",function() {
			wipe_data();
});


shortcut.add("F11",function() {
			wipe_data();
});


shortcut.add("Alt+q",function() {
		qrz_call();
});

shortcut.add("SPACE",function() {
document.input.name.focus();
},{
'type':'keydown',
'propagate':false,
'target':document.input.call,
});

shortcut.add("SPACE",function() {
document.input.name.focus();
},{
'type':'keydown',
'propagate':false,
'target':document.input.rst_sent,
});


shortcut.add("SPACE",function() {
document.input.name.focus();
},{
'type':'keydown',
'propagate':false,
'target':document.input.rst_rcvd
});


shortcut.add("SPACE",function() {
document.input.name.focus();
},{
'type':'keydown',
'propagate':false,
'target':document.input.mode
});

shortcut.add("SPACE",function() {
document.input.call.focus();
},{
'type':'keydown',
'propagate':false,
'target':document.input.frequency,
});

shortcut.add("TAB",function() {
document.input.frequency.focus();
},{
'type':'keydown',
'propagate':false,
'target':document.input.remarks
});


$().ready(function() {
	
	//jMP3 init
	$("#external").jmp3({
		filepath: "lib/jquery/jMp3/",
		showfilename: "false",
		backcolor: "ffd700",
		forecolor: "8B4513",
		width: 200,
		showdownload: "false",
		//autoplay: "true"
	});
	
	$("#rankingByYearMusic").jmp3({
		filepath: "lib/jquery/jMp3/",
		showfilename: "false",
		backcolor: "ffd700",
		forecolor: "8B4513",
		width: 200,
		showdownload: "false",
		autoplay: "true"
	});
	
});

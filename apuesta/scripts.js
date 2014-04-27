$().ready(function() {

	$("#btnSave").click(function() {
	
		//validate
		err=false;
		$(".inputGoles").each(function(){
			if (!IsNumeric($(this).attr("value"))){
				err=true;
			}
		})

		if (err==true){
			alert("Faltan ingresar resultados");
			return false;
		}
		
		//confirm
		if (!confirm('Esta seguro?\nUna vez enviada no podra modificarla.')){
			return;
		}else{
			document.frmApuesta.submit();
		}
	});
	
	//tooltip
	$(".powerUp").tooltip();
	
});

//--------------------------------------

function IsNumeric(sText){

	var ValidChars = "0123456789";
	var IsNumber=true;
	var Char;
   
	if (sText.length==0)
		IsNumber = false;
		
	for (i = 0; i < sText.length && IsNumber == true; i++){ 
		Char = sText.charAt(i);
		if (ValidChars.indexOf(Char) == -1) {
			IsNumber = false;
		}
	}
   return IsNumber;		   
}

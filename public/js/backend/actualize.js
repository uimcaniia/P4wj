
//$(document).ready(function(){

	var regPsw  = /^(?=.*[A-Z])(?=.*[0-9]).{8,}$/; 

	$('#subPassword').change(function(){
		var value = $('#subPassword').val();
		if(value.length == 0)
		{
			$('#changePsw p em').html('Veuillez saisir un email');
		}
		else if(!regPsw.test(value))
		{
			$('#changePsw p em').html('Le mot de passe n\'est pas assez sécurisé. Veuillez utiliser 8 caractères minimum avec au moins une majuscule et un chiffre');
		}
		else
		{
			$('#changePsw p em').html('');

		}
	});


	$('#validChangeMdp').click(function(){
			var valPsw = $('#subPassword').val(); 
			var valPswConfirm = $('#repassword').val();
			$.post('index.php?action=updateMdpUser', {valPsw:valPsw, valPswConfirm:valPswConfirm}, function(data){
				if(data == ''){
					$('#changePsw p em').html('La mise a jour a bien été effectuée.');
					//$(btnClose).fadeOut(0);
					$('#contentFormChangePsw').fadeOut(200);
					$('#contentFormChangePsw').delay(0).animate({'height':'0px'}, {'duration':200});
				}else{
					$('#changePsw p em').html(data);
				}
				return false;
			});
			
	});


//});

$(document).ready(function(){

	$('#validChangeMdp').click(function(){
			var valPsw = $('#password').val(); 
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


});

$(document).ready(function(){


var aElemCommentValid = document.querySelectorAll('#containtSpace button.fas.fa-check');  
var btnMajPseudo = aElemCommentValid[0];
var btnMajPsw = aElemCommentValid[1];

	$(btnMajPseudo).click(function(){
			var valPseudo = $('#pseudo').val(); 
			
			div = document.getElementById('contentFormChangePseudo');
			btnOpen = document.getElementById('spanChangePseudo');
			btnClose = document.querySelector('#contentFormChangePseudo .fa-times');

			$.post('sendActualize.php', {valPseudo:valPseudo}, function(data){
				if(data == valPseudo){
					$('#changePseudo p em').html(data);
					$(btnClose).fadeOut(0);
					$('btnOpen').fadeIn(200);

					$(div).fadeOut(200);
					$(div).delay(0).animate({'height':'0px'}, {'duration':200});
				}else{
					$('#changePseudo p em').html(data);
				}
			});
			return false;
	});


	$(btnMajPsw).click(function(){
			var valPsw = $('#password').val(); 
			var valPswConfirm = $('#repassword').val();
			
			div = document.getElementById('contentFormChangePsw');
			btnOpen = document.getElementById('spanChangePsw');
			btnClose = document.querySelector('#contentFormChangePsw .fa-times');
/*			console.log(valPsw);
			console.log(valPswConfirm);*/

			$.post('sendActualize.php', {valPsw:valPsw , valPswConfirm:valPswConfirm}, function(data){
				if(data == ''){
					$('#changePsw p em').html('La mise à jour à bien été effectuée');
					$(btnClose).fadeOut(0);

					$(div).fadeOut(200);
					$(div).delay(0).animate({'height':'0px'}, {'duration':200});
				}else{
					$('#changePsw p em').html(data);
				}
			});
			return false;
	});


});
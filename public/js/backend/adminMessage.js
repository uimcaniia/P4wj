
//action sur les bouton pour envoyer un message
	function animSendMessageUser(id, pseudo, idSender){
		
		$('#messageAdmin').fadeIn(600);
		$('#pseudoMessage').text(pseudo);

		$(document).on('click','#sendMess',function(){
		var sujet = $('#subjectMess').val();
		var txt = $('#textMess').val();

			$.post('sendAdminMessage.php', {sujet:sujet, pseudo:pseudo, txt:txt, id:id}, function(data){
				if(data == ""){
					$('#messageAdmin').html('<p>Votre message à bien été envoyé à '+pseudo+'.</p>');
					$('#messageAdmin').fadeOut(2000);
				}else{
					$('#alertMessage').text(data);
				}
				return false;
			});	
		});
		$('#annulMess').click(function(){
			$('#subjectMess').val('');
			$('#textMess').val('');
			$('#messageAdmin').fadeOut(500);
		});
	}


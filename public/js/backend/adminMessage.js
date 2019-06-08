//action sur les bouton pour envoyer un message
function animSendMessageUser(idReceive, pseudo, idSender){
	
	$('#messageAdmin').fadeIn(600);
	$('#pseudoMessage').html(' à '+pseudo);

	$('#sendMess').click(function(){
		//$('#sendMess').click('click','#sendMess',function(){
		var sujet = $('#subjectMess').val();
		var txt = $('#textMess').val();

		var txtClean = txt.replace(/ |\n|\r|\t/g, ''); //supprime espace, les tabulation et les saut de ligne pour ne garder que les caractère visible
		var sujetClean = sujet.replace(/ |\n|\r|\t/g, '');

		if((txtClean == '') || (sujetClean == '')){ 
			$('#alertMessage').text('Vous devez remplir les 2 champs pour envoyer le message');
		}else{
			$.post('index.php?action=sendMessage', {sujet:sujet, txt:txt, idReceive:idReceive}, function(data){
				$('#arrayMessageSend tbody').append(data);

				$('#messageAdmin').html('<p>Votre message à bien été envoyé à '+pseudo+'.</p>');
				$('#messageAdmin').fadeOut(2000);


				return false;
			});
		}
	});
}
//*********************************************************************
//action sur les bouton pour supprimer un message
function animDelMessage(idMessDel){
	$.post('index.php?action=deleteMessage', {idMessDel:idMessDel}, function(data){
		console.log(data);
	});
}

//*********************************************************************
//action sur le bouton pour fermer la zone de saisie du message
function closeMessageDiv(){
	$('#subjectMess').val('');
	$('#textMess').val('');
	$('#messageAdmin').fadeOut(600);

}



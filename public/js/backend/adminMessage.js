//action sur les bouton pour envoyer un message
/*function animSendMessageUser(idReceive, pseudo, idSender){
	$('#confirmSendMess').fadeIn(600);
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

				$('#confirmSendMess').html('<p>Votre message à bien été envoyé à '+pseudo+'.</p>');
				$('#confirmSendMess').delay(0).animate({'opacity': '10'}, {'duration' : 0});
				$('#confirmSendMess').delay(0).animate({'opacity': '0'}, {'duration' : 2000});
				$('#confirmSendMess').fadeOut(0).delay(2000);
				$('#subjectMess').val('');
				$('#textMess').val('');
				$('#messageAdmin').fadeOut(0);
				return false;
			});
		}
	});
}
//***************************************************************
function changeorderMessage(){
	$('#messReceiveOrderBydate').click(function(){
		var direction = $(this).attr('class');;
		if(direction == 'fas fa-angle-up'){
			$.post('index.php?action=changeorderMessageReceive', {idReceive: 'upDate'},function(data){
				$('#messReceiveOrderBydate').removeClass('fas fa-angle-up');
				$('#messReceiveOrderBydate').addClass('fas fa-angle-down');
				$('#arrayMessageReceive tbody').html(data);
				return false;
			});
		}if(direction == 'fas fa-angle-down' ){
			$.post('index.php?action=changeorderMessageReceive', {idReceive: 'downDate'},function(data){
				console.log(data);
				$('#messReceiveOrderBydate').removeClass('fas fa-angle-down');
				$('#messReceiveOrderBydate').addClass('fas fa-angle-up');
				$('#arrayMessageReceive tbody').html(data);
				return false;
			});
		}

	});
	$('#messSendOrderBydate').click(function(){
		var direction = $(this).attr('class')
		if(direction == 'fas fa-angle-up'){
			$.post('index.php?action=changeorderMessageSend', {idReceive: 'upDate'},function(data){
				$('#messSendOrderBydate').removeClass('fas fa-angle-up');
				$('#messSendOrderBydate').addClass('fas fa-angle-down');
				$('#arrayMessageSend tbody').html(data);
				return false;
			});
		}if(direction == 'fas fa-angle-down' ){
			$.post('index.php?action=changeorderMessageSend', {idReceive: 'downDate'},function(data){
				$('#messSendOrderBydate').removeClass('fas fa-angle-down');
				$('#messSendOrderBydate').addClass('fas fa-angle-up');
				$('#arrayMessageSend tbody').html(data);
				
				return false;
			});
		}
	});
}
changeorderMessage();*/
//*********************************************************************
//action sur les bouton pour supprimer un message
/*function animDelMessage(idMessDel){
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
}*/
//*****************************************************************
//action pour récupérer et afficher les détails d'un compte utilisateur
//function givePseudoDetail(){
	$('#goSelectPseudoModerate').click(function(){

		$('#infoPseudoModerate').fadeIn(600);
		var idUser= $('#selectPseudoSignalModo').val(); 
			$.post('index.php?action=getInfoPseudo', {idUser:idUser}, function(data){

				$('#infoPseudoModerate').html(data);
				
			return false;
		});
	})
//}
//*******************************************************************
//action pour bloquer le compte d'un utilisateur
function deletePseudo(idUser){
	$('#confirmDeletePseudo').fadeIn(600);

	$('#confirmDeletePseudo span.fa-check').click(function(){
		$.post('index.php?action=delPseudo', {idUser:idUser}, function(data){
			$('#selectPseudoSignalModo > option[value = "'+idUser+'"').remove();
			$('#confirmDeletePseudo').fadeOut(600);
			return false;
		});
	});
}
function closeDeletePseudoDiv(){
	$('#confirmDeletePseudo').fadeOut(600);
}

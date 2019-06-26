
$(document).ready(function(){

	var aElemSignalIcone = document.querySelectorAll('div.commentSignal > span.fa-bell'); // array des icone signal des commentaires
	var aElemSignalIconeReply = document.querySelectorAll('div.replySignal > span.fa-bell'); // array des icone signal des commentaires
	var idEpisode =  $('#numEpisode').html();

//************************************************************************************
// action pour signaler un commentaire
	$(aElemSignalIcone).click(function(){
		var idDivComment = $(this).parents().attr('id'); // id de la div du commentaire signalé
		var pRefresh = document.querySelector('#'+idDivComment+' > p:nth-child(5)') // div p a rafraichir
		var idCommentSignal = $(this).attr('id'); // id du commentaire signalé
		var idUserSignal = this.className.split(' ')[2]; // id de l'utilisateur signalé

		$.post('index.php?action=signalComment', {idEpisode:idEpisode, idComment:idCommentSignal, idUserSignal:idUserSignal}, function(data){
			$(pRefresh).html('- Commentaire signalé !');
			$(this).fadeOut(200);
			return false;
		});
		
	});

//************************************************************************************
// action pour signaler une réponse
	$(aElemSignalIconeReply).click(function(){
		var idDivParent = $(this).parent().parent().prev().attr('id'); // id de la div parent du parent commentaire signalé
		var idComment = $(this).attr('id');
		var pRefresh = $(this).prev(); // div p a rafraichir

		var idReplySignal = $(this).attr('id'); // id de la réponse signalé
		var idUserReplySignal = this.className.split(' ')[2]; // id de l'utilisateur signalé

		$.post('index.php?action=signalComment', {idEpisode:idEpisode, idReply:idReplySignal , idComment:idComment, idUserSignal:idUserReplySignal}, function(data){
			$(pRefresh).html('- Réponse signalée !');
			$(this).fadeOut(200);
			return false;
		});
		popup = $(this).next();
		popupP = $(this).next().children();

		$(popup).delay(0).animate({'opacity': '10'}, {'duration' : 100});
		$(popup).delay(0).animate({'height':'20px'}, {'duration':500});
		$(popupP).delay(500).animate({'opacity': '10'}, {'duration' : 300});

		$(popupP).delay(1500).animate({'opacity': '0'}, {'duration' : 300});
		$(popup).delay(1800).animate({'height':'0px'}, {'duration':500});
		$(popup).delay(0).animate({'opacity': '0'}, {'duration' : 100});
		
	});

});
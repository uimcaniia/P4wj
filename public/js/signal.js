$(document).ready(function(){


var aElemSignalIcone = document.querySelectorAll('div.commentSignal > span.fa-bell'); // array des icone signal des commentaires
var aElemSignalIconeReply = document.querySelectorAll('div.replySignal > span.fa-bell'); // array des icone signal des commentaires
//console.log(aElemSignalIconeReply);

	$(aElemSignalIcone).click(function(){
		var idDivComment = $(this).parents().attr('id'); // id de la div du commentaire signalé
		//console.log(idDivComment);
		var pRefresh = document.querySelector('#'+idDivComment+' > p:nth-child(5)') // div p a rafraichir
		//console.log(pRefresh);
		var idCommentSignal = $(this).attr('id'); // id du commentaire signalé
		//console.log(idCommentSignal);
		var idUserSignal = this.className.split(' ')[2]; // id de l'utilisateur signalé
		//console.log(idUserSignal);
		//console.log(idCommentSignal);

		$.post('sendSignal.php', {idCommentSignal:idCommentSignal , idUserSignal:idUserSignal}, function(data){
			$(pRefresh).html('- Commentaire signalé !');
		});
		return false;
	});

	$(aElemSignalIconeReply).click(function(){
		var idDivComment = $(this).parents().attr('id'); // id de la div de la réponse signalé
		//console.log(idDivComment);
		var pRefresh = document.querySelector('#'+idDivComment+' > p:nth-child(5)') // div p a rafraichir
		//console.log(pRefresh);
		var idReplySignal = $(this).attr('id'); // id de la réponse signalé
		//console.log(idReplySignal);
		var idUserReplySignal = this.className.split(' ')[2]; // id de l'utilisateur signalé
		console.log(idUserReplySignal);
		//console.log(idCommentSignal);

		$.post('sendSignal.php', {idReplySignal:idReplySignal , idUserReplySignal:idUserReplySignal}, function(data){
			$(pRefresh).html('- Réponse signalé !');
		});
		return false;
	});

});

$(document).ready(function(){

//*************************************************************
//AJAX pour envoyer des commentaires aux épisodes

	$('#sendCommentEpisode').click(function(){
		
		var comment = $('#commentUserConnect').val(); 
		var idEpisode = $('#numEpisode').html();
		
		//div = document.getElementById('contentInputComment');
		btnOpen = document.querySelector('#headerComment .fa-pen-comment');
		btnClose = document.querySelector('#headerComment .fa-times');

		//var commentClean = comment.replace(/ |\n|\r|\t/g, ''); // on s'assure qu'il n'y ai pas un commentaire remplis d'espace blanc

			$.post('index.php?action=addComment', {comment:comment, idEpisode:idEpisode}, function(data){
				console.log(data);
				if(data == ""){
					$(btnClose).fadeOut(0);
					$(btnOpen).fadeIn(200);

					$('#contentInputComment').fadeOut(200);
					$('#contentInputComment').delay(0).animate({'height':'0px'}, {'duration':200});
				}else{
					var aData = JSON.parse(data);
					var d = new Date();
					var now = d.getDay()+'-'+d.getMonth()+'-'+d.getFullYear();
							//$resComment = '<div class="commentSignal"><p> De </p><p>'.$aLastCom[0]['pseudo'].'</p><p> le </p><p>'.strftime('%d-%m-%Y',strtotime($aLastCom[0]['commentTime'])).'</p></div><div class="comment"><p id="commentUserConnectSend">'.$aLastCom[0]['comment'].'</p></div>';

					var res = '<div class="commentSignal"><p> De </p><p>'+aData['pseudo']+'</p><p> le </p><p>'+aData['commentTime']+'</p></div><div class="comment"><p id="commentUserConnectSend">'+aData['comment']+'</p></div>';
					$(res).appendTo($('#globalComment'));
					$(btnClose).fadeOut(0);
					$(btnOpen).fadeIn(200);

					$('#contentInputComment').fadeOut(200);
					$('#contentInputComment').delay(0).animate({'height':'0px'}, {'duration':200});
				}
				return false;
			});
		
	});

});
	//*************************************************************
//AJAX pour répondre à des commentaires aux épisodes
function replyComment(idComment, reply, divClose, btn, divPushReply){

		var txtReply = $('#'+reply).val(); 
		var idEpisode = $('#numEpisode').html();

			$.post('index.php?action=addReply', {idComment:idComment, txtReply:txtReply, idEpisode:idEpisode}, function(data){
				//console.log(data);
				if(data ==""){ // si il n' y a pas de retour, c'est qu'il n'y avait pas de texte
					$('#'+btn).fadeIn(200);
					$('#'+divClose).fadeOut(200);
					$('#'+divClose).delay(0).animate({'height':'0px'}, {'duration':200});
				}else{
					
					var emptyDiv = $.trim($('#'+divPushReply+ ' + div.globalReply').text()); // on vérifie qu'il n'y ai rien dans la div
					var aData = JSON.parse(data);
					var d = new Date();
					var now = d.getDay()+'-'+d.getMonth()+'-'+d.getFullYear()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();

					var res = '<div id="replySignal" class="replySignal"><p> De </p><p>'+aData['pseudo']+'</p><p> le </p><p>'+now+'</p></div><div class="reply"><p>'+aData['reply']+'</p></div>';
					//console.log(res);
					if(emptyDiv = ''){

						$(res).appendTo($('#'+divPushReply+ ' + div.globalReply'));
						$('<p> Voir les réponses </p><div class="plusMoins"><span class="fas fa-plus" onclick="javascript:animCommentPlus(\''+divPushReply+'\')"></span><span class="fas fa-minus" onclick="javascript:animCommentMoins(\''+divPushReply+'\')"></span></div>').appendTo($('#'+divPushReply));
					
						$('#'+divPushReply+' div.plusMoins span.fa-plus').fadeOut(0);
						$('#'+divPushReply+' div.plusMoins span.fa-minus').fadeIn(0);
						$('#'+divPushReply+ ' + div.globalReply').fadeIn(200);
						$('#'+btn).fadeIn(200);
					}else{
						$(res).appendTo($('#'+divPushReply+ ' + div.globalReply'));
						$('#'+divPushReply+' div.plusMoins span.fa-plus').fadeOut(0);
						$('#'+divPushReply+' div.plusMoins span.fa-minus').fadeIn(0);
						$('#'+divPushReply+ ' + div.globalReply').fadeIn(200);
						$('#'+btn).fadeIn(200);
					}
					$('#'+divClose).fadeOut(200);
					$('#'+divClose).delay(0).animate({'height':'0px'}, {'duration':200});
					return false;
				}

			});
		//}

}
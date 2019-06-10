
$(document).ready(function(){

//*************************************************************
//AJAX pour envoyer des commentaires aux épisodes

	$('#sendCommentEpisode').click(function(){
		
		var comment = $('#commentUserConnect').val(); 
		var idEpisode = $('#numEpisode').html();
		
		div = document.getElementById('contentInputComment');
		btnOpen = document.querySelector('#headerComment .fa-pen-comment');
		btnClose = document.querySelector('#headerComment .fa-times');

		var commentClean = comment.replace(/ |\n|\r|\t/g, ''); // on s'assure qu'il n'y ai pas un commentaire remplis d'espace blanc
		if(commentClean == ''){
			$(btnClose).fadeOut(0);
			$(btnOpen).fadeIn(200);

			$(div).fadeOut(200);
			$(div).delay(0).animate({'height':'0px'}, {'duration':200});
		}else{
			$.post('index.php?action=addComment', {comment:comment, idEpisode:idEpisode}, function(data){
				$(data).appendTo($('#globalComment'));
				$(btnClose).fadeOut(0);
				$(btnOpen).fadeIn(200);

				$(div).fadeOut(200);
				$(div).delay(0).animate({'height':'0px'}, {'duration':200});
				return false;
			});
		}
	});

});
	//*************************************************************
//AJAX pour répondre à des commentaires aux épisodes
function replyComment(idComment, reply, divClose, btn, divPushReply){

		var txtReply = $('#'+reply).val(); 
		var idEpisode = $('#numEpisode').html();

		var replyClean = txtReply.replace(/ |\n|\r|\t/g, ''); // on s'assure qu'il n'y ai pas un commentaire remplis d'espace blanc
		if(replyClean == ''){
			$('#'+btn).fadeIn(200);
			$('#'+divClose).fadeOut(200);
			$('#'+divClose).delay(0).animate({'height':'0px'}, {'duration':200});
		}else{
			$.post('index.php?action=addReply', {idComment:idComment, txtReply:txtReply, idEpisode:idEpisode}, function(data){
				//console.log(data);
				var emptyDiv = $.trim($('#'+divPushReply+ ' + div.globalReply').text());
				if(emptyDiv == ''){
					$(data).appendTo($('#'+divPushReply+ ' + div.globalReply'));
					$('<p> Voir les réponses </p><div class="plusMoins"><span class="fas fa-plus" onclick="javascript:animCommentPlus(\''+divPushReply+'\')"></span><span class="fas fa-minus" onclick="javascript:animCommentMoins(\''+divPushReply+'\')"></span></div>').appendTo($('#'+divPushReply));
				
					$('#'+divPushReply+' div.plusMoins span.fa-plus').fadeOut(0);
					$('#'+divPushReply+' div.plusMoins span.fa-minus').fadeIn(0);
					$('#'+divPushReply+ ' + div.globalReply').fadeIn(200);
					$('#'+btn).fadeIn(200);
				}else{
					$(data).appendTo($('#'+divPushReply+ ' + div.globalReply'));
					$('#'+divPushReply+' div.plusMoins span.fa-plus').fadeOut(0);
					$('#'+divPushReply+' div.plusMoins span.fa-minus').fadeIn(0);
					$('#'+divPushReply+ ' + div.globalReply').fadeIn(200);
					$('#'+btn).fadeIn(200);
				}
				$('#'+divClose).fadeOut(200);
				$('#'+divClose).delay(0).animate({'height':'0px'}, {'duration':200});
				return false;
			});
		}

}
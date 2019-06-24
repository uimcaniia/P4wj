
$(document).ready(function(){

//*************************************************************
//AJAX pour envoyer des commentaires aux épisodes
	$('#sendCommentEpisode').click(function(){
		
		var comment = $('#commentUserConnect').val(); 
		var idEpisode = $('#numEpisode').html();

		btnOpen = document.querySelector('#headerComment .fa-pen-comment');
		btnClose = document.querySelector('#headerComment .fa-times');

			$.post('index.php?action=addComment', {comment:comment, idEpisode:idEpisode}, function(data){
				if(data == ""){
					$(btnClose).fadeOut(0);
					$(btnOpen).fadeIn(200);

					$('#contentInputComment').fadeOut(200);
					$('#contentInputComment').delay(0).animate({'height':'0px'}, {'duration':200});
				}else{
					var aData = JSON.parse(data);
					var d = new Date();
					var now = d.getDay()+'-'+d.getMonth()+'-'+d.getFullYear();
					var res = '<div class="commentSignal"><p> De </p><p>'+aData['pseudo']+'</p></div><div class="comment"><p id="commentUserConnectSend">'+aData['comment']+'</p></div>';
					$(res).appendTo($('#globalComment'));
					$(btnClose).fadeOut(0);
					$(btnOpen).fadeIn(200);

					$('#contentInputComment').fadeOut(200);
					$('#contentInputComment').delay(0).animate({'height':'0px'}, {'duration':200});
				}
				return false;
			});
		
	});


//*************************************************************
//AJAX pour répondre à des commentaires aux épisodes
	var elemReplyComment = document.querySelectorAll('div.contentInputReply span.fa-check');

	$(elemReplyComment).click(function(){
		var classEleme = $(this).attr('class'); 
		idComment      = classEleme.split(' ')[2]; // on récup les paramètre dans la class du span cliqué
		reply          = classEleme.split(' ')[3];
		divClose       = classEleme.split(' ')[4];
		btn            = classEleme.split(' ')[5];
		divPushReply   = classEleme.split(' ')[6];

		var txtReply = $('#'+reply).val(); 
		var idEpisode = $('#numEpisode').html();

		$.post('index.php?action=addReply', {idComment:idComment, txtReply:txtReply, idEpisode:idEpisode}, function(data){
			if(data ==""){ // si il n' y a pas de retour, c'est qu'il n'y avait pas de texte
				$('#'+btn).fadeIn(200);
				$('#'+divClose).fadeOut(200);
				$('#'+divClose).delay(0).animate({'height':'0px'}, {'duration':200});
			}else{
				
				var emptyDiv = $.trim($('#'+divPushReply+ ' + div.globalReply').text()); // on vérifie qu'il n'y ai rien dans la div
				var aData = JSON.parse(data);
				var d = new Date();
				var now = d.getDay()+'-'+d.getMonth()+'-'+d.getFullYear()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();

				var res = '<div id="replySignal" class="replySignal"><p> De </p><p>'+aData['pseudo']+'</p></div><div class="reply"><p>'+aData['reply']+'</p></div>';
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
	});

});
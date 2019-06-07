


$(document).ready(function(){


var aElemCommentValid = document.querySelector('#globalComment div#contentInputComment form div.formComment div.formColumComment button.fas.fa-check');  //
	//console.log(aElemCommentValid);

	$(aElemCommentValid).click(function(){
		
		var valDivComment = $('#commentUserConnect').val(); 
		var pseudo = $('#pseudoComment').html();
		var date = $('#dateComment').html();
		var idUser = $('#idUserComment').html();
		var idEpisode = $('#numEpisode').html();
		
		div = document.getElementById('contentInputComment');
		btnOpen = document.querySelector('#headerComment .fa-pen-nib');
		btnClose = document.querySelector('#headerComment .fa-times');


/*console.log(valDivComment);
		console.log(pseudo);
		console.log(date);*/


		$.post('sendComment.php', {valDivComment:valDivComment, pseudo:pseudo, idUser:idUser, idEpisode:idEpisode}, function(data){
			$('<div class="commentSignal"><p> De </p><p>'+pseudo+'</p><p> le </p><p>'+date+'</p></div><div class="comment"><p id="commentUserConnectSend">'+data+'</p></div>').appendTo($('#globalComment'));
			$(btnClose).fadeOut(0);
			$(btnOpen).fadeIn(200);

			$(div).fadeOut(200);
			$(div).delay(0).animate({'height':'0px'}, {'duration':200});
		});
		return false;
	});


});
//Exécuter ce code avant tout les autres aboutira à la création de la méthode Array.isArray()si elle n'est pas nativement prise en charge par le navigateur.
if(!Array.isArray) {
  Array.isArray = function(arg) {
    return Object.prototype.toString.call(arg) === '[object Array]';
  };
}
//*****************************************************************
$(document).ready(function(){
//action sur le bouton sélectionner un episode pour afficher ses commentaires
	$('#goComByEp').click(function(){
		var valEpSelect= $('#selectCom').val(); 
		var valBddSelect = 'episode'; 
		var title = $('#selectCom option:selected').text();
		var div= 'arrayComment';
		var action = 'AdmComment';
		recupDataComment(action, valEpSelect, valBddSelect, title, div);
		return false;
	});
	//****************************************
	//action sur le bouton sélectionner un Pseudo pour afficher ses commentaires
	$('#goComByPs').click(function(){
		var valEpSelect= $('#selectPseudo').val(); 
		var valBddSelect = 'pseudo'; 
		var title = $('#selectPseudo option:selected').text();
		var div= 'arrayPseudo';
		var action = 'AdmComment';
		recupDataComment(action, valEpSelect, valBddSelect, title, div);
		return false;
	});
		//****************************************
	//action sur le bouton sélectionner un episode pour afficher ses commentaires signalés
	$('#goComSignByEp').click(function(){
		var valEpSelect= $('#selectComSignal').val(); 
		var valBddSelect = 'episodeSignal'; 
		var title = $('#selectComSignal option:selected').text();
		var div= 'arrayCommentSignal';
		var action = 'AdmCommentSignal';
		recupDataComment(action, valEpSelect, valBddSelect, title, div);
		return false;
	});
	//****************************************
	//action sur le bouton sélectionner un Pseudo pour afficher ses commentaires signalés
	$('#goComSignByPs').click(function(){
		var valEpSelect= $('#selectPseudoSignal').val(); 
		var valBddSelect = 'pseudoSignal'; 
		var title = $('#selectPseudoSignal option:selected').text();
		var div= 'arrayPseudoSignal';
		var action = 'AdmCommentSignal';
		recupDataComment(action, valEpSelect, valBddSelect, title, div);
		return false;
	});
	//****************************************
	function recupDataComment(action, valComSelect, colBdd, title, div){

		$.post('index.php?action='+action+'', {valComSelect:valComSelect, colBdd:colBdd}, function(donnee){
				
		$('#'+div).fadeIn(600);
		$('#'+div).html(donnee);

		if((colBdd == 'episode')||(colBdd == 'episodeSignal')){
			$('#'+div+' thead tr th').html(title);
		}
		if((colBdd == 'pseudo')||(colBdd == 'pseudoSignal')){
			$('#'+div+' thead tr').html('<th>'+title+'</th><th><span class="fas fa-envelope" onclick="animSendMessageUser(\''+valComSelect+'\',\''+title+'\');"></span></th><th></th>')
		}

		return false;		
	
		});
	}


});
//************************************************************************
	function delComAndRep(idComment, tableBdd, idReply, idUser, by){

		if(tableBdd == 'comment'){

			$('#confirmDeleteComment').fadeIn(600);
			$('#confirmDeleteComment span.fa-times').click(function(){
				closeDeleteCommentDiv();
			});
			$('#confirmDeleteComment span.fa-check').click(function(){

				$.post('index.php?action=delComment', {idComment:idComment, idUser:idUser}, function(donnee){					
					closeDeleteCommentDiv();
					if(by == 'byEpisode'){
						$('#goComSignByEp').click();
					}
					else{	
						$('#goComSignByPs').click();
					}
					return false;
				});
			});

		}if(tableBdd == 'reply'){
			$('#confirmDeleteCommentReply').fadeIn(600);
			$('#confirmDeleteComment span.fa-times').click(function(){
				closeDeleteCommentReplyDiv();
			});
			$('#confirmDeleteComment span.fa-check').click(function(){
				$.post('index.php?action=delCommentReply', {idReply:idReply, idUser:idUser}, function(donnee){
					closeDeleteCommentReplyDiv();
					if(by == 'byEpisode'){
						$('#goComSignByEp').click();
					}
					else{	
						$('#goComSignByPs').click();
					}
					return false;
				});
			});
		}
	}

	//*********************************************************************
	//action sur le bouton pour fermer la zone de confirmation de supprission de commentaire
	function closeDeleteCommentDiv(){
		$('#confirmDeleteComment').fadeOut(600);
	}
		//*********************************************************************
	//action sur le bouton pour fermer la zone de confirmation de supprission de commentaire et reponses
	function closeDeleteCommentReplyDiv(){
		$('#confirmDeleteCommentReply').fadeOut(600);
	}

//************************************************************************
	function removeSignal(idComment, tableBdd, idReply, idUser, by){

		if(tableBdd == 'comment'){

			$.post('index.php?action=removeSignalcomment', {idComment:idComment, idUser:idUser}, function(donnee){					
				if(by == 'byEpisode'){
					$('#goComSignByEp').click();
				}
				else{	
					$('#goComSignByPs').click();
				}
				return false;
			});


		}if(tableBdd == 'reply'){
			$.post('index.php?action=removeSignalReply', {idReply:idReply, idUser:idUser}, function(donnee){
				if(by == 'byEpisode'){
					$('#goComSignByEp').click();
				}
				else{	
					$('#goComSignByPs').click();
				}
				return false;
			});
		}
	}
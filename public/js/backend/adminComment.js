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
						//console.log(donnee);
			var aDonnee = JSON.parse(donnee);

			if(colBdd == 'pseudoSignal'){
				var resHead = '<thead><tr><th colspan = "4">'+title+'</th></tr></thead><tbody>';
				var resBody ='';
				for(var i = 0 ; i < aDonnee[0].length; i++){
					resBody = resBody+'<tr><td> Commentaire du '+aDonnee[0][i]['commentTime']+'</td><td> '+aDonnee[0][i]['comment']+'</td><td><span class="fas fa-times" onclick="delComAndRep(\''+aDonnee[0][i]['id']+'\',\'comment\',\'\',\''+aDonnee[0][i]['idUser']+'\',byPseudo);"></span></td><td><span class="fas fa-bell-slash" onclick="removeSignal(\''+aDonnee[0][i]['id']+'\',\'comment\',\'\',\''+aDonnee[0][i]['idUser']+'\',\'byPseudo\');"></span></td></td></tr>';
				}
				if (aDonnee[1].length != 0){
					for (var j = 0 ; j < aDonnee[1].length ; j++){
						resBody = resBody+'<tr><td> Réponse du '+aDonnee[1][j]['dateReply']+'</td><td> '+aDonnee[1][j]['reply']+'</td><td><span class="fas fa-times" onclick="delComAndRep(\''+aDonnee[1][j]['idcomment_reply']+'\',reply,\''+aDonnee[1][j]['id']+'\',\''+aDonnee[1][j]['iduser_reply']+'\',\'byPseudo\');"></span></td><td><span class="fas fa-bell-slash" onclick="removeSignal(\''+aDonnee[1][j]['idcomment_reply']+'\',\'reply\',\''+aDonnee[1][j]['id']+','+aDonnee[1][j]['iduser_reply']+'\',\'byPseudo\');"></span></td></tr>';
					}
				}
				resComm = resHead+resBody+'</tbody>';
			}
			if(colBdd == 'episodeSignal'){
				var resHead = '<thead><tr><th colspan = "5">'+title+'</th></tr></thead><tbody>';
				var resBody ='';

				for(var i = 0 ; i < aDonnee.length; i++){
					resBody = resBody+'<tr><td>Commentaire du '+aDonnee[i]['commentTime']+'</td><td> de '+aDonnee[i]['pseudo']+' : </td><td> '+aDonnee[i]['comment']+'</td><td><span class="fas fa-times" onclick="delComAndRep(\''+aDonnee[i]['id']+'\',\'comment\',\'\',\''+aDonnee[i]['idUser']+'\',\'byEpisode\');"></span></td><td><span class="fas fa-bell-slash" onclick="removeSignal(\''+aDonnee[i]['id']+'\',\'comment\',\'\',\''+aDonnee[i]['idUser']+'\',\'byEpisode\');"></span></td></tr>';
					for (var j = 0 ; j < aDonnee[i]['reply'].length ; j++){
						resBody = resBody+'<tr><td> Réponse le '+aDonnee[i]['reply'][j]['dateReply']+'</td><td> de '+aDonnee[i]['reply'][j]['pseudo']+' : </td><td> '+aDonnee[i]['reply'][j]['reply']+'</td><td><span class="fas fa-times" onclick="delComAndRep(\''+aDonnee[i]['id']+'\',\'reply\',\''+aDonnee[i]['reply'][j]['id']+'\',\''+aDonnee[i]['reply'][j]['iduser_reply']+'\',\'byEpisode\');"></span></td><td><span class="fas fa-bell-slash" onclick="removeSignal(\''+aDonnee[i]['id']+'\',\'reply\',\''+aDonnee[i]['reply'][j]['id']+'\',\''+aDonnee[i]['reply'][j]['iduser_reply']+'\',\'byEpisode\');"></span></td></tr>';	
					}
				}
				resComm = resHead+resBody+'</tbody>';
			}
			if(colBdd == 'pseudo'){
				var resHead = '<thead><tr><th colspan = "4">'+title+'</th></tr></thead><tbody>';
				var resBody ='';
				for(var i = 0 ; i < aDonnee[0].length; i++){
					resBody = resBody+'<tr><td> Commentaire du '+aDonnee[0][i]['commentTime']+'</td><td> '+aDonnee[0][i]['comment']+'</td></tr>';
				}
					if (aDonnee[1].length != 0){
						for (var j = 0 ; j < aDonnee[1].length ; j++){
							resBody = resBody+'<tr><td> Réponse du '+aDonnee[1][j]['dateReply']+'</td><td> '+aDonnee[1][j]['reply']+'</td></tr>';
						}
				}
				resComm = resHead+resBody+'</tbody>';
			}
			if(colBdd == 'episode'){
				var resHead = '<thead><tr><th colspan = "3">'+title+'</th></tr></thead><tbody>';
				var resBody ='';

				for(var i = 0 ; i < aDonnee.length; i++){
					resBody = resBody+'<tr><td> Le '+aDonnee[i]['commentTime']+'</td><td> de '+aDonnee[i]['pseudo']+' : </td><td> '+aDonnee[i]['comment']+'</td></tr>';
					for (var j = 0 ; j < aDonnee[i]['reply'].length ; j++){
						resBody = resBody+'<tr><td> Réponse le '+aDonnee[i]['reply'][j]['dateReply']+'</td><td> de '+aDonnee[i]['reply'][j]['pseudo']+' : </td><td> '+aDonnee[i]['reply'][j]['reply']+'</td></tr>';	
					}
				}
				resComm = resHead+resBody+'</tbody>';
}
	
			$('#'+div).fadeIn(600);
			$('#'+div).html(resComm);

			return false;		
	
		});
	}


});
//************************************************************************
	function delComAndRep(idComment, tableBdd, idReply, idUser, by){
//var elements = document.
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
			$('#delRepCom').click(function(){
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
			console.log(donnee);				
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
	
//Exécuter ce code avant tout les autres aboutira à la création de la méthode Array.isArray()si elle n'est pas nativement prise en charge par le navigateur.
if(!Array.isArray) {
  Array.isArray = function(arg) {
    return Object.prototype.toString.call(arg) === '[object Array]';
  };
}
//*****************************************************************


$(document).ready(function(){
	//****************************************
//action sur le bouton sélectionner un épisode à modifier
	$('#goEpModif').click(function(){
		console.log('ok');
		var valEpModif = $('#selectEpModif').val(); 
			
		recupData(valEpModif);
		return false;
	});

	function recupData(valEpModif){
index.php?action=connect
		//$.post('recupAdminEpisodeSelect.php', {valEpModif:valEpModif}, function(donnee){
		$.post('recupAdminEpisodeSelect.php', {valEpModif:valEpModif}, function(donnee){
			var aDonnee = donnee.split("`");
				$('#divModifSelectEp').fadeOut(0);
				$('#hideWriteEpisodeModif').fadeIn(300);

				var id = aDonnee[2];
				var title = aDonnee[0];
				var txt = aDonnee[1];
				$('#blockWriteIdEpModif').html(id);
				$('#blockWriteTitleEpisodeModif').html(title);
				$('#blockWriteEpisodeModif').html(txt);
		})
	}
			//****************************************
//action sur le bouton sauvegarder un épisode Modifier
	$('#saveModif').click(function(){
		var titleModifEp = $('#blockWriteTitleEpisodeModif').text(); // on récupère les données dans le titre de la zone d'édition
		var texteModifEp = $('#blockWriteEpisodeModif').text(); //idem pour la zone de texte
		var idmodifEp = $('#blockWriteIdEpModif').text(); //idem pour l'id
		var idModifEpClean = idmodifEp.replace(/ |\n|\r|\t/g, '');

		Number(idModifEpClean);
		$.post('sendAdminEpisode.php', {updateTitleModifEp:titleModifEp, updateTexteModifEp:texteModifEp, idModifEpClean:idModifEpClean}, function(dataSavemodif){  // MAJ des données dans la BDD
			//$('#EpisodeWork').html(dataSavemodif);
			$('#containtEpisodeAdminModif > p:nth-child(2)').fadeIn(0);
			$('#containtEpisodeAdminModif > p:nth-child(2)').html(' - La sauvegarde de l\'épisode a bien été effectuée.');
			$('#containtEpisodeAdminModif > p:nth-child(2)').fadeOut(5000); 
			return false;
		});
			
		
	});

	//****************************************
//action sur le bouton sélectionner un épisode à modifier
	$('#goEpDel').click(function(){
		var valEpDel = $('#selectEpDel').val(); 
		console.log(valEpDel);
		$.post('sendAdminEpisode.php', {valEpDel:valEpDel}, function(donnee){
			//recupData(valEpDel);
			$("#containGlobalAdmin").html(donnee);
			return false;
		});
	});
//***************************************************
//recupère l'id du dernier episode de la bdd
	function recupIdEdit(){

		$.post('recupAdminEpisodeEdit.php', {}, function(donnee){
			$('#blockWriteIdEp').html(donnee);
		})
	}
		//****************************************
//action sur le bouton sauvegarder un épisode editer
	$('#saveEdit').click(function(){
		var titleNewEp = $('#blockWriteTitleEpisode').text(); // on vérifie si il y a des données dans le titre de la zone d'édition
		var texteNewEp = $('#blockWriteEpisode').text(); //idem pour la zone de texte
		var idNewEp = $('#blockWriteIdEp').text(); //idem pour la zone de texte 

		var titleNewEpClean = titleNewEp.replace(/ |\n|\r|\t/g, ''); //supprime espace, les tabulation et les saut de ligne pour ne garder que les caractère visible
		var texteNewEpClean = texteNewEp.replace(/ |\n|\r|\t/g, '');
		var idNewEpClean = idNewEp.replace(/ |\n|\r|\t/g, '');

		if((titleNewEpClean == '') && (texteNewEpClean == '')){ 
			console.log('rien');
		}
		if((titleNewEpClean != '') || (texteNewEpClean != '')){ 
			if(idNewEpClean == ""){
				$.post('sendAdminEpisode.php', {titleNewEp:titleNewEp, texteNewEp:texteNewEp}, function(dataSave){ // on sauvegarde
					//$('#EpisodeWork').html(dataSave);
					recupIdEdit();
					$('#quitEdit').fadeIn(100);
					$('#blockWriteIdEp').after('<p> - La création et la sauvegarde de l\'épisode a bien été effectuée.</p>');
					$('#containtEpisodeAdmin > p:nth-child(2)').fadeOut(5000);	
					return false;				
				});
				
			}else{
				Number(idNewEpClean);
				$.post('sendAdminEpisode.php', {updateTitleNewEp:titleNewEp, updateTexteNewEp:texteNewEp, idNewEpClean:idNewEpClean}, function(dataSavemodif){  // MAJ des données dans la BDD
					//$('#EpisodeWork').html(dataSavemodif);
					$('#containtEpisodeAdmin > p:nth-child(2)').fadeIn(0);
					$('#containtEpisodeAdmin > p:nth-child(2)').html(' - La sauvegarde de l\'épisode a bien été effectuée.');
					$('#containtEpisodeAdmin > p:nth-child(2)').fadeOut(5000); 
					return false;
				});
			}
		}
	});
		//****************************************
//action sur le bouton Quitter un épisode editer
	$('#quitEdit').click(function(){
		var titleNewEp = $('#blockWriteTitleEpisode').text(); // on vérifie si il y a des données dans le titre de la zone d'édition
		var texteNewEp = $('#blockWriteEpisode').text(); //idem pour la zone de texte
		var idNewEp = $('#blockWriteIdEp').text(); //idem pour l'id' 

		var titleNewEpClean = titleNewEp.replace(/ |\n|\r|\t/g, ''); //supprime espace, les tabulation et les saut de ligne pour ne garder que les caractère visible
		var texteNewEpClean = texteNewEp.replace(/ |\n|\r|\t/g, '');
		var idNewEpClean = idNewEp.replace(/ |\n|\r|\t/g, '');

		Number(idNewEpClean); // on sauvegarde et on vide les champs
		$.post('sendAdminEpisode.php', {updateTitleNewEp:titleNewEp, updateTexteNewEp:texteNewEp, idNewEpClean:idNewEpClean}, function(dataSavemodif){  // MAJ des données dans la BDD
			$('#blockWriteTitleEpisode').empty();
			$('#blockWriteEpisode').empty();
			$('#blockWriteIdEp').empty();
			return false;
		});
			
		
	});


//*****************************************************************
//compare les entrée de la BDD et celles du texte présenté
	function compareDataBdd(aDataEpisodeCompare){
		$.post('recupAdminEpisode.php', {titleNewEp:titleNewEp, texteNewEp:texteNewEp, IdNewEpClean:IdNewEpClean}, function(donnee){
				var aDonnee = donnee.split("`");
				if((aDonnee[0] == aDataEpisodeCompare[0]) && (aDonnee[1] == aDataEpisodeCompare[1]) && (aDonnee[2] == aDataEpisodeCompare[2])){
					return true;
				}else{
					return false;
				}
		});
	}


	//setInterval(recupData,1000);
});
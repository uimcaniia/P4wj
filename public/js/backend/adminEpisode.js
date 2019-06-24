//Exécuter ce code avant tout les autres aboutira à la création de la méthode Array.isArray()si elle n'est pas nativement prise en charge par le navigateur.
if(!Array.isArray) {
  Array.isArray = function(arg) {
    return Object.prototype.toString.call(arg) === '[object Array]';
  };
}

//****************************************
//action sur le bouton sélectionner un épisode à supprimer
$('#goEpDel').click(function(){
	$('#confirmDeleteEpisode').fadeIn(600); // ouverture de la div pour demander confirmation
	$('#confirmDeleteEpisode span.fa-times').click(function(){
		$('#confirmDeleteEpisode').fadeOut(600);
	});
	$('#confirmDeleteEpisode span.fa-check').click(function(){
		var valEpDelet = $('#selectEpDel').val(); 
		$.post('index.php?action=delEpModif', {valEpDelet:valEpDelet}, function(donnee){
			$('#selectEpDel > option[value = "'+valEpDelet+'"').remove(); // maj des input select de toutes les parties
			$('#selectEpModif > option[value = "'+valEpDelet+'"').remove();
			$('#selectCom > option[value = "'+valEpDelet+'"').remove();
			$('#selectComSignal > option[value = "'+valEpDelet+'"').remove();
			$('#confirmDeleteEpisode').fadeOut(600);
			return false;
		});
	});
});


//********************************************************
// action sur le bouton pour sauvegarder un épisode
$('#saveEdit').click( function(){
	tinyMCE.triggerSave(true, true);
	var id= $('#blockWriteIdEp').text();
	idClean = id.replace(/ |\n|\r|\t/g, '');

	if(idClean == ''){
		var txtEpisode = $('#blockWriteEpisode textarea').val();
		var titleEpisode = $('#blockWriteTitleEpisode').val();
		if((titleEpisode.length == 0)||(titleEpisode == "Votre titre")){
			$('#containtEpisodeAdmin > p:nth-child(2)').fadeIn(600);
			$('#containtEpisodeAdmin > p:nth-child(2)').text('Votre épisode n\'a pas de titre.')
			$('#containtEpisodeAdmin > p:nth-child(2)').delay(2000).fadeOut(1000);
		}
		else{
			$.post('index.php?action=saveNewEpisode', {txtEpisode:txtEpisode, titleEpisode:titleEpisode}, function(donnee){			
				$('<p>'+donnee+'</p>').appendTo('#blockWriteIdEp');
				$('#containtEpisodeAdmin > p:nth-child(2)').fadeIn(600);
				$('#containtEpisodeAdmin > p:nth-child(2)').text('La création et la sauvegarde a bien été effectuée.')
				$('#containtEpisodeAdmin > p:nth-child(2)').delay(2000).fadeOut(1000);
				return false;
			});
		}
	}else{

		var res = $('#tinymce').text();
		var txtEpisode = $('#blockWriteEpisode textarea').val();
		var titleEpisode = $('#blockWriteTitleEpisode').val();
		idEpisode = $('#blockWriteIdEp p').text();
		$.post('index.php?action=saveEpisode', {txtEpisode:txtEpisode, titleEpisode:titleEpisode, idEpisode:idEpisode}, function(donnee){			
			$('#containtEpisodeAdmin > p:nth-child(2)').fadeIn(600);
			$('#containtEpisodeAdmin > p:nth-child(2)').text('La sauvegarde a bien été effectuée.');
			$('#containtEpisodeAdmin > p:nth-child(2)').delay(2000).fadeOut(1000);
				return false;
		});
	}
});
//********************************************
$('#quitEdit').click(function(){
	$('#blockWriteTitleEpisode').val('');
	$('#blockWriteIdEp').empty();
	var tiny= 'blockWriteEpisode';
	tinymce.get(tiny).setContent('');
	$('#showEdit').fadeIn();
})
//****************************************
$('#showEdit').click( function(){
	tinyMCE.triggerSave(true, true);
	var txtEpisode = $('#blockWriteEpisode textarea').val();
	var titleEpisode = $('#blockWriteTitleEpisode').val();
	$('#confirmPublishEpisode').fadeIn(600); // on demande confirmation

	$('#closePublishConfirm').click(function(){
		$('#confirmPublishEpisode').fadeOut(600);
	});

	$('#publishEp').click(function(){
		var id= $('#blockWriteIdEp').text();
		idClean = id.replace(/ |\n|\r|\t/g, '');
		if(idClean == ''){ // si il n'y a pas d'id, c'est que l'épisode n'existe pas en bdd, du coup on sauvegarde avant
			$.post('index.php?action=saveNewEpisode', {txtEpisode:txtEpisode, titleEpisode:titleEpisode}, function(donnee){	
				$('#blockWriteIdEp').html('<p>'+donnee+'</p>');
				$.post('index.php?action=publishEpisode', {idEpisode:donnee}, function(donnee){	
					$('#containtEpisodeAdmin > p:nth-child(2)').fadeIn(600);	
					$('#containtEpisodeAdmin > p:nth-child(2)').text('La publication a bien été effectuée.')
					$('#containtEpisodeAdmin > p:nth-child(2)').delay(2000).fadeOut(1000);
					$('#showEdit').fadeOut(0);
					return false;
				});
				return false;
			});
		$('#publishEp').unbind('click');
			$('#confirmPublishEpisode').fadeOut(600);
		}else{
			idEpisode = $('#blockWriteIdEp p').text();
			$.post('index.php?action=publishEpisode', {idEpisode:id}, function(donnee){	
				$('#containtEpisodeAdmin > p:nth-child(2)').fadeIn(600);
				$('#containtEpisodeAdmin > p:nth-child(2)').text('La publication a bien été effectuée.')
				$('#containtEpisodeAdmin > p:nth-child(2)').delay(2000).fadeOut(1000);
				return false;
			});
			$('#confirmPublishEpisode').fadeOut(600);
			$('#showEdit').fadeOut(0);
		}
	});
});

//********************************************
//action sur le bouton sélectionner un épisode à modifier
$('#goEpModif').click(function(){
	$('#divModifSelectEp').fadeOut(0);
	$('#hideWriteEpisodeModif').fadeIn(300);
	$('#containtEpisodeAdminModif > div:nth-child(4) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > button:nth-child(1)').fadeOut(0);

	$('#blockWriteIdEpModif').empty();
	var valEpModif = $('#selectEpModif').val(); 	
	$.post('index.php?action=selEpModif', {valEpModif:valEpModif}, function(donnee){
		var aDonnee = JSON.parse(donnee);

		var id = aDonnee[0]['id'];
		var title = aDonnee[0]['title'];
		var txt = aDonnee[0]['episode'];
		var publish = aDonnee[0]['showEpisode'];
		$('<p>'+id+'</p>').appendTo('#blockWriteIdEpModif');
		if(publish == 0){
			$('#PublishModif').fadeIn(0);
		}else{
			$('#PublishModif').fadeOut(0);
		}
		document.getElementById("blockWriteTitleEpisodeModif").value=title;
		tinyMCE.get('blockWriteEpisodeModif').setContent(txt) ;
		$('#PublishModif').click(function(){
			tinyMCE.triggerSave(true, true);
			var txtEpisode = $('#blockWriteEpisodeModif textarea').val();
			var titleEpisode = $('#blockWriteTitleEpisodeModif').val();
			var id= $('#blockWriteIdEpModif p').text();
			idEpisode = id.replace(/ |\n|\r|\t/g, '');
			$.post('index.php?action=saveEpisode', {txtEpisode:txtEpisode, titleEpisode:titleEpisode, idEpisode:idEpisode}, function(donnee){			
				$.post('index.php?action=publishEpisode', {idEpisode:idEpisode}, function(donnee){	
					console.log(donnee);

				$('#containtEpisodeAdminModif > p:nth-child(2)').fadeIn(600);
				$('#containtEpisodeAdminModif > p:nth-child(2)').text('La publication a bien été effectuée.')
				$('#containtEpisodeAdminModif > p:nth-child(2)').delay(2000).fadeOut(1000);
					return false;
				});

			$('#confirmPublishEpisode').fadeOut(600);
			$('#PublishModif').fadeOut(0);
			return false;
			});
		})
	});
});

//****************************************
//action sur le bouton sauvegarder un épisode Modifier
$('#saveModif').click(function(){
	tinyMCE.triggerSave(true, true);
	var txtEpisode = $('#blockWriteEpisodeModif textarea').val();
	var titleEpisode = $('#blockWriteTitleEpisodeModif').val();
	var id= $('#blockWriteIdEpModif p').text();
	idEpisode = id.replace(/ |\n|\r|\t/g, '');

	$.post('index.php?action=saveEpisode', {txtEpisode:txtEpisode, titleEpisode:titleEpisode, idEpisode:idEpisode}, function(donnee){					
		$('#containtEpisodeAdminModif > p:nth-child(2)').fadeIn(600);
		$('#containtEpisodeAdminModif > p:nth-child(2)').text('La sauvegarde a bien été effectuée.')
		$('#containtEpisodeAdminModif > p:nth-child(2)').delay(2000).fadeOut(1000);
			return false;
	});
			
});




//*****************************************************************
//action pour récupérer et afficher les détails d'un compte utilisateur
//function givePseudoDetail(){
	$('#goSelectPseudoModerate').click(function(){

		$('#infoPseudoModerate').fadeIn(600);
		var idUser= $('#selectPseudoSignalModo').val(); 
			$.post('index.php?action=getInfoPseudo', {idUser:idUser}, function(data){
				var aData = JSON.parse(data);
				var res = '<p id="'+aData['id']+'">Pseudo : '+aData['pseudo']+'</p></p><p>Ce lecteur à posté '+aData['comment']+' commentaire dont '+aData['reporting']+' ont été signalé(s)</p><p>Il est inscrit depuis le '+aData['inscription']+'</p><div class="flexRow"><p>Voulez-vous bloquer ce lecteur?</p><span id="goDeletPseudoModerate" class="fas fa-user-slash" onclick="deletePseudo(\''+aData['id']+'\');"></span>';
				$('#infoPseudoModerate').html(res);

			return false;
		});
	})
//}
//*******************************************************************
//action pour bloquer le compte d'un utilisateur
function deletePseudo(idUser){
	$('#confirmDeletePseudo').fadeIn(600);

	$('#closeDeletePseudoDiv').click(function(){
		$('#confirmDeletePseudo').fadeOut(600);
	});

	$('#confirmDeletePseudo span.fa-check').click(function(){
		$.post('index.php?action=delPseudo', {idUser:idUser}, function(data){
			$('#selectPseudoSignalModo > option[value = "'+idUser+'"').remove();
			$('#confirmDeletePseudo').fadeOut(600);
			return false;
		});
	});
}

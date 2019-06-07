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
		var div= $('#arrayComment');
		recupDataComment(valEpSelect, valBddSelect, title, div);
		return false;
	});
	//****************************************
	//action sur le bouton sélectionner un Pseudo pour afficher ses commentaires
	$('#goComByPs').click(function(){
		var valEpSelect= $('#selectPseudo').val(); 
		var valBddSelect = 'pseudo'; 
		var title = $('#selectPseudo option:selected').text();
		var div= $('#arrayPseudo');
		recupDataComment(valEpSelect, valBddSelect, title, div);
		return false;
	});
		//****************************************
	//action sur le bouton sélectionner un episode pour afficher ses commentaires signalés
	$('#goComSignByEp').click(function(){
		var valEpSelect= $('#selectComSignal').val(); 
		var valBddSelect = 'episodeSignal'; 
		var title = $('#selectComSignal option:selected').text();
		var div= $('#arrayCommentSignal');
		recupDataComment(valEpSelect, valBddSelect, title, div);
		return false;
	});
	//****************************************
	//action sur le bouton sélectionner un Pseudo pour afficher ses commentaires signalés
	$('#goComSignByPs').click(function(){
		var valEpSelect= $('#selectPseudoSignal').val(); 
		var valBddSelect = 'pseudoSignal'; 
		var title = $('#selectPseudoSignal option:selected').text();
		var div= $('#arrayPseudoSignal');
		recupDataComment(valEpSelect, valBddSelect, title, div);
		return false;
	});
	//****************************************
	function recupDataComment(valCommentSelect, valBddSelect, title, div){

		$.post('recupAdminCommentSelect.php', {valCommentSelect:valCommentSelect, valBddSelect:valBddSelect, title:title}, function(donnee){
		$(div).fadeIn(600);
		$(div).html(donnee);
		return false;		
	
		})
	}
			//****************************************

});
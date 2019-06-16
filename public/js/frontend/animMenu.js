 
 //************************************************************************************************
 //animation menu header
 function animMenu(){
	 var home = document.querySelector('#btnSpanMenuHeader .fa-home');
	 var open = document.querySelector('#btnSpanMenuHeader .fa-book-open');
	 var user = document.querySelector('#btnSpanMenuHeader .fa-user');

	 var one   = document.getElementById('one');
	 var two   = document.getElementById('two');
	 var three = document.getElementById('three');

	 var four  = document.getElementById('four');
	 var five  = document.getElementById('five');
	 var six   = document.getElementById('six');

	 var linkJean = document.querySelector('header:nth-child(1) > div:nth-child(1) > div:nth-child(1) > a:nth-child(1)');
	 var barre = document.querySelector('header div.blackLine hr');

	 fontsize = document.getElementById('linkBiography').offsetWidth;

	$(home).hover(function(){
		$(one).delay(0).animate({'opacity': '10'}, {'duration' : 800});
		$(four).delay(0).animate({'opacity':'10','height': '40px'}, {'duration':100});
		$(four).delay(0).animate({'width':'60px'}, {'duration':100});
	},function(){
		$(one).delay(0).animate({'opacity': '0'}, {'duration' : 100});
		$(four).delay(0).animate({'width':'0px'}, {'duration':100});
		$(four).delay(0).animate({'height': '0px'}, {'duration':100});
		$(four).delay(0).animate({'opacity': '0'}, {'duration':100});
	});

	$(open).hover(function(){
		$(two).delay(0).animate({'opacity': '10'}, {'duration' : 800});
		$(five).delay(0).animate({'opacity':'10','height': '40px'}, {'duration':100});
		$(five).delay(0).animate({'width':'60px'}, {'duration':100});
	},function(){
		$(two).delay(0).animate({'opacity': '0'}, {'duration' : 100});
		$(five).delay(0).animate({'width':'0px'}, {'duration':100});
		$(five).delay(0).animate({'height': '0px'}, {'duration':100});
		$(five).delay(0).animate({'opacity': '0'}, {'duration':100});
	});

	$(user).hover(function(){
		$(three).delay(0).animate({'opacity': '10'}, {'duration' : 800});
		$(six).delay(0).animate({'opacity':'10','height': '40px'}, {'duration':100});
		$(six).delay(0).animate({'width':'50px'}, {'duration':100});
	},function(){
		$(three).delay(0).animate({'opacity': '0'}, {'duration' : 100});
		$(six).delay(0).animate({'width':'0px'}, {'duration':100});
		$(six).delay(0).animate({'height': '0px'}, {'duration':100});
		$(six).delay(0).animate({'opacity': '0'}, {'duration':100});
	});

		fontsize = document.getElementById('linkBiography').offsetWidth;

	$(linkJean).hover(function(){
		if(fontsize == 120){
			$(barre).delay(0).animate({'opacity': '10'}, {'duration' : 100});
			$(barre).delay(0).animate({'opacity':'10','width': '100px'}, {'duration':200});
		}else{
			$(barre).delay(0).animate({'opacity': '10'}, {'duration' : 100});
			$(barre).delay(0).animate({'opacity':'10','width': '160px'}, {'duration':200});
		}

	},function(){
		$(barre).delay(0).animate({'opacity':'0','width': '0px'}, {'duration':100});
		$(barre).delay(0).animate({'opacity': '00'}, {'duration' : 100});
	});
}
animMenu();

function animConnectLogin(){
	fontsize = document.getElementById('linkBiography').offsetWidth;
	var icon = document.getElementById('linkConnect');
	var pseudo = $('#bienvenuePseudo').attr('class'); 
	var link = '<a href="index.php?action=space"> '+pseudo+'</a>';// $('#changePsw p em').html(
	//console.log(icon);
	fontsize = document.getElementById('linkBiography').offsetWidth;
	var classIcon = icon.className.split(' ')[1];
	if(classIcon == 'fa-power-off'){
		$('#bienvenuePseudo').html('Bonjour'+link);

	}else{
		if(fontsize != 120){
			$('#bienvenuePseudo').html('Vous n\'êtes pas connecté.');
		}else{

		}
	}
}
animConnectLogin();

//**************************************************************
//animation zone admin
$('#showNavEpisode').click(function(){
	$('#navEpisode').fadeIn(600);
	if($('#navComment').is(":visible")){ 
		$('#navComment').fadeOut(0);
	}
		if($('#navMessage').is(":visible")){ 
		$('#navMessage').fadeOut(0);
	}
});
//*********************************************************
$('#btnEditEp').click(function(){
	$('#hideWriteEpisode').fadeIn(600);
		$('#containtEpisodeAdmin > div:nth-child(4) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > button:nth-child(1)').fadeOut(0);
	if($('#divModifSelectEp').is(":visible")){ 
		$('#divModifSelectEp').fadeOut(0);
	}
	if($('#divDelSelectEp').is(":visible")){ 
		$('#divDelSelectEp').fadeOut(0);
	}
	if($('#hideWriteEpisodeModif').is(":visible")){ 
		$('#hideWriteEpisodeModif').fadeOut(0);
	}
});
//*********************************************************
$('#btnModifEp').click(function(){
	$('#divModifSelectEp').fadeIn(600);
	if($('#hideWriteEpisode').is(":visible")){ 
		$('#hideWriteEpisode').fadeOut(0);
	}
	if($('#divDelSelectEp').is(":visible")){ 
		$('#divDelSelectEp').fadeOut(0);
	}
});
//*********************************************************
$('#btnDelEp').click(function(){
	$('#divDelSelectEp').fadeIn(600);
	if($('#divModifSelectEp').is(":visible")){ 
		$('#divModifSelectEp').fadeOut(0);
	}
	if($('#hideWriteEpisode').is(":visible")){ 
		$('#hideWriteEpisode').fadeOut(0);
	}
	if($('#hideWriteEpisodeModif').is(":visible")){ 
		$('#hideWriteEpisodeModif').fadeOut(0);
	}
});
//**************************************************************************************
$('#showCommentDiv').click(function(){
	$('#navComment').fadeIn(600);
	if($('#navEpisode').is(":visible")){ 
		$('#navEpisode').fadeOut(0);
	}
	if($('#hideWriteEpisode').is(":visible")){ 
		$('#hideWriteEpisode').fadeOut(0);
	}
	if($('#hideWriteEpisodeModif').is(":visible")){ 
		$('#hideWriteEpisodeModif').fadeOut(0);
	}
	if($('#navMessage').is(":visible")){ 
		$('#navMessage').fadeOut(0);
	}
});
//**************************************************************************************
$('#btnselectCom').click(function(){
	$('#divSelectCom').fadeIn(600);
	if($('#divSelectComSignal').is(":visible")){ 
		$('#divSelectComSignal').fadeOut(0);
	}
	if($('#arrayPseudoSignal').is(":visible")){ 
		$('#arrayPseudoSignal').fadeOut(0);
	}
	if($('#arrayCommentSignal').is(":visible")){ 
		$('#arrayCommentSignal').fadeOut(0);
	}
});
//**************************************************************************************
$('#sortEp').click(function(){
	$('#selectSortComEp').fadeIn(600);
	if($('#selectSortComPs').is(":visible")){ 
		$('#selectSortComPs').fadeOut(0);
	}
	if($('#arrayPseudo').is(":visible")){ 
		$('#arrayPseudo').fadeOut(0);
	}
});
//**************************************************************************************
$('#sortPs').click(function(){
	$('#selectSortComPs').fadeIn(600);
	if($('#selectSortComEp').is(":visible")){ 
		$('#selectSortComEp').fadeOut(0);
	}
	if($('#arrayComment').is(":visible")){ 
		$('#arrayComment').fadeOut(0);
	}
});
//**************************************************************************************
$('#btnSelectComSign').click(function(){
	$('#divSelectComSignal').fadeIn(600);
	if($('#divSelectCom').is(":visible")){ 
		$('#divSelectCom').fadeOut(0);
	}
	if($('#arrayPseudo').is(":visible")){ 
		$('#arrayPseudo').fadeOut(0);
	}
	if($('#arrayComment').is(":visible")){ 
		$('#arrayComment').fadeOut(0);
	}
});
//**************************************************************************************
$('#sortEpRep').click(function(){
	$('#selectSortComSignEp').fadeIn(600);
	if($('#selectSortComSignPs').is(":visible")){ 
		$('#selectSortComSignPs').fadeOut(0);
	}
	if($('#arrayPseudoSignal').is(":visible")){ 
		$('#arrayPseudoSignal').fadeOut(0);
	}
});
//**************************************************************************************
$('#sortPsRep').click(function(){
	$('#selectSortComSignPs').fadeIn(600);
	if($('#selectSortComSignEp').is(":visible")){ 
		$('#selectSortComSignEp').fadeOut(0);
	}
	if($('#arrayCommentSignal').is(":visible")){ 
		$('#arrayCommentSignal').fadeOut(0);
	}
});
//**************************************************************************************
$('#showDivMess').click(function(){
	$('#navMessage').fadeIn(600);
	if($('#navEpisode').is(":visible")){ 
		$('#navEpisode').fadeOut(0);
	}
	if($('#hideWriteEpisode').is(":visible")){ 
		$('#hideWriteEpisode').fadeOut(0);
	}
		if($('#hideWriteEpisodeModif').is(":visible")){ 
		$('#hideWriteEpisodeModif').fadeOut(0);
	}
		if($('#navComment').is(":visible")){ 
		$('#navComment').fadeOut(0);
	}
});
//**************************************************************************************
$('#btnSelectPseudoSignModo').click(function(){
	$('#selectPseudoSignalModerate').fadeIn(600);
	if($('#arrayMessageReceive').is(":visible")){ 
		$('#arrayMessageReceive').fadeOut(0);
	}
	if($('#arrayMessageSend').is(":visible")){ 
		$('#arrayMessageSend').fadeOut(0);
	}
});
//**************************************************************************************
$('#btnArrMessReceive').click(function(){
	$('#arrayMessageReceive').fadeIn(600);
	if($('#arrayMessageSend').is(":visible")){ 
		$('#arrayMessageSend').fadeOut(0);
	}
	if($('#selectPseudoSignalModerate').is(":visible")){ 
		$('#selectPseudoSignalModerate').fadeOut(0);
	}
		if($('#infoPseudoModerate').is(":visible")){ 
		$('#infoPseudoModerate').fadeOut(0);
	}
});
//**************************************************************************************
$('#btnArrMessSend').click(function(){
	$('#arrayMessageSend').fadeIn(600);
	if($('#arrayMessageReceive').is(":visible")){ 
		$('#arrayMessageReceive').fadeOut(0);
	}
	if($('#selectPseudoSignalModerate').is(":visible")){ 
		$('#selectPseudoSignalModerate').fadeOut(0);
	}
		if($('#infoPseudoModerate').is(":visible")){ 
		$('#infoPseudoModerate').fadeOut(0);
	}
});
//**************************************************************************************
$('#spanChangePsw').click(function(){ //divGlobal, id
	div = document.getElementById('contentFormChangePsw');
	btnOpen = document.querySelector('#changePsw .fa-pen-comment');
	btnClose = document.querySelector('#changePsw .fa-times');

		$(btnOpen).fadeOut(0);
		$(btnClose).fadeIn(200);

		$(div).delay(0).animate({'height':'170px'}, {'duration':200});
		$(div).fadeIn(500);
});
//**************************************************************************************
$('#spanCloseChangePsw').click(function(){
		div = document.getElementById('contentFormChangePsw');
		btnOpen = document.querySelector('#changePsw .fa-pen-comment');
		btnClose = document.querySelector('#changePsw .fa-times');

		$(btnClose).fadeOut(0);
		$(btnOpen).fadeIn(200);

		$(div).fadeOut(200);
		$(div).delay(0).animate({'height':'0px'}, {'duration':200});
});
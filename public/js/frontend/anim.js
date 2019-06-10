

 //************************************************************************************************
 //animation commentaire  + -

function animCommentPlus($id){
	open = document.querySelector('#'+ $id+' .plusMoins .fa-plus-circle');
	close = document.querySelector('#'+ $id+' .plusMoins .fa-minus-circle');
	divFrere = document.querySelector('#'+ $id+' + .globalReply');

		$(open).fadeOut(200);
		$(close).fadeIn(200);
		$(divFrere).fadeIn(200);
}

function animCommentMoins($id){
	open = document.querySelector('#'+ $id+' .plusMoins .fa-plus-circle');
	close = document.querySelector('#'+ $id+' .plusMoins .fa-minus-circle');
	divFrere = document.querySelector('#'+ $id+' + .globalReply');

		$(close).fadeOut(200);
		$(open).fadeIn(200);
		$(divFrere).fadeOut(200);
}
//********************************************************
function animPopup($id){
	popup = document.querySelector('#'+ $id+' .popupSignal');
	popupP = document.querySelector('#'+ $id+' .popupSignal p');
	textSignal = document.querySelector('#'+ $id+' > p:nth-child(5)');

		$(popup).delay(0).animate({'opacity': '10'}, {'duration' : 100});
		$(popup).delay(0).animate({'height':'20px'}, {'duration':500});
		$(popupP).delay(500).animate({'opacity': '10'}, {'duration' : 300});

		$(popupP).delay(1500).animate({'opacity': '0'}, {'duration' : 300});
		$(popup).delay(1800).animate({'height':'0px'}, {'duration':500});
		$(popup).delay(0).animate({'opacity': '0'}, {'duration' : 100});
}

function animPopupReply(idDivGlobal, id){
	popup = document.querySelector('div#'+idDivGlobal+' + div.globalReply div#'+id+'.replySignal div.popupSignal');
	popupP = document.querySelector('div#'+idDivGlobal+' + div.globalReply div#'+id+'.replySignal div.popupSignal p');
/*	console.log(idDivGlobal);
	console.log(id);
	console.log(popup);
	console.log(popupP);*/

	$(popup).delay(0).animate({'opacity': '10'}, {'duration' : 100});
	$(popup).delay(0).animate({'height':'20px'}, {'duration':500});
	$(popupP).delay(500).animate({'opacity': '10'}, {'duration' : 300});

	$(popupP).delay(1500).animate({'opacity': '0'}, {'duration' : 300});
	$(popup).delay(1800).animate({'height':'0px'}, {'duration':500});
	$(popup).delay(0).animate({'opacity': '0'}, {'duration' : 100});
}
//********************************************************
function animDivWriteCommentOpen(divGlobal, id){

	div = document.getElementById(id);
	btnOpen = document.querySelector('#'+divGlobal+' .fa-pen-nib');
	btnClose = document.querySelector('#'+divGlobal+' .fa-times');

		$(btnOpen).fadeOut(0);
		$(btnClose).fadeIn(200);

		$(div).delay(0).animate({'height':'90px'}, {'duration':200});
		$(div).fadeIn(500);
}

function animDivWriteCommentClose(divGlobal, id){

		div = document.getElementById(id);
		btnOpen = document.querySelector('#'+divGlobal+' .fa-pen-nib');
		btnClose = document.querySelector('#'+divGlobal+' .fa-times');

		$(btnClose).fadeOut(0);
		$(btnOpen).fadeIn(200);

		$(div).fadeOut(200);
		$(div).delay(0).animate({'height':'0px'}, {'duration':200});
}
//********************************************************
function animDivWriteReplyOpen(id, open, close){
		$(open).fadeOut(0);
		$(close).fadeIn(200);

		$('#'+id).delay(0).animate({'height':'90px'}, {'duration':200});
		$('#'+id).fadeIn(500);
}

function animDivWriteReplyClose(id, open, close){
		$(close).fadeOut(100);
		$(open).fadeIn(200);

		$('#'+id).fadeOut(200);
		$('#'+id).delay(0).animate({'height':'0px'}, {'duration':200});
}

//********************************************************
function animDivWriteNewInfoOpen(divGlobal, id){

	div = document.getElementById(id);
	btnOpen = document.querySelector('#'+divGlobal+' .fa-pen-nib');
	btnClose = document.querySelector('#'+divGlobal+' .fa-times');

		$(btnOpen).fadeOut(0);
		$(btnClose).fadeIn(200);

		$(div).delay(0).animate({'height':'80px'}, {'duration':200});
		$(div).fadeIn(500);
}

function animDivWriteNewInfoClose(divGlobal, id){

		div = document.getElementById(id);
		btnOpen = document.querySelector('#'+divGlobal+' .fa-pen-nib');
		btnClose = document.querySelector('#'+divGlobal+' .fa-times');

		$(btnClose).fadeOut(0);
		$(btnOpen).fadeIn(200);

		$(div).fadeOut(200);
		$(div).delay(0).animate({'height':'0px'}, {'duration':200});
}


//********************************************************
function animShowAdminMenu(divShow, divHide){
	if (divHide == ""){
		$('#'+divShow).fadeIn(600);
	}else{
		$('#'+divShow).fadeIn(600);
		var aDivHide = divHide.split(",");

		for(var i = 0 ; i < aDivHide.length ; i++){
			if($('#'+aDivHide[i]).is(":visible")){ 
				$('#'+aDivHide[i]).fadeOut(0);
			}
		}	
	}


	
}
//*********************************************



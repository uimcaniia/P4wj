

 //************************************************************************************************
 //animation commentaire  + -
//function animCommentPlus(){
$(document).ready(function(){
//**********************************************************************
	//var div1 = document.getElementById('globalComment');
	var elemPlus = document.querySelectorAll('span.fa-plus');
	var elemMoins = document.querySelectorAll('span.fa-minus');

	$(elemPlus).click(function(){
		var classEleme = $(this).attr('class');
		id = classEleme.split(' ')[2];
	
		open = document.querySelector('#'+ id+' .plusMoins .fa-plus');
		close = document.querySelector('#'+ id+' .plusMoins .fa-minus');
		divFrere = document.querySelector('#'+ id+' + .globalReply');

		$(open).fadeOut(200);
		$(close).fadeIn(200);
		$(divFrere).fadeIn(200);
	});

	$(elemMoins).click(function(){
		var classEleme = $(this).attr('class');
		id = classEleme.split(' ')[2];

		open = document.querySelector('#'+ id+' .plusMoins .fa-plus');
		close = document.querySelector('#'+ id+' .plusMoins .fa-minus');
		divFrere = document.querySelector('#'+ id+' + .globalReply');

		$(close).fadeOut(200);
		$(open).fadeIn(200);
		$(divFrere).fadeOut(200);
	});
//**********************************************************************
//function animDivWriteReplyOpen(){
	//var div2 = document.getElementById('globalComment');
	var elemCommRepOpen = document.querySelectorAll('span.fa-comment.contentInputReply');
	var elemCommRepClose = document.querySelectorAll('span.fa-times.contentInputReply');

	$(elemCommRepOpen).click(function(){
		var classEleme = $(this).attr('class');
		id = classEleme.split(' ')[3];
		open = classEleme.split(' ')[4];

		$('#'+open).fadeOut(0);

		$('#'+id).delay(0).animate({'height':'90px'}, {'duration':200});
		$('#'+id).fadeIn(500);
	});

	$(elemCommRepClose).click(function(){
		var classEleme = $(this).attr('class');
		id = classEleme.split(' ')[3];
		close = classEleme.split(' ')[4];

		$('#'+close).fadeIn(100);

		$('#'+id).fadeOut(200);
		$('#'+id).delay(0).animate({'height':'0px'}, {'duration':200});
	});

//**********************************************************************
//function animPopup(){
	//var div3 = document.getElementById('globalComment');
	var elemCommSignal = document.querySelectorAll('div.commentSignal span.fa-bell');

	$(elemCommSignal).click(function(){
		var id = $(this).parent().attr('id');
		popup = document.querySelector('#'+ id+' .popupSignal');
		popupP = document.querySelector('#'+ id+' .popupSignal p');
		textSignal = document.querySelector('#'+ id+' > p:nth-child(5)');

		$(popup).delay(0).animate({'opacity': '10'}, {'duration' : 100});
		$(popup).delay(0).animate({'height':'20px'}, {'duration':500});
		$(popupP).delay(500).animate({'opacity': '10'}, {'duration' : 300});

		$(popupP).delay(1500).animate({'opacity': '0'}, {'duration' : 300});
		$(popup).delay(1800).animate({'height':'0px'}, {'duration':500});
		$(popup).delay(0).animate({'opacity': '0'}, {'duration' : 100});
	});


//********************************************************
//function animDivWriteCommentOpen(divGlobal, id){
	$('#btnOpenDivComment').click(function(){
		div = document.getElementById('contentInputComment');
		btnOpen = document.querySelector('#headerComment .fa-pen-comment');
		btnClose = document.querySelector('#headerComment .fa-times');

		$(btnOpen).fadeOut(0);
		$(btnClose).fadeIn(200);

		$(div).delay(0).animate({'height':'90px'}, {'duration':200});
		$(div).fadeIn(500);
	});

//function animDivWriteCommentClose(divGlobal, id){
	$('#btnCloseDivComment').click(function(){
		div = document.getElementById('contentInputComment');
		btnOpen = document.querySelector('#headerComment .fa-pen-comment');
		btnClose = document.querySelector('#headerComment .fa-times');

		$(btnClose).fadeOut(0);
		$(btnOpen).fadeIn(200);

		$(div).fadeOut(200);
		$(div).delay(0).animate({'height':'0px'}, {'duration':200});
	});
//********************************************************


});

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
//*********************************************************************





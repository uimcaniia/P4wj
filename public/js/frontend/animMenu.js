 
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

	$(linkJean).hover(function(){
		$(barre).delay(0).animate({'opacity': '10'}, {'duration' : 100});
		$(barre).delay(0).animate({'opacity':'10','width': '160px'}, {'duration':200});

	},function(){
		$(barre).delay(0).animate({'opacity':'0','width': '0px'}, {'duration':100});
		$(barre).delay(0).animate({'opacity': '00'}, {'duration' : 100});
	});
}
animMenu();

function animConnectLogin(){
	var icon = document.getElementById('linkConnect');
	var pseudo = $('#bienvenuePseudo').attr('class'); 
	var link = '<a href="index.php?action=space"> cliquez ici!</a>';// $('#changePsw p em').html(
	//console.log(icon);
	var classIcon = icon.className.split(' ')[1];
	if(classIcon == 'fa-power-off'){
		$('#bienvenuePseudo').html('Bonjour '+pseudo+' , pour accéder à votre compte, '+link);

	}else{
		$('#bienvenuePseudo').html('Vous n\'êtes pas connecté.');
	}
}
animConnectLogin();


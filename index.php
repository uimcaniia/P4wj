<?php
session_start();
require ('AutoLoad.php');
require('controller/backend.php');
require('controller/frontend.php');

try { 
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listLastEpisode') // si on veut les 4 derniers épisode de sortis
        {
            listLastEpisode(4);
        }
        elseif ($_GET['action'] == 'extractAllEpisode') // si on veut la liste complète des extraits des épisodes
        {
            extractAllEpisode();
        }
        elseif ($_GET['action'] == 'ShowEpisode') // si on veut un épisode au complet
        {
        	if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) // test si un id d'épisode est présent
        	{
            	showEpisode($_GET['idEpisode']); 
            }
			else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        //*******************************************************************************
        //ESPACE POUR CRER UN COMPTE OU SE CONNECTER
        elseif ($_GET['action'] == 'login') // si on veut se connecter ou créer son compte
        {
        	spaceConnect();
        }
	    elseif ($_GET['action'] == 'connect')
	    {
	    	if(isset($_POST['email']) && isset($_POST['psw']))
	    	{
	        	testErrorLog($_POST['email'], $_POST['psw']);
	        }
	        else
	        {
	        	throw new Exception('Aucun mail ou mdp envoyé');
	        }
		}
	    elseif ($_GET['action'] == 'registration')
        {
        	if(isset($_POST['email']) && isset($_POST['psw']) && isset($_POST['pseudo']) && isset($_POST['pswAgain']))
        	{
        		testErrorSubscribe($_POST['email'], $_POST['pseudo'], $_POST['psw'], $_POST['pswAgain']);
        	}
        	else
	        {
	        	throw new Exception('Aucun mail ou mdp envoyé');
	        }           	
        }

        
        //*******************************************************************************
        //ESPACE POUR SE DECONNECTER
        elseif ($_GET['action'] == 'disconnect') // si on veut se déconnecter de son compte
        {
            disconnect();
        }
        //*******************************************************************************
        //ESPACE CONNECTE UTILISATEUR ET ADMIN
        elseif ($_GET['action'] == 'space') // si on veut aller dans son espace.
        {
        	if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 0) // test id pour les utilisateur
        	{
        		//echo 'util';
            	space();
            }
            elseif(isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
            {
            	//echo'admin';
            	admin();
            }
            else{
				throw new Exception('Aucun compte n\'est trouvé');
			}
		}
        elseif ($_GET['action'] == 'showAllMessage')// si on veut voir les messages reçut
        {
        	if (isset($_SESSION['idUser']) && $_SESSION['idUser'] >= 0) 
    		{
    			showAllMessage($_SESSION['idUser']);
    		}
    		else
            {
                throw new Exception('Aucun identifiant d\'utilisateur envoyé');
            }
    	}
		elseif ($_GET['action'] == 'showAllMessageSend')// si utilisateur veut voir ses messages envoyés
		{
			if (isset($_SESSION['idUser']) && ($_SESSION['idUser']) >= 0) 
    		{
				showAllMessageSend($_SESSION['idUser']);
			}
		    else
            {
                throw new Exception('Aucun identifiant d\'utilisateur envoyé');
            }
        }
		elseif ($_GET['action'] == 'sendMessage')// si utilisateur veut envoyer un message
		{
			if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) 
    		{
				if (!empty($_GET['idRecipient'])) // si l'id du destinataire est pas vide
				{
					sendMessage($_SESSION['admin'], $_GET['idRecipient']);
				}
				else
				{
					throw new Exception('Aucun destinataire est trouvé');
				}
			}
			elseif (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 0) 
			{
				sendMessage($_SESSION['idUser'], 1); // l'utisateur ne peut contacter que l'admin
			}
			else
            {
                throw new Exception('Aucun identifiant d\'utilisateur envoyé');
            }
		}
		elseif ($_GET['action'] == 'deleteMessage')// si utilisateur veut supprimer un message
		{
			if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] >= 0) 
    		{
				if (!empty($_GET['idMess']))
				{
					deleteMessage($_GET['idMess']);
				}
				else
				{
					throw new Exception('Aucun identifiant du message est trouvé');
				}
			}
			else
            {
                throw new Exception('Aucun identifiant d\'utilisateur envoyé');
            }
        }
        elseif ($_GET['action'] == 'showCommentAdmin')// si l'admin veut voir tous les commentaires d'un épisode sur son interface
		{
			if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) 
			{
				if(isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0)
				{
					showCommentEpisode($_GET['idEpisode']);
				}
				elseif(isset($_GET['idseudo']) && $_GET['idseudo'] > 0) //tous les commentaires d'un pseudo
				{
					showCommentPseudo($_GET['idseudo']);
				}
				elseif(isset($_GET['idEpisodeSignal']) && $_GET['idEpisodeSignal'] > 0) //tous les commentaires signalés d'un épisode
				{
					showCommentCommentSignal($_GET['idEpisodeSignal']);
				}
				elseif(isset($_GET['idPseudoSignal']) && $_GET['idPseudoSignal'] > 0) //tous les commentaires d'un pseudo signalé
				{
					showCommentPseudoSignal($_GET['idPseudoSignal']);
				}
			}
        }

        elseif ($_GET['action'] == 'addEpisode')// si l'admin veut poster un épisode
		{
			if (isset($_GET['idUser']) && $_GET['idUser'] == 1) 
			{

			}
        }

	
        //*******************************************************************************
        //COMMENTAIRE AFFICHAGE 
        elseif($_GET['action'] == 'showComment') // si on veut voir les commentaires
        {
        	if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) // test si un id d'épisode est présent
        	{
		        if ($_GET['action'] == 'listNewComment') // si on veut les commentaires du plus récend au plus ancien
		        {
		        	listNewCommentEpisode($_GET['idEpisode']);
		        }
		        else
		        {
		        	listOldCommentEpisode($_GET['idEpisode']);
		        }
		    }
            else
            {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
	    }
        //*******************************************************************************
        // ENVOIE COMMENTAIRE 
        elseif ($_GET['action'] == 'addComment') // si on veut poster un commentaire
        {
            if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) // test id épisode
            {
            	if (isset($_SESSION['idUser']) && $_SESSION['idUser'] > 0) // test id utilisateur si connecté
            	{
            		if (!empty($_POST['comment'])) // test si le champs n'est pas vide
            		{
            			addComment($_GET['idEpisode'], $_SESSION['idUser'], $_POST['comment']);
            		}
            		else
            		{
                    	throw new Exception('Le commentaire est vide !');
                	}
            	}
            	else
            	{
            		throw new Exception('L\'utilisateur n\'est pas identifié !');
            	}
            }
            else
            {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        //*******************************************************************************
        // REPONSE COMMENTAIRE
        elseif ($_GET['action'] == 'addReply') // si on veut répondre à un commentaire
        {
            if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) // test id épisode
            {
            	if (isset($_GET['idComment']) && $_GET['idComment'] > 0) // test id épisode
            	{
	            	if (isset($_SESSION['idUser']) && $_SESSION['idUser'] > 0) // test id utilisateur
	            	{
	            		if (!empty($_POST['reply'])) // test si le champs n'est pas vide
	            		{
	            			addReply($_GET['idEpisode'], $_SESSION['idUser'], $_GET['idComment'], $_POST['reply']);
	            		}
	            		else
	            		{
	                    	throw new Exception('Le commentaire est vide !');
	                	}
	            	}
	            	else
	            	{
	            		throw new Exception('L\'utilisateur n\'est pas identifié !');
	            	}
	            }
            	else
            	{
            		throw new Exception('Aucun identifiant de commentaire envoyé!');
            	}
            }
            else
            {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        //*******************************************************************************
        // SIGNALER COMMENTAIRE
        elseif ($_GET['action'] == 'signalComment') // si on veut signaler un commentaire ou une réponse à un commentaire
        {
            if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) // test id épisode
            {
            	if (isset($_GET['idComment']) && $_GET['idComment'] > 0) // test id commentaire
            	{
            		signalComment($_GET['idEpisode'], $_GET['idComment']);

	            }
	            elseif ((isset($_GET['idReply']) && $_GET['idReply'] > 0) && (isset($_GET['idComment']) && $_GET['idComment'] > 0)) // test id commentaire et réponse
            	{
            		signalReply($_GET['idEpisode'], $_GET['idComment'], $_GET['idReply']);
	            }
            	else
            	{
            		throw new Exception('Aucun identifiant de commentaire envoyé!');
            	}
            }
            else
            {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        //*******************************************************************************
        // BIOGRAPHY
        elseif ($_GET['action'] == 'biography') // si on veut la liste complète des extraits des épisodes
        {
            biography();
        }




    }
    else {
        listLastEpisode(4);
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}

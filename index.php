<?php
session_start();
require ('AutoLoad.php');
require('controller/backend.php');
require('controller/frontend.php');

try { 
    if (isset($_GET['action'])) 
    {
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
		elseif ($_GET['action'] == 'sendMessage')// si utilisateur veut envoyer un message
		{
			if (isset($_SESSION['idUser']) && isset($_SESSION['idUser']) > 0) 
    		{
				if (isset($_POST['idReceive']) && isset($_POST['txt']) && isset($_POST['sujet']))
				{
					sendMessage($_SESSION['idUser'], $_POST['idReceive'], $_POST['sujet'], $_POST['txt']);
				}
				else
				{
					throw new Exception('Aucun destinataire est trouvé');
				}
            }
			else
            {
                throw new Exception('Aucun identifiant d\'utilisateur envoyé');
            }
		}
		elseif ($_GET['action'] == 'deleteMessage')// si utilisateur veut supprimer un message
		{
			if (isset($_POST['idMessDel']) && $_POST['idMessDel'] > 1 && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) 
    		{
				deleteMessage($_POST['idMessDel']);
			}
			else
            {
                throw new Exception('Vous ne pouvez pas réaliser la suppression du message');
            }
        }
        elseif ($_GET['action'] == 'changeorderMessageReceive')// si utilisateur veut changer le sens d'affichage des messages
        {
            if (isset($_SESSION['idUser']) && isset($_POST['idReceive']) && $_POST['idReceive'] == 'upDate') 
            {
                changeOrderMessage('receive', 'ASC', $_SESSION['idUser']);
            }
            elseif (isset($_SESSION['idUser']) && isset($_POST['idReceive']) && $_POST['idReceive'] == 'downDate') 
            {
                 changeOrderMessage('receive', 'DESC', $_SESSION['idUser']);
            }
            else
            {
                throw new Exception('Le sens d\'affichage n\'est pas disponible '.$_POST['idReceive'].'');
            }
        }
        elseif ($_GET['action'] == 'changeorderMessageSend')// si utilisateur veut changer le sens d'affichage des messages
        {
            if (isset($_SESSION['idUser']) && isset($_POST['idReceive']) && $_POST['idReceive'] == 'upDate') 
            {
                changeOrderMessage('send','ASC', $_SESSION['idUser']);
            }
            elseif (isset($_SESSION['idUser']) && isset($_POST['idReceive']) && $_POST['idReceive'] == 'downDate') 
            {
                 changeOrderMessage('send','DESC', $_SESSION['idUser']);
            }
            else
            {
                throw new Exception('Le sens d\'affichage n\'est pas disponible');
            }
        }

/*        elseif ($_GET['action'] == 'addEpisode')// si l'admin veut poster un épisode
        {
            if (isset($_GET['idUser']) && $_GET['idUser'] == 1) 
            {

            }
        }*/


/*        elseif ($_GET['action'] == 'selEpModif')// si l'admin veut selectionner un épisode pour le modifier sur son interface
		{
			if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) 
			{
				if(isset($_POST['valEpModif']) && $_POST['valEpModif'] > 0)
				{
					recupEpisodeSelect($_POST['valEpModif']);
				}
                else
                {
                    throw new Exception('Aucune sélection possible d\'épisode à modifier est trouvé');
                }
            }
        }*/
        elseif($_GET['action'] == 'delEpModif') // si l'admin veut supprimer un épisode sur son interface
        {
            if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) 
            {
                if(isset($_POST['valEpDelet']) && $_POST['valEpDelet'] > 0)
                {
                    delEpisodeSelect($_POST['valEpDelet']);
                }
                else
                {
                    throw new Exception('Aucune sélection possible d\'épisode à supprimer est trouvé');
                }
            }
        }
        elseif($_GET['action'] == 'AdmComment') // si l'admin veut voir tous les commentaires sur son interface
        {
            if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) 
            {
                if(isset($_POST['valComSelect']) && isset($_POST['colBdd']) && $_POST['colBdd'] == 'episode')
                {
                    commentEpisodeSelect($_POST['valComSelect']);
                }
                elseif(isset($_POST['valComSelect']) && isset($_POST['colBdd']) && $_POST['colBdd'] == 'pseudo') //tous les commentaires d'un pseudo
                {
                    commentPseudoSelect($_POST['valComSelect']);
                }
                else
                {
                    throw new Exception('Aucun selecteur est trouvé pour afficher les commentaires correspondant');
                }
            }
            else
            {
                throw new Exception('Vous n\'avez pas les autorisations requise pour voir les commentaires dans cette zone');
            }
        }
        elseif($_GET['action'] == 'AdmCommentSignal')
        {
            if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) 
            {
                if(isset($_POST['valComSelect']) && isset($_POST['colBdd']) && $_POST['colBdd'] == 'episodeSignal')
                {
                    commentSignalEpisodeSelect($_POST['valComSelect'], $_POST['colBdd']);
                }
                elseif(isset($_POST['valComSelect']) && isset($_POST['colBdd']) && $_POST['colBdd'] == 'pseudoSignal') //tous les commentaires d'un pseudo
                {
                    commentSignalPseudoSelect($_POST['valComSelect'], $_POST['colBdd']);
                }
                else
                {
                    throw new Exception('Aucun selecteur est trouvé pour afficher les commentaires signalés correspondant');
                }
            }
            else
            {
                throw new Exception('Vous n\'avez pas les autorisations requise pour voir les commentaires signalés dans cette zone');
            }
        }
        elseif($_GET['action'] == 'delComment') // si l'admin veut supprimer un commentaire signalés
        {
            if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) 
            {
                if(isset($_POST['idComment'])  && isset($_POST['idUser'])) // si commentaire, supprime commentaire + réponse
                {
                    deleteCommentReply($_POST['idComment'], $_POST['idUser']);
                }
                else
                {
                    throw new Exception('Aucun selecteur est trouvé pour supprimer le commentaire signalé');
                }
            }
            else
            {
                throw new Exception('vous n\'avez pas l\'autorisation necessaire pour supprimer le commentaire signalé');
            }
        }
        elseif($_GET['action'] == 'delCommentReply') // si l'admin veut supprimer un commentaire signalés et ses réponses
        {
            if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) 
            {
                if(isset($_POST['idReply']) && isset($_POST['idUser']))//si réponse, supprime que réponse signalé
                {
                    deleteReply($_POST['idReply'], $_POST['idUser']);
                }
                else
                {
                    throw new Exception('Aucun selecteur est trouvé pour supprimer la réponse signalée');
                }
            }
            else
            {
                throw new Exception('vous n\'avez pas l\'autorisation necessaire pour supprimer la réponse signalée');
            }
        }
        //**********************************************************
        //moderation signalement
        elseif($_GET['action'] == 'removeSignalcomment') // si l'admin veut supprimer un commentaire signalés
        {
            if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) 
            {
                if(isset($_POST['idComment'])  && isset($_POST['idUser'])) // si commentaire, supprime commentaire + réponse
                {
                    removeCommentSignal($_POST['idComment'], $_POST['idUser']);
                }
                else
                {
                    throw new Exception('Aucun selecteur est trouvé pour mettre a jour le commentaire signalé');
                }
            }
            else
            {
                throw new Exception('vous n\'avez pas l\'autorisation necessaire pour mettre a jour le commentaire signalé');
            }
        }
        elseif($_GET['action'] == 'removeSignalReply') // si l'admin veut supprimer un commentaire signalés et ses réponses
        {
            if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) 
            {
                if(isset($_POST['idReply']) && isset($_POST['idUser']))//si réponse, supprime que réponse signalé
                {
                    removeReplySignal($_POST['idReply'], $_POST['idUser']);
                }
                else
                {
                    throw new Exception('Aucun selecteur est trouvé pour mettre a jour la réponse signalée');
                }
            }
            else
            {
                throw new Exception('vous n\'avez pas l\'autorisation necessaire pour mettre a jour la réponse signalée');
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
            if (isset($_POST['idEpisode']) && $_POST['idEpisode'] > 0) // test id épisode
            {

            	if (isset($_SESSION['idUser']) && $_SESSION['idUser'] > 0) // test id utilisateur si connecté
            	{
            		if (!empty($_POST['comment'])) // test si le champs n'est pas vide
            		{
            			addComment($_POST['idEpisode'], $_SESSION['idUser'], $_POST['comment']);
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
            if (isset($_POST['idEpisode']) && $_POST['idEpisode'] > 0) // test id épisode
            {
            	if (isset($_POST['idComment']) && $_POST['idComment'] > 0) // test id épisode
            	{
	            	if (isset($_SESSION['idUser']) && $_SESSION['idUser'] > 0) // test id utilisateur
	            	{
	            		addReply($_POST['idEpisode'], $_SESSION['idUser'], $_POST['idComment'], $_POST['txtReply']);
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
            if (isset($_POST['idEpisode']) && $_POST['idEpisode'] > 0) // test id épisode
            {
                if (isset($_POST['idUserSignal']) && $_POST['idUserSignal'] > 0) // test id épisode
                {
                	if (!isset($_POST['idReply']) && isset($_POST['idComment']) && $_POST['idComment'] > 0) // test id commentaire
                	{
                		signalComment($_POST['idEpisode'], $_POST['idComment'], $_POST['idUserSignal']);

    	            }
    	            elseif ((isset($_POST['idReply']) && $_POST['idReply'] > 0) && (isset($_POST['idComment']) && $_POST['idComment'] > 0)) // test id commentaire et réponse
                	{
                		signalReply($_POST['idEpisode'], $_POST['idComment'], $_POST['idReply'], $_POST['idUserSignal']);
    	            }
                	else
                	{
                		throw new Exception('Aucun identifiant de commentaire envoyé!');
                	}
                }
                else
                {
                    throw new Exception('Aucun identifiant d\'utilisateur envoyé!');
                }
            }
            else
            {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        //*********************************************************************************
        // voir les infos d'un compte ayant des signalements
        elseif($_GET['action'] == 'getInfoPseudo') // si l'admin veut supprimer un utilisateur
        {
            if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) // on s'assure que c'est bien l'admin
            {
                if(isset($_POST['idUser']) && $_POST['idUser'] > 0 )//si réponse, supprime que réponse signalé
                {
                    getPseudoModerate($_POST['idUser']);
                }
                else
                {
                    throw new Exception('Aucun selecteur est trouvé pour afficher les indos du pseudo');
                }
            }
            else
            {
                throw new Exception('vous n\'avez pas l\'autorisation necessaire pour voir les infos de l\'utilisateur');
            }
        }
        //********************************************************************************
        //supprimer un utilisateur
        elseif($_GET['action'] == 'delPseudo') // si l'admin veut supprimer un utilisateur
        {
            if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) // on s'assure que c'est bien l'admin
            {
                if(isset($_POST['idUser']) && $_POST['idUser'] > 0 )//si réponse, supprime que réponse signalé
                {
                    deletePseudo($_POST['idUser']);
                }
                else
                {
                    throw new Exception('Aucun selecteur est trouvé pour supprimer le pseudo');
                }
            }
            else
            {
                throw new Exception('vous n\'avez pas l\'autorisation necessaire pour supprimer un utilisateur');
            }
        }
        //********************************************************************************
        //supprimer un utilisateur
        elseif($_GET['action'] == 'updateMdpUser') // si l'admin veut supprimer un utilisateur
        {
            if (isset($_SESSION['idUser']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 0) // on s'assure que c'est pas l'admin
            {
                if(isset($_POST['valPsw']) && isset($_POST['valPswConfirm']))//
                {
                    updatePswUser($_POST['valPsw'], $_POST['valPswConfirm'], $_SESSION['idUser']);
                }
                else
                {
                    throw new Exception('Aucun mot de passe est transmit');
                }
            }
            else
            {
                throw new Exception('vous n\'avez pas l\'autorisation necessaire pour changer le mot de passe');
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

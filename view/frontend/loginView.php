<?php $headTitle = 'Espace connexion'; ?>
<?php $titleH1 = 'Espace connexion'; ?>

<?php ob_start(); ?>

	<div id="containtLogin">

		<p class='alertConnect'><?= $alert?></p>
		<form method="post" action="index.php?action=connect">
			<div class="form">
				<fieldset>
					<legend> Vous avez déjà un compte ? </legend>
<?php
	$value = "";
	for ($i = 0 ; $i <= count($aInputLog)-1 ; $i++)
	{
		if (isset($_POST["connect"]) && isset($_POST['loginEmail']) && isset($_POST['psw']))
		{
			$value = $_POST[$aInputLog[$i]['name']];
		}
?>
					<label for="<?=$aInputLog[$i]['id_style']?>"></label>
					<input type ="<?=$aInputLog[$i]['type']?>" id ="<?=$aInputLog[$i]['id_style']?>" name ="<?=$aInputLog[$i]['name']?>" value="<?=$value?>" placeholder="<?=$aInputLog[$i]['placeholder']?>" contenteditable ="<?=$aInputLog[$i]['contenteditable']?>" autocomplete="off">
<?php
	}
?>
					<input type="submit" value='Se connecter' name='connect'>
				</fieldset>
			</div>
		</form>

		<p class='alertConnect'><?= $alertConnectionMail?></p>
		<p class='alertConnect'><?= $alertConnectionPsw?></p>
		<p class='alertConnect'><?= $alertConnectionPseudo?></p>
		<form method="post" action="index.php?action=registration">
			<div class="form">
				<fieldset>
					<legend> Créer votre compte <span class='fas fa-user'></span></legend>
<?php
	for ($j = 0 ; $j <= count($aInputSub)-1 ; $j++)
	{
			if (isset($_POST["registration"]) && isset($_POST['subEmail']) && isset($_POST['subPassword']) && isset($_POST['pseudo']))
		{
			$value = $_POST[$aInputSub[$j]['name']];
		}
		else
		{
			$value = "{$aInputSub[$j]['value']}";
		}
?>
					<p class='<?=$aInputSub[$j]['id_style']?>'></p>
					<input type ="<?=$aInputSub[$j]['type']?>" id ="<?=$aInputSub[$j]['id_style']?>" name ="<?=$aInputSub[$j]['name']?>" value="<?=$value?>" placeholder="<?=$aInputSub[$j]['placeholder']?>" contenteditable ="<?=$aInputSub[$j]['contenteditable']?>" autocomplete="off">
<?php
	}
?>
					<input type="submit" value="S'inscrire" name='registration'>
				</fieldset>
			</div>
		</form>
	</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>
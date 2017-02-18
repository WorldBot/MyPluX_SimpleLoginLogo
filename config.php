<?php if(!defined("PLX_ROOT")) exit; ?>
<?php 

# Control du token du formulaire
plxToken::validateFormToken($_POST);

if(!empty($_POST)) {
	$plxPlugin->setParam('login_logo', plxUtils::strCheck($_POST['thumbnail']), 'string');
	$plxPlugin->saveParams();
	header("Location: parametres_plugin.php?p=MyPluX_SimpleLoginLogo");
	exit;
}
?>
<form action="parametres_plugin.php?p=MyPluX_SimpleLoginLogo" method="post" style="font-size:16px;">
	<fieldset>
		<p class="field"><label><?php $plxPlugin->lang('L_SELECT_LOGIN_LOGO') ?> <a title="<?php $thumbnail=$plxPlugin->getParam("login_logo"); echo L_THUMBNAIL_SELECTION ?>" id="toggler_thumbnail" href="javascript:void(0)" onclick="mediasManager.openPopup('id_thumbnail', true)" style="outline:none; text-decoration: none"> +</a></label></p>
		<?php plxUtils::printInput('thumbnail',plxUtils::strCheck($thumbnail),'text','255-255',false,'full-width','','onkeyup="refreshImg(this.value)"'); ?>
	</fieldset>
	<fieldset>
		<p class="in-action-bar">
			<?php echo plxToken::getTokenPostMethod() ?>
			<input type="submit" name="submit" value="<?php $plxPlugin->lang('L_SAVE') ?>"/>
		</p>
	</fieldset>
</form>

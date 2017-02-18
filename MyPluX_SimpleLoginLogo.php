<?php
/**
 * Plugin MyPluX_SimpleLoginLogo
 *
 * @author	Yannic
 *
 **/
 
 class MyPluX_SimpleLoginLogo extends plxPlugin {
	 
	public function __construct($default_lang) {
		
		# appel du constructeur de la classe plxPlugin (obligatoire)
		parent::__construct($default_lang);

		# droits pour accéder à la page config.php du plugin
		$this->setConfigProfil(PROFIL_ADMIN);
		
		# déclaration du hook
		$this->addHook('AdminAuthTop','AdminAuthTop');
	}
		
	# HOOK
	public function AdminAuthTop(){
		
		$plxAdmin = plxAdmin::getInstance();

		$login_logo=$this->getParam("login_logo");
		if (trim($login_logo) != '') $login_logo='<p style="text-align:center;"><img src="'.PLX_ROOT.$login_logo.'" /></p>';
		
			echo'<form action="auth.php<?php echo !empty($redirect)?\'?p=\'.plxUtils::strCheck(urlencode($redirect)):\'\' ?>" method="post" id="form_auth">
					<fieldset>
						<?php echo plxToken::getTokenPostMethod() ?>
						<h1 class="h5 text-center"><strong><?php echo L_LOGIN_PAGE ?></strong></h1>
						'.$login_logo.'
						<?php (!empty($msg))?plxUtils::showMsg($msg, $error):\'\'; ?>
						<div class="grid">
							<div class="col sml-12">
								<label for="id_login"><?php echo L_AUTH_LOGIN_FIELD ?>&nbsp;:</label>
								<?php plxUtils::printInput(\'login\', (!empty($_POST[\'login\']))?plxUtils::strCheck($_POST[\'login\']):\'\', \'text\', \'10-255\',false,\'full-width\',\'\',\'autofocus\');?>
							</div>
						</div>
						<div class="grid">
							<div class="col sml-12">
								<label for="id_password"><?php echo L_AUTH_PASSWORD_FIELD ?>&nbsp;:</label>
								<?php plxUtils::printInput(\'password\', \'\', \'password\',\'10-255\',false,\'full-width\');?>
							</div>
						</div>
						<?php eval($plxAdmin->plxPlugins->callHook(\'AdminAuth\')) ?>
						<div class="grid">
							<div class="col sml-12 text-center">
								<input class="blue h5" type="submit" value="<?php echo L_SUBMIT_BUTTON ?>" />
							</div>
						</div>
					</fieldset>
				</form>
				<p class="text-center">
					<a class="back" href="<?php echo PLX_ROOT; ?>"><?php echo L_BACK_TO_SITE ?></a> - <?php echo L_POWERED_BY ?>
				</p>
			</div>
		</section>
	</main>

<?php eval($plxAdmin->plxPlugins->callHook(\'AdminAuthEndBody\')) ?>
</body>
</html><?php exit;?>';
	}
}
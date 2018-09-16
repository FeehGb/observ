<?php
ob_start();
define( 'ROOTADMPATH', dirname(__FILE__) . '/' );
define( 'ROOTPATH', dirname(ROOTADMPATH). '/'  );
define( 'PHPSCRPATH',ROOTADMPATH.'addons/php/' );

require_once(ROOTPATH."/Connections/db.class.php");

// *** Validate request to login to this site.
if (!isset($_SESSION))
{
	session_start();
}
if (isset($_GET[ 'accesscheck' ]))
{
	$_SESSION[ 'PrevUrl' ] = $_GET[ 'accesscheck' ];
	
}
$loginUserlogin          = $_POST[ 'user_login' ];
$password                = $_POST[ 'user_pass' ];
$MM_fldUserAuthorization = "nivel";
$MM_redirectLoginSuccess = "../admin/cms.php";
$MM_redirectLoginFailed  = "login?incorrect=true";
$MM_redirecttoReferrer   = false;
if (isset($_SESSION["USER_AUTHORIZED"]))
{
	header("Location: " . $MM_redirectLoginSuccess);
	
}
else
{
	
	if (isset($_POST[ 'user_login' ]))
	{
		
		$pdo  = DB__connect::PDOconnection($db_host, $db_user, $db_pass, $db_name);
		$sql  = "SELECT * FROM observ_user WHERE user_login = ? AND user_pass = ?";
		$bind = $pdo->prepare($sql);
		$bind->bindValue(1, $loginUserlogin);
		$bind->bindValue(2, $password);
		$bind->execute();
		if ($bind->rowCount() == 1)
		{
			$dados         = $bind->fetch(PDO::FETCH_ASSOC);
			$loginStrGroup = $dados[ "user_level" ];
			if (PHP_VERSION >= 5.1)
			{
				session_regenerate_id(true);
			}
			else
			{
				session_regenerate_id();
			}
			
			//declare two session variables and assign them
			$_SESSION[ 'MM_Userlogin' ]  = $loginUserlogin;
			$_SESSION[ 'MM_UserGroup' ] = $loginStrGroup;
			$_SESSION[ 'MM_Username' ] = $dados[ "user_name" ];;
			$pdo                        = NULL;
			if (isset($_SESSION[ 'PrevUrl' ]))
			{
				$MM_redirectLoginSuccess = $_SESSION[ 'PrevUrl' ];
			}
			header("Location: " . $MM_redirectLoginSuccess);
			$_SESSION["USER_AUTHORIZED"] = true;
			
		}
		else
		{
			unset($_SESSION["USER_AUTHORIZED"]);
			header("Location:" . $MM_redirectLoginFailed);
		}
	}
}
ob_end_flush(); 
?>
<!DOCTYPE HTML>
<html>
	<head>

		<?php //include "../adm/scripts.php"; ?>
		<title>Administração/Login</title>
		<link href="<?php echo $_SESSION["URL_BASE"];?>/admin/style/page-admin-style.css" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
  <div id="wrap_form">
			
	<div class="wrap_login">
    		<?php
				$error_ = $_GET[ 'incorrect' ];
				if ($error_ == 'true')
				{
			?>
			<div class="user_error">
				E-mail ou senha incorreta!
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
					$('form #user_login').val('Tente novamente!');
					$('form #user_login').select();
					$('form #user_pass').val('');
				});

			</script>
			<?php
		}
		?>
            <h1 id="alert">Acesso ao Painel de administração do Site</h1>
			<div id="form-login">
				<form name="login" id="login" action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>" method="POST" autocomplete="off">
					<fieldset>
						<p class="p_form">
							<span class="user_login"></span><input type="text" name="user_login" id="user_login" class="user_login login"  placeholder="login"   maxlength="50"  autocomplete="off"/>
						</p>
						<p class="p_form">
							<span class="user_pass"></span><input type="password" name="user_pass" id="user_pass" class="user_pass login" placeholder="password"  maxlength="60"  autocomplete="off"/>
						</p>
					</fieldset>
					<input name="login" id="entrar" type="submit" class="button green" value="Entrar">
				</form>
              </div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</body>
</html>
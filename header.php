<?php
header("Content-Type: text/html; charset=UTF-8");

if(!defined('SITEPATH')){
	if(gethostname() == "dev01"){	
		list($x, $userDir, $x) = explode("/", $_SERVER["SCRIPT_NAME"]);
	
		define("SITEPATH", '/' . $userDir . '/mycom2/');
	}
	else{
		define("SITEPATH", '/');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>MyComingle</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script type="text/javascript">	
	var showTipsy = true;
</script>

<script type="text/javascript" src="<?=$base?>js/ajax.js"></script>
<script type="text/javascript" src="<?=$base?>js/general.js"></script>
<script type="text/javascript" src="<?=$base?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$base?>js/jquery.alerts.js"></script>
<script type="text/javascript" src="<?=$base?>js/jquery.tipsy.js"></script>
<link rel="stylesheet" href="<?=$base?>css/general.css" type="text/css" />
<link rel="stylesheet" href="<?=$base?>css/jquery-tipsy.css" type="text/css" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

<!-- fancy box -->

<script type="text/javascript" src="<?=$base?>js/jquery.fancybox.js?v=2.0.6"></script>
<link rel="stylesheet" type="text/css" href="<?=$base?>js/fancybox/jquery.fancybox.css?v=2.0.6" media="screen" />

<link rel="stylesheet" type="text/css" href="<?=$base?>js/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.2" />
<script type="text/javascript" src="<?=$base?>js/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.2"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.fancybox').fancybox();

		initTooltips();
		detectBrowser();

		rotateTestimonials();

		var cP = getCookie('mycomingle_password');

		if(cP != '' && cP != undefined){
			$('#login_email').val(getCookie('mycomingle_username'));
			$('#login_password').val(getCookie('mycomingle_password'));

			doLogin('app/');
		}
	});
</script>
<style type="text/css">
	.fancybox-custom .fancybox-skin {
		box-shadow: 0 0 50px #222;
	}
</style>

<!-- end fancy box -->
</head>
<body>
<div style="width: 100%" class="main-container">
	<div style="height: 15px"></div>
	<div class="header">
		<div class="header-content">
			<div class="header-logo">
				<div style="float: left"><img src="<?=$base?>images/general/logo.png"></div>
				<div style="float: left">Beta</div>
				<div class="clear"></div>
			</div>
			<div class="header-links">
				<div class="header-link" style="padding-top: 18px;cursor: pointer;" onClick="showLoginForm();">Log in <span style="color: #c4c4c4">or</div>
				<div class="login-box">
					<div class="login-box-contents">
						<div class="login-box-label">Email&nbsp;</div>
						<div class="login-box-field"><input type="text" name="email" id="login_email" class="form-field" placeholder="example@example.com" value="<?php echo (!empty($_COOKIE["mycomingle_username"]) ? $_COOKIE["mycomingle_username"] : '');?>"></div>
						<div class="clear" style="padding-top: 10px"></div>
						<div class="login-box-label">Password&nbsp;</div>
						<div class="login-box-field"><input type="password" name="password" id="login_password" placeholder="password" onKeypress="checkForEnter(event, '<?=$base?>');"></div>
						<div class="clear"></div>
						<div class="login-button"><div class="form-button" id="login-button"><input type="button" value="Login" onClick="doLogin('<?=$base?>');"></div></div><!--<img src="<?=$base?>images/general/login-button.png" id="login-button" class="pointer" onClick="doLogin();">-->
						<div class="login-forgot-text"><a href="javascript: showPasswordForget('<?=$base?>');void(0);">Forgotten your<br />password?</a></div>
						<div class="clear"></div>
						<div class="login-button" style="padding-top: 10px;font-size: 8pt"><input type="checkbox" id="keep_logged_in">Keep me logged in</div>
						<div class="clear" style="padding-bottom: 5px"></div>
						<div class="login-widepoint"><img src="<?php echo $base;?>images/general/icons/lock-icon.png" border="0" align="absmiddle">&nbsp;<a href="javascript: window.open('https://csp2.orc.com:444/mycomingle/CertParserORC.jsp?callback_url=<?php echo base64_encode("http". (!empty($_SERVER["HTTP_HTTPS_X_FORWARDED_FOR"]) ? "s" : "") . "://" . $_SERVER["HTTP_HOST"] ."" . SITEPATH . "cert_callback.php");?>', 'cv', 'height=480, width=640, scrollable=no, status=no, sizable=no, location=no');void(0);" class="tipsy_hover_n" style="color: #FF0000" title="CAC/TWIC/PIV/PIV-I/FiXs/ECA/ACES/etc.">Use your digital certificate</a></div>  
					</div>
				</div>
				<div style="float: left"><img src="<?=$base?>images/general/sign-up.png" align="absmiddle" style="cursor: pointer" onClick="showJoin('top', '<?=$base?>');">
					<div style="position: relative">
						<div class="join-callouts" id="join-configure-callouttop" style="margin: 11px -204px 0px">
							<div class="join-callout join-border-callout" style="margin: 0 18px 18px 2px; width: 400px">
								<div class="join-callout-contenttop" style="padding: 10px"></div>
								<b class="join-border-notch join-notch" style="margin-left: 35px"></b>
								<b class="join-notch" style="margin-left: 35px"></b>
							</div>						
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
	<div style="height: 10px"></div>
<?php //netteCache[01]000376a:2:{s:4:"time";s:21:"0.05977700 1467130290";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:62:"C:\wamp\www\NetteFramework\sandbox\app\templates\@layout.latte";i:2;i:1467130273;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-12-22";}}}?><?php

// source file: C:\wamp\www\NetteFramework\sandbox\app\templates\@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'lhkxp9egr8')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbc3cdfe9811_head')) { function _lbc3cdfe9811_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbacd25b3333_title')) { function _lbacd25b3333_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<h1>Congratulations!</h1>
<?php
}}

//
// block scripts
//
if (!function_exists($_l->blocks['scripts'][] = '_lbf4a5a212f7_scripts')) { function _lbf4a5a212f7_scripts($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<script src="<?php echo Nette\Templating\Helpers::escapeHtml($basePath, ENT_COMPAT) ?>/js/jquery.js"></script>
	<script src="<?php echo Nette\Templating\Helpers::escapeHtml($basePath, ENT_COMPAT) ?>/js/netteForms.js"></script>
	<script src="<?php echo Nette\Templating\Helpers::escapeHtml($basePath, ENT_COMPAT) ?>/js/main.js"></script>
<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="description" content="" />

	<title><?php if (isset($_l->blocks["title"])) { ob_start(); Nette\Latte\Macros\UIMacros::callBlock($_l, 'title', $template->getParameters()); echo $template->striptags(ob_get_clean()) ?>
 | <?php } ?>Nette Sandbox</title>

	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Nette\Templating\Helpers::escapeHtml($basePath, ENT_COMPAT) ?>/css/screen.css" />
	<link rel="stylesheet" media="print" href="<?php echo Nette\Templating\Helpers::escapeHtml($basePath, ENT_COMPAT) ?>/css/print.css" />
	<link rel="shortcut icon" href="<?php echo Nette\Templating\Helpers::escapeHtml($basePath, ENT_COMPAT) ?>/favicon.ico" />
	<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>

</head>

<body>
<script> document.body.className+=' js' </script>

<div id="header">
    <h1><a href="<?php echo Nette\Templating\Helpers::escapeHtml($_presenter->link("Homepage:"), ENT_COMPAT) ?>">Uzivatele</a></h1>
</div>

<div id="nav">
    <a href="<?php echo Nette\Templating\Helpers::escapeHtml($_presenter->link("Register:register"), ENT_COMPAT) ?>">Registrovat</a>
    <a href="<?php echo Nette\Templating\Helpers::escapeHtml($_presenter->link("Sign:in"), ENT_COMPAT) ?>">Prihlasit</a>
</div>

<?php $iterations = 0; foreach ($flashes as $flash) { ?><div class="flash <?php echo Nette\Templating\Helpers::escapeHtml($flash->type, ENT_COMPAT) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>

<div id="banner">
<?php call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>
</div>
<div id="content">
<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParameters()) ?>
</div>
<?php call_user_func(reset($_l->blocks['scripts']), $_l, get_defined_vars())  ?>
</body>
</html>

<style>
	html { overflow-y: scroll; }
	body { font: 14px/1.65 Verdana, "Geneva CE", lucida, sans-serif; background: url("http://www.cinemacityfilm.com/images/film-header.jpg"); color: #333; margin: 38px auto; max-width: 940px; min-width: 420px; }

	h1, h2 { font: normal 150%/1.3 Georgia, "New York CE", utopia, serif; color: #1e5eb6; -webkit-text-stroke: 1px rgba(0,0,0,0); }

	img { border: none; }

	a { color: #006aeb; padding: 3px 1px; }

	a:hover, a:active, a:focus { background-color: #006aeb; text-decoration: none; color: white; }

	#banner { border-radius: 12px 12px 0 0; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAB5CAMAAADPursXAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAGBQTFRFD1CRDkqFDTlmDkF1D06NDT1tDTNZDk2KEFWaDTZgDkiCDTtpDT5wDkZ/DTBVEFacEFOWD1KUDTRcDTFWDkV9DkR7DkN4DkByDTVeDC9TDThjDTxrDkeADkuIDTRbDC9SbsUaggAAAEdJREFUeNqkwYURgAAQA7DH3d3335LSKyxAYpf9vWCpnYbf01qcOdFVXc14w4BznNTjkQfsscAdU3b4wIh9fDVYc4zV8xZgAAYaCMI6vPgLAAAAAElFTkSuQmCC); }
	#banner h1 { color: white; font-size: 50px; line-height: 121px; margin: 0; padding-left: 4%; background: url(data:image/png;base64,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) no-repeat 95%; text-shadow: 1px 1px 0 rgba(0, 0, 0, .9); }
	@media (max-width: 600px) {
		#banner h1 { background: none; }
	}

	#content { background: white; border: 1px solid #eff4f7; border-radius: 0 0 12px 12px; padding: 10px 4%; }
	#content > h2 { font-size: 130%; color: #666; clear: both; padding: 1.2em 0; margin: 0; }

	h2 span { color: #87A7D5; }
	h2 a { text-decoration: none; background: transparent; }

	.boxes > div { width: 31%; float: left; background: #f0f0f0; margin-right: 3%; min-height: 280px; border: 1px solid #e6e6e6; border-radius: 5px; }
	.boxes h2 { text-align: right; margin: 10%; }
	.boxes img { float: left; }
	.boxes p { clear: both; margin: 10%; }
	.boxes p a { color: #006aeb; background: #f7f7f7; padding: 1px 3px; border-radius: 3px; text-decoration: none; box-shadow: 0 2px 5px rgba(0, 0, 0, .10); }
	.boxes p a:hover, .boxes p a:active, .boxes p a:focus { color: white; background-color: #006aeb; }
	.boxes > div:nth-child(3n - 2) h2 { color: #00a6e5; }
	.boxes > div:nth-child(3n - 2) img { margin: -12% 0 0 -12%; }
	.boxes > div:nth-child(3n - 1) h2 a { color: #db8e34; background: transparent; }
	.boxes > div:nth-child(3n) { margin: 0; }
	.boxes > div:nth-child(3n) h2 a { color: #578404; background: transparent; }
	@media (max-width: 700px) {
		.boxes > div { float: none; width: auto; margin: 0 0 1.1em; min-height: 0; }
		.boxes h2, .boxes p { margin: 1em; }
		.boxes > div:nth-child(3n - 2) img { margin: -1em 0 0 -1em; }
	}

	html.js section { display: none; }

	pre { font-size: 12px; line-height: 1.4; padding: 10px; margin: 1.3em 0; overflow: auto; max-height: 500px; background: #F1F5FB; border-radius: 5px; box-shadow: 0 1px 1px rgba(0, 0, 0, .1); }

	footer { font-size: 70%; padding: 1em 0; color: gray; }

	.jush-com, .jush-php_doc { color: #929292; }
	.jush-tag, .jush-tag_js { color: #6A8527; font-weight: bold; }
	.jush-att { color: #8CA315 }
	.jush-att_quo { color: #448CCB; font-weight: bold; }
	.jush-php_var { color: #d59401; font-weight: bold; }
	.jush-php_apo { color: green; }
	.jush-php_new { font-weight: bold; }
	.jush-php_fun { color: #254DB3; }
	.jush-js, .jush-css { color: #333333; }
	.jush-css_val { color: #448CCB; }
	.jush-clr { color: #007800; }
	.jush a { color: inherit; background: transparent; }
	.jush-latte { color: #D59401; font-weight: bold }
</style>

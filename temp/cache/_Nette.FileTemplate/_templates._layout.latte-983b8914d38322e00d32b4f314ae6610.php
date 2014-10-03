<?php //netteCache[01]000363a:2:{s:4:"time";s:21:"0.05941900 1412272074";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:49:"C:\xampp\htdocs\nktis\app\templates\@layout.latte";i:2;i:1411740314;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-08-28";}}}?><?php

// source file: C:\xampp\htdocs\nktis\app\templates\@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'k744e5bkc1')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb5e65e66547_title')) { function _lb5e65e66547_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Projekty<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb89b8a361c7_head')) { function _lb89b8a361c7_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block _flashMessages
//
if (!function_exists($_l->blocks['_flashMessages'][] = '_lbf453e90006__flashMessages')) { function _lbf453e90006__flashMessages($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('flashMessages', FALSE)
;$iterations = 0; foreach ($flashes as $flash) { ?>          <div class="flash <?php echo Nette\Templating\Helpers::escapeHtml($flash->type, ENT_COMPAT) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } 
}}

//
// block scripts
//
if (!function_exists($_l->blocks['scripts'][] = '_lbaba0cabba6_scripts')) { function _lbaba0cabba6_scripts($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<script src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery.js"></script>
	<script src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/js/netteForms.js"></script>
        <script src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/js/main.js"></script>
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
	<meta charset="utf-8">
	<meta name="description" content="">
<?php if (isset($robots)) { ?>	<meta name="robots" content="<?php echo Nette\Templating\Helpers::escapeHtml($robots, ENT_COMPAT) ?>">
<?php } ?>

	<title><?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
ob_start(); call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars()); echo $template->strip($template->stripTags(ob_get_clean()))  ?></title>

	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/css/screen.css">
	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/css/projects.css">
        <link rel="stylesheet" media="screen,projection,tv" href="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/css/popup.css">
        <link rel="stylesheet" media="screen,projection,tv" href="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/css/reveal.css">
	<link rel="stylesheet" media="print" href="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/css/print.css">
	<link rel="shortcut icon" href="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/favicon.ico">
  
	<script type="text/javascript" src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/js/live-form-validation.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/js/nette.ajax.js"></script>
        <script type="text/javascript" src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery.reveal.js"></script>
        <script type="text/javascript" src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery.nette.js"></script>
        <script type="text/javascript" src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/js/functions.js"></script>
        <script type="text/javascript" src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/js/counting.js"></script>
        
	<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>

</head>

<body>
	<script> document.documentElement.className+=' js' </script>
  <div id="wrapper">
<div id="header">
      <div id="header-inner">
          <div id="title">IS NKT v2.0</div>
<?php if ($user->isLoggedIn()) { ?>
          <div id="logged">
              Přihlášen: <a href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("MyProfile:"), ENT_COMPAT) ?>
"><span class="icon user"><?php echo Nette\Templating\Helpers::escapeHtml($user->getIdentity()->name, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($user->getIdentity()->surname, ENT_NOQUOTES) ?></span></a> |
              <a href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Translator:password"), ENT_COMPAT) ?>
">Změna hesla</a> |
              <a href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("signOut!"), ENT_COMPAT) ?>
">Odhlásit se</a>
          </div>
<?php } ?>
      </div>
 	</div>
  
 	<div id="container">
<?php if ($user->isLoggedIn()) { ?>
          <div id="menu">
              <ul>
<?php $iterations = 0; foreach ($menuItems as $item => $link) { ?>                <li><a title="<?php echo Nette\Templating\Helpers::escapeHtml($item, ENT_COMPAT) ?>
" href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link($link), ENT_COMPAT) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($item, ENT_NOQUOTES) ?></a></li>
<?php $iterations++; } ?>              </ul>
          </div>
<?php } ?>
  
      <div id="content">
<div id="<?php echo $_control->getSnippetId('flashMessages') ?>"><?php call_user_func(reset($_l->blocks['_flashMessages']), $_l, $template->getParameters()) ?>
</div>          
<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParameters()) ?>
      </div>
  
      <div id="footer">
      Informační systém NK Translators v2.0 | Nette <?php echo Nette\Templating\Helpers::escapeHtml(Nette\Framework::VERSION, ENT_NOQUOTES) ?>

      </div>
  	</div>
  </div>
<?php call_user_func(reset($_l->blocks['scripts']), $_l, get_defined_vars())  ?>
</body>
</html>

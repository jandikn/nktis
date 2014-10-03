<?php //netteCache[01]000374a:2:{s:4:"time";s:21:"0.29958700 1412288847";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:60:"C:\xampp\htdocs\nktis\app\templates\Translator\default.latte";i:2;i:1411119066;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-08-28";}}}?><?php

// source file: C:\xampp\htdocs\nktis\app\templates\Translator\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'rmeyveqwjq')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb4835eaa4a1_content')) { function _lb4835eaa4a1_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><script type="text/javascript">
    $(document).ready(function(){
      $('#search').keyup(function(){
        var q = $(this).val();
        if(q.length > 2){
          $('#results').load('search.php?q='+q);
        }else if(q.length == 0){
          //$('#results').load('search.php?all');
          $('#results').html("");
        }
      });
    })
</script>

<?php call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<div id="context_menu">
    <a class="mybutton b_add" title="Nový překladatel" href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Translator:new"), ENT_COMPAT) ?>
">Nový překladatel</a>
    <div class="float_right">
        <span class="mybutton b_arrowup" onclick="hideAllDetail();" id="show_all">Schovat vše</span>
        <span class="mybutton b_arrowdown" onclick="showAllDetail();" id="hide_all">Rozbalit vše</span>
    </div>
</div>

<table class="default">
    <thead>
    <tr>
        <th class="center">Filtry</th><td></td><td></td><td></td><td></td><td><input type="text" id="search"></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <th class="center">Id</th>
        <th class="center">Počet překladů</th>
        <th class="center">CAT</th>
        <th class="center">Titul</th>
        <th>Jméno</th>
        <th>Příjmení</th>
        <th>E-mail</th>
        <th>Telefon</th>
        <th class="center">ŽL</th>
        <th class="center">Hodnocení</th>
        <th>Editace</th>
        <th class="center">Detaily</th>
    </tr>
    </thead>
    <tbody>
<?php $i=0 ;$iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($translators) as $translator) { ?>
    <tr class="show">
        <td class="row_no"><?php echo Nette\Templating\Helpers::escapeHtml(++$i, ENT_NOQUOTES) ?></td>
        <td class="center"><?php echo Nette\Templating\Helpers::escapeHtml(count($translator->related('translator_project')), ENT_NOQUOTES) ?></td>
        <td class="center"><?php if (count($translator->related('translator_cattool')) != 0) { ?>
<img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>
/images/cat_tools.png" alt="CAT" title="CAT nástroje"><?php } ?></td>
        <td class="right"><?php echo Nette\Templating\Helpers::escapeHtml($translator->title, ENT_NOQUOTES) ?></td>
        <td><?php echo Nette\Templating\Helpers::escapeHtml($translator->name, ENT_NOQUOTES) ?></td>
        <td><?php echo Nette\Templating\Helpers::escapeHtml($translator->surname, ENT_NOQUOTES) ?></td>
        <td><a href="mailto:<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($translator->email), ENT_COMPAT) ?>
" title="Napsat e-mail" class="send_email"><img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>
/images/send_email.png" alt="e-mail"><?php echo Nette\Templating\Helpers::escapeHtml($translator->email, ENT_NOQUOTES) ?></a></td>
        <td><?php echo Nette\Templating\Helpers::escapeHtml($translator->tel_preset, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($template->number($translator->telephone, 0, ',', ' '), ENT_NOQUOTES) ?></td>
        <td class="center"><?php if ($translator->reg_no != "") { ?><img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>
/images/accept.png" alt="Ano"><?php } else { ?><img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>
/images/cross.png" alt="Ano"><?php } ?></td>
        <td class="center"><?php echo Nette\Templating\Helpers::escapeHtml(count($translator->related('translator_cattool')), ENT_NOQUOTES) ?></td>
        <td class="no-wrap">
            <a class="mybutton b_edit" href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Translator:edit", array($translator->id)), ENT_COMPAT) ?>
">Edit</a>
            <a class="mybutton b_delete" href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Translator:delete", array($translator->id)), ENT_COMPAT) ?>
">Deaktivovat</a>
        </td>
        <td class="center"><span onclick="showHideDetail(<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::escapeJs($translator->id), ENT_COMPAT) ?>
);" id="details_<?php echo Nette\Templating\Helpers::escapeHtml($translator->id, ENT_COMPAT) ?>" class="mybutton b_arrowup b_arrowdown no_text" title="Detaily"></span></td>
    </tr>
    <tr class="hidden" id="<?php echo Nette\Templating\Helpers::escapeHtml($translator->id, ENT_COMPAT) ?>">
        <td class="row_no"></td><td class="" colspan="11" width="900">
        <table class="details">
            <tr>
                <td width="120">Jazyky</td>
                <td colspan="2" width="500">
                    <table class="inner">
                        <tr><th>Jazyk</th><th>Překlady / NS</th><th>Korektury / NS</th><th>Tlumočení / NS</th></tr>
<?php $iterations = 0; foreach ($translator->related('translator_language') as $translator_language) { ?>
                            <?php if ($translator_language->native_language) { ?>
<tr class="native_language"><?php } else { ?><tr><?php } ?>

                                <td><img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>
/images/languages/<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($translator_language->language->icon), ENT_COMPAT) ?>
" alt="<?php echo Nette\Templating\Helpers::escapeHtml($translator_language->language->shortcut, ENT_COMPAT) ?>
"> <?php echo Nette\Templating\Helpers::escapeHtml($translator_language->language->name, ENT_NOQUOTES) ?></td>
                                <td><?php echo Nette\Templating\Helpers::escapeHtml($translator_language->translation_charge, ENT_NOQUOTES) ?> Kč</td>
                                <td><?php echo Nette\Templating\Helpers::escapeHtml($translator_language->proofreading_charge, ENT_NOQUOTES) ?> Kč</td>
                                <td><?php echo Nette\Templating\Helpers::escapeHtml($translator_language->interpretation_charge, ENT_NOQUOTES) ?> Kč</td>
                            </tr>
<?php $iterations++; } ?>
                    </table>
                </td>
                <td rowspan="10"><img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>
/images/profiles/<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($translator->profile_pic), ENT_COMPAT) ?>
" alt="<?php echo Nette\Templating\Helpers::escapeHtml($translator->profile_pic, ENT_COMPAT) ?>" class="profile"></td>
            </tr>
            <tr>
                <td>Obory</td>
                <td>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($translator->related('translator_field')) as $translator_field) { ?>
                        <?php echo Nette\Templating\Helpers::escapeHtml($translator_field->field->name, ENT_NOQUOTES) ;if (!$iterator->last) { ?>
,<?php } ?>

<?php $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
                </td>
            </tr>
            <tr>
                <td>CAT nástroje <img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/images/cat_tools.png" alt="CAT tools" class="float_right"></td>
                <td>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($translator->related('translator_cattool')) as $translator_cattool) { ?>
                        <?php echo Nette\Templating\Helpers::escapeHtml($translator_cattool->cat_tool->name, ENT_NOQUOTES) ;if (!$iterator->last) { ?>
,<?php } ?>

<?php $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
                </td>
            </tr>
            <tr><td>Adresa</td><td><?php echo Nette\Templating\Helpers::escapeHtml($translator->address, ENT_NOQUOTES) ?>
, <?php echo Nette\Templating\Helpers::escapeHtml($translator->postcode, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($translator->city, ENT_NOQUOTES) ?></td></tr>
            <tr><td>IČ</td><td><?php echo Nette\Templating\Helpers::escapeHtml($translator->reg_no, ENT_NOQUOTES) ?></td></tr>
            <tr><td>DIČ</td><td><?php echo Nette\Templating\Helpers::escapeHtml($translator->tax_id_no, ENT_NOQUOTES) ?></td></tr>
            <tr>
                <td>Životopis</td>
                <td><?php if ($translator->cv != "") { ?><a href="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>
/cv/<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($translator->cv), ENT_COMPAT) ?>
" target="_blank"><img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/images/pdf.png" alt="Životopis">Životopis</a>
                    <?php } else { ?>Není k dispozici<?php } ?>

                </td>
            </tr>
            <tr><td>Poznámky</td><td><?php if ($translator->notes == "") { ?>-<?php } else { echo Nette\Templating\Helpers::escapeHtml($translator->notes, ENT_NOQUOTES) ;} ?></td></tr>
            <tr><td>Částka k obdržení</td> <td>Kč</td></tr>
            <tr><td>Celkový výdělek</td><td> Kč</td></tr>
        </table></td>
    </tr>
<?php $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
    </tbody>
</table>

<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb9c0b448373_title')) { function _lb9c0b448373_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>Překladatelé</h1>
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

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 
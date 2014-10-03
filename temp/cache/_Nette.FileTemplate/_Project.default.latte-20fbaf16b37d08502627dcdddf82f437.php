<?php //netteCache[01]000371a:2:{s:4:"time";s:21:"0.54827100 1412288833";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:57:"C:\xampp\htdocs\nktis\app\templates\Project\default.latte";i:2;i:1411547523;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-08-28";}}}?><?php

// source file: C:\xampp\htdocs\nktis\app\templates\Project\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'pw6sxmxd0y')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbee6792cdee_content')) { function _lbee6792cdee_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<div id="context_menu">
    <a href="#" data-reveal-id="project_type" class="mybutton b_add" title="Nový projekt">Nový projekt</a>
    <!-- hidden inline form -->
    <div id="project_type" class="reveal-modal">
        <h2>Vyberte typ projektu</h2>
        <table class="popup">
        <tr><td><a href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Project:translation"), ENT_COMPAT) ?>
">Překlad</a></td></tr>
        <tr><td><a href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Project:proofreading"), ENT_COMPAT) ?>
">Korektura</a></td></tr>
        <tr><td><a href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Project:transproof"), ENT_COMPAT) ?>
">Překlad + korektura</a></td></tr>
        <tr><td><a href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Project:interpretation"), ENT_COMPAT) ?>
">Tlumočení</a></td></tr>
        </table>
        <a class="close-reveal-modal">&#215;</a>
    </div>

    <a class="mybutton b_note" title="Fakturace" href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Project:invoice"), ENT_COMPAT) ?>
">Fakturace</a>

    <div class="float_right">
        <span class="mybutton b_arrowup" onclick="hideAllDetail();" id="show_all">Schovat vše</span>
        <span class="mybutton b_arrowdown" onclick="showAllDetail();" id="hide_all">Rozbalit vše</span>
    </div>
</div>

<table class="default"<?php echo ' id="' . $_control->getSnippetId('projects') . '"' ?>>
<?php call_user_func(reset($_l->blocks['_projects']), $_l, $template->getParameters()) ?>
</table>

<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb2690b3bda6_title')) { function _lb2690b3bda6_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>Projekty</h1>
<?php
}}

//
// block _projects
//
if (!function_exists($_l->blocks['_projects'][] = '_lb2d722ba280__projects')) { function _lb2d722ba280__projects($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('projects', FALSE)
?>    <thead>
    <tr class="filter">
        <th class="center">Filtry</th><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <th class="center">Id</th>
        <th>Projekt</th>
        <th>Zákazník</th>
        <th>Termín / Fakturace</th>
        <th class="no-wrap">Cena bez DPH</th>
        <th class="no-wrap">Cena s DPH</th>
        <th class="no-wrap">Editace</th>
        <th class="no-wrap">Stav</th>
        <th>Detaily</th>
    </tr>
    </thead>
    <tbody>
    
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($projects) as $project) { ?>
    <?php if ($project->status == 0) { ?> <tr class="show poptavka">
    <?php } elseif ($project->status == 1) { ?> <tr class="show aktualni">
    <?php } elseif ($project->status == 2) { ?> <tr class="show fakturace">
    <?php } elseif ($project->status == 3) { ?> <tr class="show nezaplaceny">
    <?php } else { ?> <tr class="show nevyuctovany">
<?php } ?>
    
        <td class="row_no"><?php echo Nette\Templating\Helpers::escapeHtml($iterator->counter, ENT_NOQUOTES) ?></td>
        <td>
            <?php echo Nette\Templating\Helpers::escapeHtml($project->number_of_order, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($project->name, ENT_NOQUOTES) ?>

            <?php if ($project->proj_notes != NULL) { ?><span class="float_right">
            <a href="#" data-reveal-id="project_notes_<?php echo Nette\Templating\Helpers::escapeHtml($project->id, ENT_COMPAT) ?>
" class="" title="<?php echo Nette\Templating\Helpers::escapeHtml($project->proj_notes, ENT_COMPAT) ?>
"><img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/images/note.png" style="margin-bottom: -4px;"></a></span>
            <!-- hidden inline form -->
            <div id="project_notes_<?php echo Nette\Templating\Helpers::escapeHtml($project->id, ENT_COMPAT) ?>" class="reveal-modal">
                <h2>Poznámka</h2>
                <table class="popup">
                    <tr><td><?php echo Nette\Templating\Helpers::escapeHtml($project->proj_notes, ENT_NOQUOTES) ?></td></tr>
                </table>
                <a class="close-reveal-modal">&#215;</a>
            </div>
<?php } ?>
        </td>
        
        <td>                
            <a href="#" data-reveal-id="customerProfile_<?php echo Nette\Templating\Helpers::escapeHtml($project->customer->id, ENT_COMPAT) ?>
" class="" title="Detail zákazníka"><?php if ($project->customer->company != null) { ?>
<strong><?php echo Nette\Templating\Helpers::escapeHtml($project->customer->company, ENT_NOQUOTES) ?>
</strong><?php } ?> <?php echo Nette\Templating\Helpers::escapeHtml($project->customer->surname, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($project->customer->name, ENT_NOQUOTES) ?></a>
            <!-- hidden inline form -->
            <div id="customerProfile_<?php echo Nette\Templating\Helpers::escapeHtml($project->customer->id, ENT_COMPAT) ?>" class="reveal-modal">
                <h2>Detail zákazníka</h2>
                <table class="popup">
                <tr><td>Jméno a příjmení</td>   <td><?php echo Nette\Templating\Helpers::escapeHtml($project->customer->surname, ENT_NOQUOTES) ?>
  <?php echo Nette\Templating\Helpers::escapeHtml($project->customer->name, ENT_NOQUOTES) ?></td></tr>
                <tr><td>Společnost</td>         <td><?php if ($project->customer->company != null) { echo Nette\Templating\Helpers::escapeHtml($project->customer->company, ENT_NOQUOTES) ;} ?></td></tr>
                <tr><td>Adresa</td>             <td><?php echo Nette\Templating\Helpers::escapeHtml($project->customer->address, ENT_NOQUOTES) ?>
<br><?php echo Nette\Templating\Helpers::escapeHtml($template->postcode($project->customer->postcode), ENT_NOQUOTES) ?>
, <?php echo Nette\Templating\Helpers::escapeHtml($project->customer->city, ENT_NOQUOTES) ?></td></tr>
                <tr><td>Email</td>              <td><?php echo Nette\Templating\Helpers::escapeHtml($template->email($project->customer->email), ENT_NOQUOTES) ?></td></tr>
                <tr><td>Telefon</td>            <td>+<?php echo Nette\Templating\Helpers::escapeHtml($project->customer->tel_preset, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($template->number($template->removeWhiteSpaces($project->customer->telephone), 0, ',', ' '), ENT_NOQUOTES) ?></td></tr>
                <tr><td>IČ</td>                 <td><?php echo Nette\Templating\Helpers::escapeHtml($project->customer->reg_no, ENT_NOQUOTES) ?></td></tr>
                <tr><td>DIČ</td>                <td><?php echo Nette\Templating\Helpers::escapeHtml($project->customer->tax_id_no, ENT_NOQUOTES) ?></td></tr>
                <tr><td>Web</td>                <td><?php echo Nette\Templating\Helpers::escapeHtml($project->customer->web, ENT_NOQUOTES) ?></td></tr>
                <tr><td>Fakturace</td>          <td><?php echo Nette\Templating\Helpers::escapeHtml($template->invoicing($project->customer->legal_form), ENT_NOQUOTES) ?>
 - <?php echo Nette\Templating\Helpers::escapeHtml($project->customer->due_date, ENT_NOQUOTES) ?> dní</td></tr>
                </table>
                <a class="close-reveal-modal">&#215;</a>
            </div>
            
        </td>
        
        <td class="right no-wrap">
            <?php if ($project->status <= 1) { echo Nette\Templating\Helpers::escapeHtml($template->date($project->deadline, 'j. n. Y - H'), ENT_NOQUOTES) ?> h
            <?php } elseif ($project->status == 2) { ?>-
<?php } elseif ($project->status == 3) { ?>
                <?php if ($project->invoice_expired_email == 1) { ?><img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/images/error0.png" alt="Upomínka 1" title="První upomínka automaticky odeslána" class="float_left">
                <?php } elseif ($project->invoice_expired_email == 2) { ?><img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/images/error.png" alt="Upomínka 2" title="Druhá upomínka automaticky odeslána" class="float_left">
                <?php } elseif ($project->invoice_expired_email == 3) { ?><img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>/images/error2.png" alt="Vymáhání" title="Vymáhání částky" class="float_left">
<?php } ?>
                <?php echo Nette\Templating\Helpers::escapeHtml($template->date($project->invoice_date, 'j. n. Y'), ENT_NOQUOTES) ?>

            <?php } else { echo Nette\Templating\Helpers::escapeHtml($template->date($project->invoice_date, 'j. n. Y'), ENT_NOQUOTES) ?>

<?php } ?>
        </td>
        
        <td class="right no-wrap no-wrap"><?php echo Nette\Templating\Helpers::escapeHtml($template->number($project->price, 0, ',', ' '), ENT_NOQUOTES) ?> Kč</td>
        
        <td class="right no-wrap"><?php if ($project->customer->legal_form == 'corporate') { echo Nette\Templating\Helpers::escapeHtml($template->number($template->priceWithVAT($project->price), 0, ',', ' '), ENT_NOQUOTES) ?>
 Kč <?php } else { ?> - <?php } ?></td>
        
        <td class="no-wrap">
            <a class="mybutton b_edit" title="Editovat projekt" href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Project:edit", array($project->id)), ENT_COMPAT) ?>
">Edit</a>
            <a href="#" data-reveal-id="cancelProject_<?php echo Nette\Templating\Helpers::escapeHtml($project->id, ENT_COMPAT) ?>" class="mybutton b_cancel" title="Zrušit projekt">Zrušit</a>
            <div id="cancelProject_<?php echo Nette\Templating\Helpers::escapeHtml($project->id, ENT_COMPAT) ?>" class="reveal-modal">
                 <h2>Zrušení projektu</h2>
                 <form action="/nktis/www/project/default?do=cancelProjectForm-submit" method="post" id="frm-cancelProjectForm">
                 <table class="default"><tr><td>Název</td><td><?php echo Nette\Templating\Helpers::escapeHtml($project->name, ENT_NOQUOTES) ?></td></tr>
                    <tr class="required">
                            <td><label for="frm-cancelProjectForm-reason">Důvod zrušení</label></td>
                            <td><textarea name="reason" id="frm-cancelProjectForm-reason" data-nette-rules='[{"op":":filled","msg":"Je nutné zadat název oboru."}]'></textarea></td>
                    </tr>
                    <tr>
                            <td><input type="hidden" name="project_id" id="frm-cancelProjectForm-project_id" value="<?php echo Nette\Templating\Helpers::escapeHtml($project->id, ENT_COMPAT) ?>"></td>
                            <td><input type="submit" name="_submit" class="mybutton b_ok disabled" id="frm-cancelProjectForm-submit" value="Zrušit projekt"></td>
                    </tr>
                 </table>
                 </form>
                 <a class="close-reveal-modal">&#215;</a>
            </div>
        </td>
        
        <td>
            <?php if ($project->status == 0) { ?><a class="mybutton b_go" title="Aktivovat projekt" onclick="return confirm('Aktivovat projekt?');" href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Project:activateProject", array($project->id)), ENT_COMPAT) ?>
">Aktivovat</a>
            
<?php } elseif ($project->status == 1) { ?>
                <?php if ($project->proj_notes == NULL) { ?><a class="mybutton b_ok" title="Dokončit projekt" onclick="return confirm('Dokončit projekt?');" href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Project:projectFinish"), ENT_COMPAT) ?>
">Dokončit</a>
                <?php } else { ?><a class="mybutton b_ok" title="Dokončit projekt" onclick="return confirm('Pozor, poznámka:\n\n<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::escapeJs($project->proj_notes), ENT_COMPAT) ?>
\n\nDokončit projekt?');" href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Project:finish"), ENT_COMPAT) ?>
">Dokončit</a><?php } ?>

<?php } elseif ($project->status == 2) { ?>
                <a href="#" data-reveal-id="fakturace_<?php echo Nette\Templating\Helpers::escapeHtml($project->id, ENT_COMPAT) ?>"
                <?php if ($project->customer->legal_form == 'individual') { ?> class="mybutton b_invoice_individual" 
                <?php } elseif ($project->customer->legal_form == 'corporate') { ?> class="mybutton b_invoice_corporate"
                <?php } else { ?><a href="#" data-reveal-id="fakturace_<?php echo Nette\Templating\Helpers::escapeHtml($project->id, ENT_COMPAT) ?>" class="mybutton b_invoice_abroad"
                <?php } ?> title="Fakturovat">Fakturovat&nbsp;<?php echo Nette\Templating\Helpers::escapeHtml($project->customer->due_date, ENT_NOQUOTES) ?>&nbsp;dní</a>
                <!-- hidden inline form -->
                <div id="fakturace_<?php echo Nette\Templating\Helpers::escapeHtml($project->id, ENT_COMPAT) ?>" class="reveal-modal left">
                    <h2>Fakturace</h2>
                    <table class="popup">
                        <tr><td>Projekt</td>        <td><?php echo Nette\Templating\Helpers::escapeHtml($project->name, ENT_NOQUOTES) ?></td></tr>
                        <tr><td>Jméno</td>          <td><?php echo Nette\Templating\Helpers::escapeHtml($project->customer->name, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($project->customer->surname, ENT_NOQUOTES) ?></td></tr>
                        <tr><td>Společnost</td>     <td><?php if ($project->customer->company != null) { echo Nette\Templating\Helpers::escapeHtml($project->customer->company, ENT_NOQUOTES) ;} else { ?>
-<?php } ?></td></tr>
                        <tr><td>Adresa</td>         <td><?php echo Nette\Templating\Helpers::escapeHtml($project->customer->address, ENT_NOQUOTES) ?>
<br><?php echo Nette\Templating\Helpers::escapeHtml($template->postcode($project->customer->postcode), ENT_NOQUOTES) ?>
, <?php echo Nette\Templating\Helpers::escapeHtml($project->customer->city, ENT_NOQUOTES) ?></td></tr>
                        <tr><td>Email</td>          <td><?php echo Nette\Templating\Helpers::escapeHtml($project->customer->email, ENT_NOQUOTES) ?></td></tr>
                        <tr><td>Telefon</td>        <td><?php echo Nette\Templating\Helpers::escapeHtml($template->number($template->removeWhiteSpaces($project->customer->telephone), 0, ',', ' '), ENT_NOQUOTES) ?></td></tr>
                        <tr><td>IČ</td>             <td><?php echo Nette\Templating\Helpers::escapeHtml($project->customer->reg_no, ENT_NOQUOTES) ?></td></tr>
                        <tr><td>DIČ</td>            <td><?php echo Nette\Templating\Helpers::escapeHtml($project->customer->tax_id_no, ENT_NOQUOTES) ?></td></tr>
                        <tr><td>Web</td>            <td><?php echo Nette\Templating\Helpers::escapeHtml($project->customer->web, ENT_NOQUOTES) ?></td></tr>
                        <tr><td>Fakturace</td>      <td class="bold"><?php echo Nette\Templating\Helpers::escapeHtml($template->invoicing($project->customer->legal_form), ENT_NOQUOTES) ?>
 - <span class="red"><?php echo Nette\Templating\Helpers::escapeHtml($project->customer->due_date, ENT_NOQUOTES) ?> dní</span></td></tr>
<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = $_control["uploadSingleInvoiceForm"], array()) ?>
                            <tr class="upload"><td><?php if ($_label = $_form["invoice"]->getLabel()) echo $_label ; echo $_form["project_id"]->getControl()->addAttributes(array('value' => $project->id)) ?>
</td><td><?php echo $_form["invoice"]->getControl() ;echo $_form["submit"]->getControl() ?></td></tr>
<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ?>
                    </table>
                    <a class="close-reveal-modal">&#215;</a>
                </div>
            <?php } elseif ($project->status == 3) { ?><a class="mybutton b_pay ajax" title="Projekt zaplacen" onclick="return confirm('Projekt zaplacen?');" href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("projectPaid!", array($project->id)), ENT_COMPAT) ?>
">Zaplaceno</a>
            <?php } else { ?><a class="mybutton b_account" title="Vyúčtovat projekt" onclick="return confirm('Vyúčtovat projekt?');" href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Project:projectAccounted"), ENT_COMPAT) ?>
">Vyúčtovat</a>
<?php } ?>
        </td>
        
        <td class="center"><span onclick="showHideDetail(<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::escapeJs($project->id), ENT_COMPAT) ?>
);" id="details_<?php echo Nette\Templating\Helpers::escapeHtml($project->id, ENT_COMPAT) ?>" class="mybutton b_arrowup b_arrowdown no_text" title="Detaily"></span></td>
    </tr>

    <tr class="hidden" id="<?php echo Nette\Templating\Helpers::escapeHtml($project->id, ENT_COMPAT) ?>">
        <td class="row_no"></td>
        <td class="details" colspan="8">
            <table class="details">
                <tr><td>Typ projektu</td><td><?php echo Nette\Templating\Helpers::escapeHtml($project->type, ENT_NOQUOTES) ?></td></tr>
                <tr><td>Projekt založil</td><td><?php echo Nette\Templating\Helpers::escapeHtml($project->creator->name, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($project->creator->surname, ENT_NOQUOTES) ?></td></tr>
                <tr><td>Vedoucí projektu</td><td><?php echo Nette\Templating\Helpers::escapeHtml($project->leader->name, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($project->leader->surname, ENT_NOQUOTES) ?></td></tr>
                <tr><td>Zdrojový jazyk</td><td><img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>
/images/languages/<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($project->source_lang->icon), ENT_COMPAT) ?>
" alt="<?php echo Nette\Templating\Helpers::escapeHtml($project->source_lang->shortcut, ENT_COMPAT) ?>
"> <?php echo Nette\Templating\Helpers::escapeHtml($project->source_lang->name, ENT_NOQUOTES) ?></td></tr>
                <tr><td>Cílové jazyky a překladatelé</td><td>
                    <table class="inner">
                        <tr><th>Jazyk</th><th>Překladatel</th><th>Cena</th><?php if ($project->status >= 2) { ?>
<th>Vyúčtování</th><?php } ?></tr>
<?php $iterations = 0; foreach ($project->related('translator_project') as $translator_project) { ?>
                            <tr>
                                <td class="no-wrap"><img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>
/images/languages/<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($translator_project->language->icon), ENT_COMPAT) ?>
" alt="<?php echo Nette\Templating\Helpers::escapeHtml($translator_project->language->shortcut, ENT_COMPAT) ?>
"> <?php echo Nette\Templating\Helpers::escapeHtml($translator_project->language->name, ENT_NOQUOTES) ?></td>
                                <td class="no-wrap">
                                    <a href="#" data-reveal-id="translatorProfile_<?php echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->id, ENT_COMPAT) ?>
" class=""><?php echo Nette\Templating\Helpers::escapeHtml($template->renderTranslatorIcon($translator_project->translator->post_id), ENT_NOQUOTES) ;echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->name, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->surname, ENT_NOQUOTES) ?></a>
                                    <!-- hidden inline form -->
                                    <div id="translatorProfile_<?php echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->id, ENT_COMPAT) ?>" class="reveal-modal">
                                        <h2>Detail překladatele</h2>
                                        <table class="popup">
                                        <tr><td>Jméno a příjmení</td>   <td><?php echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->surname, ENT_NOQUOTES) ?>
  <?php echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->name, ENT_NOQUOTES) ?></td></tr>
                                        <tr><td>Adresa</td>   <td><?php echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->address, ENT_NOQUOTES) ?>
<br><?php echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->postcode, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->city, ENT_NOQUOTES) ?></td></tr>
                                        <tr><td>Email</td>    <td><?php echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->email, ENT_NOQUOTES) ?></td></tr>
                                        <tr><td>Telefon</td>  <td><?php echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->tel_preset, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($template->number($translator_project->translator->telephone, 0, ',', ' '), ENT_NOQUOTES) ?></td></tr>
                                        <tr><td>Telefon 2</td><td><?php echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->telephone2 ? $translator_project->translator->telephone2 : '-', ENT_NOQUOTES) ?></td></tr>
                                        <tr><td>IČ</td>       <td><?php echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->reg_no, ENT_NOQUOTES) ?></td></tr>
                                        <tr><td>DIČ</td>      <td><?php echo Nette\Templating\Helpers::escapeHtml($translator_project->translator->tax_id_no, ENT_NOQUOTES) ?></td></tr>
                                        </table>
                                        <a class="close-reveal-modal">&#215;</a>
                                    </div>
                                </td>
                                <td class="no-wrap right"><?php echo Nette\Templating\Helpers::escapeHtml($template->number($translator_project->payment, 0, '.', ' '), ENT_NOQUOTES) ?> Kč</td>
<?php if ($project->status >= 2) { ?>
                                <td<?php echo ' id="' . ($_dynSnippetId = $_control->getSnippetId("accountTranslator-$translator_project->translator_id")) . '"' ?>>
<?php ob_start() ?>                                    <?php if ($translator_project->accounted == 0) { ?>
<a class="ajax mybutton b_account" href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("accountTranslator!", array($translator_project->translator_id, $translator_project->project_id)), ENT_COMPAT) ?>
">Vyúčtovat</a>
                                    <?php } else { ?><a class="mybutton b_account disabled" onclick="alert('Tomuto překladateli již byla odměna vyúčtována.');" href="<?php echo Nette\Templating\Helpers::escapeHtml($_control->link("Project:default"), ENT_COMPAT) ?>
">Vyúčtováno</a><?php } ?>

<?php $_dynSnippets[$_dynSnippetId] = ob_get_flush() ?>                                </td>
<?php } ?>
                            </tr>
<?php $iterations++; } ?>
                    </table>
                </td></tr>
                <tr><td>Obor</td><td><?php echo Nette\Templating\Helpers::escapeHtml($project->field->name, ENT_NOQUOTES) ?></td></tr>
                <tr><td>Datum vytvoření</td><td><?php echo Nette\Templating\Helpers::escapeHtml($template->date($project->start, 'j. n. Y - H'), ENT_NOQUOTES) ?> h</td></tr>
                <tr><td>Deadline</td><td><?php echo Nette\Templating\Helpers::escapeHtml($template->date($project->deadline, 'j. n. Y - H'), ENT_NOQUOTES) ?> h</td></tr>
                <tr><td>Fakturace (splatnost)</td><td><?php echo Nette\Templating\Helpers::escapeHtml($template->invoicing($project->customer->legal_form), ENT_NOQUOTES) ?>
 - <?php echo Nette\Templating\Helpers::escapeHtml($project->customer->due_date, ENT_NOQUOTES) ?> dní</td></tr>
                <tr><td>Zisk</td><td><?php echo Nette\Templating\Helpers::escapeHtml($project->income, ENT_NOQUOTES) ?> Kč</td></tr>
                <tr><td>Marže</td><td><?php echo Nette\Templating\Helpers::escapeHtml($project->income, ENT_NOQUOTES) ?> %</td></tr>
                <?php if ($project->invoice_id != NULL) { ?><tr><td>Faktura</td><td><a href="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>
/invoices/<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($project->invoice->year), ENT_COMPAT) ?>
/<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($project->invoice->filename), ENT_COMPAT) ?>
" title="Faktura <?php echo Nette\Templating\Helpers::escapeHtml($project->invoice->filename, ENT_COMPAT) ?>
" target="_blank"><img src="<?php echo Nette\Templating\Helpers::escapeHtml(Nette\Templating\Helpers::safeUrl($basePath), ENT_COMPAT) ?>
/images/pdf.png" alt="PDF"><?php echo Nette\Templating\Helpers::escapeHtml($project->invoice->filename, ENT_NOQUOTES) ?>
</a></td></tr><?php } ?>

                <tr><td>Poznámky</td><td><?php echo Nette\Templating\Helpers::escapeHtml($project->proj_notes, ENT_NOQUOTES) ?></td></tr>
            </table>
        </td>
    </tr>

<?php $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
    </tbody>
<?php if (isset($_dynSnippets)) return $_dynSnippets; 
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
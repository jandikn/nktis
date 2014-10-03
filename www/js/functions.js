//funkce pro skryvani a znovu zobrazovani polozek
function showHideDetail(projectID) {
	$('#'+projectID).toggle();
	$('#details_'+projectID).toggleClass('b_arrowdown');
}

//schovani vsech detailu
function hideAllDetail() {
	$('.hidden').hide();
}

//rozbaleni vsech detailu
function showAllDetail() {
	$('.hidden').show();
}

function showHideIdEl(id) {
    $('#'+id).toggle('fast');
}

function showHideClassEl(el) {
    $('.'+el).toggle('fast');
}

function showAndHide(hidden) {
  var zmena = document.getElementById(hidden).style;
  
  if(zmena.display === 'block') zmena.display = 'none';
  else zmena.display = 'block';
}

// povoleni elementu podle tridy
function enableElements(className) {
  $('.'+className).prop("disabled", false);
}

// zablokovani elementu podle tridy
function disableElements(className) {
  $('.'+className).prop("disabled", true);
}

// invertovat stav elementu podle id
function enableDisableIdEl(id) {
  var element = document.getElementById(id);
  return element.disabled ? element.disabled=false : element.disabled=true;
}

// zablokovani elementu podle id
function disableIdEl(id) {
  var element = document.getElementById(id);
  return element.disabled=true;
}

// uvolneni elekemntu podle id
function enableIdEl(id) {
  var element = document.getElementById(id);
  return element.disabled=false;
}

// enablovani cilovych jazyku 
function enableTargetLang(form) {
	if(!document[form].proj_type[1].checked) enableElements('target_lang');
}

// zruseni vyberu cilovych jazyku pro novy filtr prekladatelu 
function clearTargetLang(form) {
	var count = document[form]['target_lang[]'].length;
	for (i = 0; i < count; i++) {
		document[form]['target_lang[]'][i].checked=false;
	}
	
	// vynulovani prekladatelu
  $('.translator.td').addClass('hidden');
}

function showTranslators() {
	$('.translator.td').removeClass('hidden');
}

function hideTranslators() {
	$('.translator.td').addClass('hidden');
}

// funkce pro zablokovani prekladatelu, kteri nepodporuji dany jazyk
function enableTranslators(form) {
	var allHtmlTags = document.getElementsByTagName("*");
  var length = allHtmlTags.length;
  var wanted = false;
  
  
  for (i = 0; i < length; i++) {
    array = allHtmlTags[i].className.split(".");
    if (array[0] === 'translator') allHtmlTags[i].style.display = 'table-row-group';
	}
  
  // ziskani zdrojoveho jazyka
  var count = document[form].source_lang.length;
	var source_lang = '';
	for (i = 0; i < count; i++) {
		if(document[form].source_lang[i].checked) source_lang = document[form].source_lang[i].value;
	}
	
	// ziskani cilovych jazyku
	var count = document[form]['target_lang[]'].length;
	var target_lang = new Array();
	for (i = 0; i < count; i++) {
		if(document[form]['target_lang[]'][i].checked) target_lang.push(document[form]['target_lang[]'][i].value);
	}
	var length = target_lang.length;
	
	/*
	if($('.translator').hasClass(source_lang) && source_lang != 1) $('.translator.'+source_lang).removeClass('hidden');
	for(i=0; i<length; i++) {
		if($('.translator').hasClass(target_lang[i]) && target_lang[i] != 1) $('.translator.'+target_lang[i]).removeClass('hidden');
	}
	*/
	
	if(source_lang === 1) {
		for(i=0; i<length; i++) {
			if($('.translator').hasClass(target_lang[i]) && target_lang[i] !== 1 && $('.translator').hasClass(source_lang) ) $('.translator.'+target_lang[i]).removeClass('hidden');
		}
	}
	else {
		for(i=0; i<length; i++) {
			if($('.translator').hasClass(target_lang[i]) &&  $('.translator').hasClass(source_lang) ) $('.translator.'+source_lang+'.'+target_lang[i]).removeClass('hidden');
		}
	}
}

// funkce pro zablokovani prekladatelu, kteri nepodporuji dany jazyk pro korekturu

// pokud se jedna o korektoru, tak tato funkce vypise prekladatele hned na zaklade zdrojoveho jazyka
function enableTranslators2(form) {
	if(document[form].proj_type[1].checked) {
		var allHtmlTags = document.getElementsByTagName("*");
	  var length = allHtmlTags.length;
	  var wanted = false;
	  
	  
	  for (i = 0; i < length; i++) {
	    array = allHtmlTags[i].className.split(".");
	    if (array[0] === 'translator') allHtmlTags[i].style.display = 'table-row-group';
		}
	  
	  // ziskani zdrojoveho jazyka
	  var count = document[form].source_lang.length;
		var source_lang = '';
		for (i = 0; i < count; i++) {
			if(document[form].source_lang[i].checked) source_lang = document[form].source_lang[i].value;
		}
		
		if($('.translator').hasClass(source_lang)) $('.translator.'+source_lang).removeClass('hidden');
	}
	
}

// invertovani stavu elementu podle tridy
function enableDisable(className) {
	var allHtmlTags = document.getElementsByTagName("*");
	
	for (i = 0; i < allHtmlTags.length; i++) {
		if (allHtmlTags[i].className === className) {
			if (allHtmlTags[i].disabled === false) allHtmlTags[i].disabled = true;
			else allHtmlTags[i].disabled = false;
		}
	}
}

// zaskrtnuni checkboxu podle id
function checkIdElement(id) {
  document.getElementById(id).checked=true;
}

// zaskrtnuti checkboxu podle tridy
function checkElements(className) {
	var allHtmlTags = document.getElementsByTagName("*");

	for (i = 0; i < allHtmlTags.length; i++) {
		if (allHtmlTags[i].className === className) allHtmlTags[i].checked=true;
	}
}

// odskrtnuti elementu podle tridy
function uncheckElements(className) {
	var allHtmlTags = document.getElementsByTagName("*");

	for (i = 0; i < allHtmlTags.length; i++) {
		if (allHtmlTags[i].className === className) allHtmlTags[i].checked=false;
	}
}

// schovani elementu podle tridy
function hideElements(className) {
  $("."+className).hide();
}

// zobrazeni elementu podle tridy
function showElement(className) {
  $("."+className).show();
}

// schovani elementu podle id
function hideIdElement(id) {
  $("#"+id).hide();
}

// zobrazeni elementu podle id
function showIdElement(id) {
  $("#"+id).show();
}

//funkce pro zmenu menu a submenu
function changeSubmenu(submenu) {
	
	//schova aktualni submenu
	hideElements('hidden');
	
	//odstrani zvyrazneni menu
	//disHighlight('menu_button');
	
	//zvyrazni aktualni polozku
	//highlight(button);
	
	//zobrazi submenu k aktualni polozce
	onlyShow(submenu);
}

<?php namespace ProcessWire;

/**
 * Configuration function for FieldtypeFunctional field config
 * 
 * This is a commercial module, part of the ProcessWire ProFields package
 * DO NOT DISTRIBUTE
 *
 * ProcessWire 3.x, Copyright 2020 by Ryan Cramer
 * https://processwire.com
 * 
 * @param Field $field
 * @param InputfieldWrapper $inputfields
 * @return InputfieldWrapper
 * 
 */
function FieldtypeFunctionalConfigField(Field $field, InputfieldWrapper $inputfields) {
	
	$modules = $field->wire('modules');
	$textformatters = $modules->findByPrefix("Textformatter");
	
	// ---

	/** @var InputfieldFieldset $fieldset */	
	$fieldset = $modules->get('InputfieldFieldset');
	$fieldset->label = __('Files');
	$inputfields->add($fieldset);

	/** @var InputfieldRadios $in */
	$in = $modules->get('InputfieldRadios');
	$in->attr('name', 'fileMode');
	$in->label = __('File mode');
	$in->description = __('This field can manage editable text found in the template file of the page being viewed, or it can manage it from another file (or files) that you choose.');
	$in->description .= ' ' . __('Choose below what you would like this field to focus on:'); 
	$in->addOption(0, __('Template file of page being viewed'));
	$in->addOption(1, __('Other file(s) in /site/templates/'));
	$in->attr('value', (int) $field->get($in->name));
	$fieldset->add($in);

	/** @var InputfieldAsmSelect $in */
	$in = $modules->get('InputfieldAsmSelect');
	$in->attr('name', 'translateFiles');
	$in->label = __('What file(s) should this field look for text in?');
	$in->description = __('Warning: when using other files, we suggest that you add this field to only one (1) template and it should be editable on only one (1) page.');
	$in->description .= ' ' . __('Otherwise, you might have multiple pages competing to manage the same text.');
	$in->description .= ' ' . __('For instance, you might add this field to your homepage, or to some tools page for site-wide settings.'); 
	$files = $modules->wire('files')->find($modules->wire('config')->paths->templates, array(
		'extensions' => array('php', 'inc'),
		'excludeDirNames' => array('styles', 'scripts', 'js', 'css'),
		'returnRelative' => true
	));
	foreach($files as $file) {
		$in->addOption($file);
	}
	$value = $field->get('translateFiles');
	if(!is_array($value)) $value = array();
	$in->attr('value', $value);
	$in->showIf = 'fileMode=1';
	$fieldset->add($in);

	// ---

	/** @var InputfieldFieldset $fieldset */
	$fieldset = $modules->get('InputfieldFieldset');
	$fieldset->label = __('Text (single-line) field settings');
	$inputfields->add($fieldset);

	// ---

	/** @var InputfieldAsmSelect $tf */
	$tf = $modules->get('InputfieldAsmSelect');
	$tf->setAttribute('name', 'textFormatters');
	$tfLabel = __('Text formatters');
	$tf->label = $tfLabel;
	$tf->description = __('The “HTML Entity Encoder” is recommended for most cases.');
	foreach($textformatters as $name) {
		$info = $modules->getModuleInfo($name);
		$tf->addOption($name, "$info[title]");
	}
	$value = $field->get('textFormatters');
	$tf->attr('value', is_array($value) ? $value : array());
	$fieldset->add($tf);

	// ---

	/** @var InputfieldFieldset $fieldset */
	$fieldset = $modules->get('InputfieldFieldset');
	$fieldset->label = __('Textarea (multi-line) field settings');
	$inputfields->add($fieldset);

	$tf = clone $tf;
	$tf->attr('name', 'textareaFormatters');
	$tf->label = "$tfLabel (textarea)";
	$value = $field->get($tf->attr('name'));
	$tf->attr('value', is_array($value) ? $value : array());
	$fieldset->add($tf);

	/** @var InputfieldInteger $f */
	$f = $modules->get('InputfieldInteger');
	$f->attr('name', 'textareaRows');
	$f->label = __('Rows');
	$value = $field->get('textareaRows');
	$f->attr('value', $value ? $value : 5); 
	$fieldset->add($f);

	// ---
	
	$inheritLabel = __('Inherit settings from existing field');
	$inheritDesc = __('Because there can be a lot of settings associated with this type, you can inherit them from an existing field.');
	$inheritNotes = __('If no field is selected, then the default settings will be used.');

	$fieldset = $modules->get('InputfieldFieldset');
	$fieldset->label = __('Richtext (CKEditor) field settings');
	$inputfields->add($fieldset);

	/** @var InputfieldSelect $in */
	$in = $modules->get('InputfieldSelect');
	$in->attr('name', 'richtextSettingsField');
	$in->label = $inheritLabel;
	$in->description = $inheritDesc;
	$in->notes = $inheritNotes;
	foreach($modules->wire()->fields as $f) {
		if(!$f->type instanceof FieldtypeTextarea) continue;
		if(stripos($f->get('inputfieldClass'), 'InputfieldCKEditor') === false) continue;
		$in->addOption($f->name);
	}
	$in->attr('value', $field->get($in->name));
	$fieldset->add($in);

	// ---

	return $inputfields;
}
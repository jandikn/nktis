<?php

namespace App;
use Nette;


/**
 * Language Model.
 */
class LanguageModel extends Model
{

    public function getLanguages() {
		return $this->db->table('language')->order('name');
    }

    public function getLanguagesForNewProject() {
		return $this->db->table('language')->select('id,name,shortcut,icon');
    }

    public function getLanguagesForNewTranslator() {
		return $this->db->table('language')->select('id,name,shortcut,icon');
    }
    
    public function deactivateLanguage($id) {
        die('ok');
        return $this->db->query('UPDATE languages SET active=? WHERE id=?', 0, $id);
    }
    
    public function newLanguage($values) {
        $this->db->table('language')->insert(array(
            'name' => $values->name,
            'instrumental_case' => $values->instrumental_case,
            'url_name' => $values->url_name,
            'shortcut' => $values->shortcut,
            'icon' => $values->icon->name,
            'flag' => $values->flag->name,
            'picture1' => $values->picture1->name,
            'picture2' => $values->picture2->name,
            'translation_price' => $values->translation_price,
            'proofreading_price' => $values->proofreading_price,
            'interpretation_price' => $values->interpretation_price,
            'language_sentence' => $values->language_sentence,
            'about_language' => $values->about_language,
            'active' => $values->active
        ));
    }

    public function editLanguage($id) {
		return $this->db->table('language')->get($id);
    }
}

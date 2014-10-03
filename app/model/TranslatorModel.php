<?php

namespace App;
use Nette;


/**
 * Translator Model.
 */
class TranslatorModel extends Model
{

    public function getTranslators()
    {
            return $this->db->table('translator')->where('active', 1)->order('surname');
    }

    public function getManagers()
    {
            return $this->db->table('translator')->where('post_id <= ?', 2);
    }

    public function getMyProfile($myId) {
            return $this->db->table('translator')->get($myId);
    }

    public function newTranslator($values) {        
        // kontaktni udaje prekladatele
        /*
        $row = $this->db->table('translator')->insert(array(
            'title' => $values->title,
            'name' => $values->name,
            'surname' => $values->surname,
            'email' => $values->email ,
            'tel_preset' => $values->tel_preset,
            'telephone' => $values->telephone,
            'address' => $values->address,
            'postcode' => $values->postcode,
            'city' => $values->city ,
            'reg_no' => $values->reg_no,
            'tax_id_no' => $values->tax_id_no,
            'profile_pic' => $values->profile_pic->name,
            'cv' => $values->cv->name,
            'notes' => $values->notes,
            'cv' => $values->name
        ));
        
        $translator_id = $row->id;
        
        // ovladane obory
        foreach($values->field as $field) {
            $this->db->table('translator_field')->insert(array(
                'translator_id' => $translator_id,
                'field_id' => $field
            ));
        }
        */
        // ovladane jazyky a ceny
        foreach($values->languages as $language) {
            if($language == $values->native_language) {
                $native_language = 1;
            }
            else {
                $native_language = 0;
            }
            /*
            if($values->translation_price_.$language != "") {
                $translation_price = $values->translation_price_.$language;
            }
            else {
                $translation_price = 0;
            }
            
            if($values->proofreading_price_.$language != "") {
                $proofreading_price = $values->proofreading_price_.$language;
            }
            else {
                $proofreading_price = 0;
            }
            
            if($values->interpretation_price_.$language != "") {
                $interpretation_price = $values->interpretation_price_.$language;
            }
            else {
                $interpretation_price = 0;
            }
            */
        
            $this->db->table('translator_language')->insert(array(
                //'translator_id' => $translator_id,
                
                'language_id' => $language,
                'native_language' => $native_language,
                'translation_price' => $values->translation_price_.$language,
                'proofreading_price' => $proofreading_price,
                'interpretation_price' => $interpretation_price
            ));
        }
        
    }

    public function editTranslator($id) {
            return $this->db->table('translator')->get($id);
    }

    public function deleteTranslator($id) {
            return $this->db->table('translator')->get($id)->delete();
    }
    
    public Function getCatTools() {
            return $this->db->table('cat_tool');
    }
    
}

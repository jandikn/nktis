<?php

namespace App;
use Nette;


/**
 * Field Model.
 */
class FieldModel extends Model
{

    public function getFieldsForNewProject() {
		return $this->db->table('field')->select('id,name');
    }

    public function getFields() {
		return $this->db->table('field')->select('id,name,url_name,specification,priority')->order('priority');
    }

    public function newField($values) {
		$this->db->table('field')->insert($values);
		return;
    }

    public function editField($id) {
		return $this->db->table('field')->get($id);
    }

    public function deleteField($id) {
		return $this->db->table('field')->get($id)->delete();
    }

    
}

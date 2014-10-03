<?php

namespace App;
use Nette;


/**
 * Customer Model.
 */
class CustomerModel extends Model
{

    public function getCustomers() {
        return $this->db->table('customer')->where('active',1);
        //return $this->db->query('SELECT *, SUM(project.price) FROM customer LEFT JOIN project ON customer.id = project.customer_id');
    }

    public function getBlacklistCustomers() {
        return $this->db->table('customer')->where('active',0);
    }

    public function newCustomer($values) {
        $this->db->table('customer')->insert($values);
	return;
    }

    public function editCustomer($id) {
        return $this->db->table('customer')->get($id);
    }

    public function deleteCustomer($id) {
        return $this->db->query('UPDATE customer SET active=0 WHERE id=?', $id);
    }

    public function activateCustomer($id) {
        return $this->db->query('UPDATE customer SET active=1 WHERE id=?', $id);
    }

    public function getCustomersForNewProject() {
        return $this->db->table('customer')->select('id,name,surname,company')->where('active', 1)->order('company')->order('surname');
    }
    
}

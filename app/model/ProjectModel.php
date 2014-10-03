<?php

namespace App;
use Nette;


/**
 * Project Model.
 */
class ProjectModel extends Model
{

    public function getUnfinishedProjects() {
        return $this->db->table('project')->where('status <= ?', 4)->order('status')->order('deadline');
    }

    // projekty pro fakturaci
    public function getProjectsForInvocing() {
        return $this->db->table('project')->where('status', 2)->group('customer_id')->order('deadline');
    }
    
    // projekty pro fakturaci
    public function getArchiveProjects($year) {
        return $this->db->table('project')->where('status', 5)->where('invoice_date LIKE ?', $year.'%')->order('deadline');
    }

    // aktivace projektu
    public function activateProject($id) {
        return $this->db->table('project')->where('id', $id)->update(array('status' => 1));
    }

    // projekt dokoncen
    public function projectFinished($id) {
        return $this->db->table('project')->where('id', $id)->update(array('status' => 2));
    }
    
    // ulozeni jedne faktury
    public function saveSingleUploadedInvoice($project_id, $year, $file) {
        $this->db->query('INSERT INTO invoice', array( 
            'project_id' => $project_id,
            'filename' => $file,
            'year' => $year
        ));
        return;
    }
    
    // nastaveni datumu fakturace u projektu
    public function setInvoiceDate($project_id) {
        $this->db->table('project')->where('id', $project_id)->update(Array('invoice_date' => date('Y-m-d')));
        $this->db->table('project')->where('id', $project_id)->update(array('status' => 3));
        return;
    }

    // projekt zaplacen
    public function projectdPaid($id) {
        return $this->db->table('project')->where('id', $id)->update(array('status' => 4));
    }
    
    // vyuctovani prekladatele
    public function accountTranslator($translator_id, $project_id) {
        return $this->db->table('translator_project')->where('translator_id', $translator_id)->where('project_id', $project_id)->update(array('accounted' => 1));
    }

    // projekt vyuctovan
    public function projectdAccounted($id) {
        return $this->db->table('project')->where('id', $id)->update(array('status' => 5));
    }
    
    // zruseni projektu
    public function cancelProject($id, $reason) {
        $this->db->table('project')->where('id', $id)->update(array('status' => '6'));
        $this->db->table('project')->where('id', $id)->update(array('reason_of_cancellation' => $reason));
        return;
    }
    
    
}

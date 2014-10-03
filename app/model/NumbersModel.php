<?php

namespace App;
use Nette;


/**
 * Numbers Model.
 */
class NumbersModel extends Model
{

    /** 
     * FIREMNI UDAJE
     */
    public function getNumberOfActiveTranslators() {
        return $this->db->table('translator')->where('active', 1)->count('*');
    }

    public function getNumberOfInactiveTranslators() {
        return $this->db->table('translator')->where('active', 0)->count('*');
    }
    
    public function getNumberOfCustomers() {
        return $this->db->table('customer')->count('*');
    }
    
    public function getNumberOfLanguages() {
        return $this->db->table('language')->count('*');
    }
    
    public function getNumberOfFields() {
        return $this->db->table('field')->count('*');
    }
    
    /** 
     * CELKOVE UDAJE
     */
    public function getNumberOfFinishedProjects() {
        return $this->db->table('project')->where('status', 5)->count('*');
    }
    
    public function getNumberOfCancelledProjects() {
        return $this->db->table('project')->where('status', 6)->count('*');
    }
    
    public function getTotalSales() {
        return $this->db->table('project')->sum('price');
    }
    
    public function getTotalIncome() {
        $prijmy = $this->db->table('project')->sum('price');
        $vydaje = $this->db->table('translator_project')->sum('payment');
        return $prijmy - $vydaje;
    }
    
    public function getTotalPartnersIncome() {
        return $this->db->table('translator_project')->where('accounted', 1)->where('translator_id=? OR translator_id=?', 1, 2)->sum('payment');
    }
    
    public function getTotalMargin() {
        return $this->db->table('project')->where('status=? OR status=? OR status=?', 4, 5, 8)->sum('price');
    }
    
    public function getTotalObligations() {
        return $this->db->table('project')->where('status', 2)->sum('price');
    }
    
    public function getTotalDebts() {
        return $this->db->table('translator_project')->where('accounted', 0)->sum('payment');
    }


    /** 
     * ROCNI UDAJE 
     */
    public function getNumberOfYearsProjects($year) {
        return $this->db->table('project')->where('invoice_date LIKE ?', $year.'%')->count('*');
    }

    public function getYearsSales($year) {
        return $this->db->table('project')->where('status=? OR status=? OR status=?', 4, 5, 8)->where('invoice_date LIKE ?', $year.'%')->sum('price');
    }

    public function getYearsIncome($year) {
        $prijmy = $this->db->table('project')->where('status=? OR status=? OR status=?', 4, 5, 8)->where('invoice_date LIKE ?', $year.'%')->sum('price');
        $data_projects = $this->db->table('project')->select('id')->where('invoice_date LIKE ?', $year.'%');
        
        $projects = array();
        foreach ($data_projects as $proj_id) {
            array_push($projects, $proj_id);
        }

        $vydaje = $this->db->table('translator_project')->where('project_id', $this->db->table('project')->select('id')->where('invoice_date LIKE ?', $year.'%'))->sum('payment');

        return $prijmy - $vydaje;
    }

    public function getYearsPartnersIncome($year) {
        return $this->db->table('translator_project')->where('translator_id < ?', 3)->where('project_id', $this->db->table('project')->select('id')->where('invoice_date LIKE ?', $year.'%'))->sum('payment');
    }

    public function getYearsObligations($year) {
        return $this->db->table('translator_project')->where('accounted', 0)->sum('payment');
    }

    public function getYearsDebts($year) {
        return $this->db->table('translator_project')->where('accounted', 0)->sum('payment');
    }

    /** 
     * MESICNI UDAJE
     */
    public function getMonthNumbers($year) {
        return $this->db->table('project')->where('invoice_date LIKE ?', $year.'%');
    }

    public function getNumberOfMonthProjects($year, $month) {
        return $this->db->table('project')->where('status=? OR status=? OR status=?', 4, 5, 8)->where('invoice_date LIKE ?', $year.'-'.$month.'%')->count('*');
    }

    public function getNumberOfMonthCancelledProjects($year, $month) {
        return $this->db->table('project')->where('status', 6)->where('invoice_date LIKE ?', $year.'-'.$month.'%')->count('*');
    }

    public function getMonthSales($year, $month) {
        return $this->db->table('project')->where('status=? OR status=? OR status=?', 4, 5, 8)->where('invoice_date LIKE ?', $year.'-'.$month.'%')->sum('price');
    }

    public function getMonthIncome($year, $month) {
        $prijmy = $this->db->table('project')->where('status=? OR status=? OR status=?', 4, 5, 8)->where('invoice_date LIKE ?', $year.'-'.$month.'%')->sum('price');
        $vydaje = $this->db->table('translator_project')->where('project_id', $this->db->table('project')->select('id')->where('invoice_date LIKE ?', $year.'-'.$month.'%'))->sum('payment');
        return $prijmy - $vydaje;
    }

    public function getMonthPartnersIncome($year, $month) {
        //$prijmy = $this->db->table('project')->where('accounted', 1)->where('translator_id=? OR translator_id=?', 1, 2)->where('invoice_date LIKE ?', $year.'-'.$month.'%')->sum('payment');
        //$vydaje = $this->db->table('translator_project')->where('accounted', 1)->where('translator_id=? OR translator_id=?', 1, 2)->where('project_id', $this->db->table('project')->select('id')->where('invoice_date LIKE ?', $year.'-'.$month.'%'))->sum('payment');
        //return $prijmy - $vydaje;
        return 0;
    }

    public function getMonthMargin($year, $month) {
        return $this->db->table('translator_project')->where('accounted', 1)->where('invoice_date LIKE ?', $year.'-'.$month.'%')->sum('payment');
    }

    public function getMonthObligations($year, $month) {
        return $this->db->table('translator_project')->where('accounted', 1)->where('invoice_date LIKE ?', $year.'-'.$month.'%')->sum('payment');
    }

    public function getMonthDebts($year, $month) {
        return $this->db->table('translator_project')->where('accounted', 0)->where('invoice_date LIKE ?', $year.'-'.$month.'%')->sum('payment');
    }

    

    
}

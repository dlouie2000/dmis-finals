<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function yearlyTotalQuantity() 
    {
        $query = $this->db->query("SELECT SUM(productQuantity) as count FROM productrecord GROUP BY YEAR(DateTime) ORDER BY YEAR(DateTime)");
        $data = json_encode(array_column($query->result(), 'count'),JSON_NUMERIC_CHECK);
        return $data;
    } 
    public function getYear()
    {
        return $this->db->select('YEAR(DateTime) as year')->distinct()->order_by('year', 'asc')->get('productrecord')->result();
    }
}
?>
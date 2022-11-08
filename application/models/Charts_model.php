<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class charts_model extends CI_Model {

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
    public function monthTotalQuantity() 
    {
        $query = $this->db->query("SELECT SUM(productQuantity) AS count, MONTH(DateTime) AS month, YEAR(DateTime) as year
        FROM productrecord 
        WHERE YEAR(DateTime) = ".date('Y')."
        GROUP BY month
        ORDER BY month ASC");
        $data = json_encode(array_column($query->result(), 'count'),JSON_NUMERIC_CHECK);
        return $data;
    } 
    public function getMonth()
    {
        return $this->db->select('DateTime, MONTH(DateTime) AS month, YEAR(DateTime) AS year')->where('YEAR(DateTime)', date('Y'))->group_by('month')->order_by('month', 'asc')->get('productrecord')->result();
    }
}
?>
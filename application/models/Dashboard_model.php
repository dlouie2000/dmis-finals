<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Dashboard_model extends CI_Model {

        public function totalStockQuantity()
        {
            return $this->db->select('SUM(productQuantity) as stock')->get('productrecord')->result();
        }

        public function requestToBeApproved()
        {
            return $this->db->select('COUNT(approveDateTime) as request')->where('reqproductStatus = "Pending"')->get('reqproductrecord')->result();
        }

        public function totalProductsReleased()
        {
            return $this->db->select('COUNT(productId) as released')->where('YEAR(approveDateTime)', date('Y'))->get('reqproductrecord')->result();
        }

        public function totalNumberOfProducts()
        {
            return $this->db->select('COUNT(productId) as totNum')->get('productrecord')->result();
        }






        // REFERENCE
        // public function yearlyTotalQuantity() 
        // {
        //     $query = $this->db->query("SELECT SUM(productQuantity) as count FROM productrecord GROUP BY YEAR(DateTime) ORDER BY YEAR(DateTime)");
        //     $data = json_encode(array_column($query->result(), 'count'),JSON_NUMERIC_CHECK);
        //     return $data;
        // } 
        // public function getYear()
        // {
        //     return $this->db->select('YEAR(DateTime) as year')->distinct()->order_by('year', 'asc')->get('productrecord')->result();
        // }
    }
?>
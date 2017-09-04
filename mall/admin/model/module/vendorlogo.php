<?php
class ModelModuleVendorLogo extends Model {
    public function getTotalVendors($data = array()) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vendors");
		return $query->rows;
	}
	
	 public function getSEOKeyword($vendor_id) {
		$query = $this->db->query("SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'vendor_id=" . (int)$vendor_id . "'");
		if ($query->row) {
			return $query->row;
		} else {
			return false;
		}
	}
	
	public function getVendorsName($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "vendors";

		if (!empty($data['filter_name'])) {
			$sql .= " WHERE vendor_name LIKE '" . $this->db->escape($data['filter_name']) . "%' ORDER BY vendor_name DESC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getVendor($vendor_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vendors WHERE vendor_id = '" . (int)$vendor_id . "'");
		if ($query->row) {
			return $query->row;
		} else {
			false;
		}
	}
}
<?php
class ModelCatalogMVDCategoryCommission extends Model {
	public function updateComCat($data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "commission_category");
		
		if (isset($data['commission_category'])) {
			foreach ($data['commission_category'] as $comcat) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "commission_category SET category_id = '" . (int)$this->db->escape($comcat['category_id']) . "', commission_rate = '" . $this->db->escape($comcat['commission_rate']) . "'");
			}
		}
	}
	
	public function getCategoryCommission() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "commission_category");
		
		if ($query->rows) {
			return $query->rows;
		} else {
			return false;
		}
	}
}
?>
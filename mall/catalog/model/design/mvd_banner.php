<?php
class ModelDesignMVDBanner extends Model {
	public function getBanner($banner_id,$vendor_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image bi LEFT JOIN " . DB_PREFIX . "banner_image_description bid ON (bi.banner_image_id  = bid.banner_image_id) LEFT JOIN " . DB_PREFIX . "banner b ON (b.banner_id = bi.banner_id) WHERE bi.banner_id = '" . (int)$banner_id . "' AND vendor_id = '" . (int) $vendor_id . "' AND bid.language_id = '" . (int)$this->config->get('config_language_id') . "' AND b.status = '1' ORDER BY bi.sort_order ASC");

		return $query->rows;
	}
}
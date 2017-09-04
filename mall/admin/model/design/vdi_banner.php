<?php
class ModelDesignVDIBanner extends Model {

	public function editBanner($banner_id, $data) {
		$this->event->trigger('pre.admin.banner.edit', $data);
		
		$this->db->query("DELETE bid FROM " . DB_PREFIX . "banner_image_description bid LEFT JOIN " . DB_PREFIX . "banner_image bi ON (bid.banner_image_id = bi.banner_image_id) WHERE bid.banner_id = '" . (int)$banner_id . "' AND bi.vendor_id = '" .  (int)$this->user->getVP() . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "banner_image WHERE banner_id = '" . (int)$banner_id . "' AND vendor_id = '" . (int)$this->user->getVP() . "'");
		

		if (isset($data['banner_image'])) {
			foreach ($data['banner_image'] as $banner_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "banner_image SET banner_id = '" . (int)$banner_id . "', link = '" .  $this->db->escape($banner_image['link']) . "', image = '" .  $this->db->escape($banner_image['image']) . "', banner_width = '" .  $this->db->escape($banner_image['banner_width']) . "', banner_height = '" .  $this->db->escape($banner_image['banner_height']) . "', vendor_id = '" .  (int)$this->user->getVP() . "', sort_order = '" . (int)$banner_image['sort_order'] . "'");

				$banner_image_id = $this->db->getLastId();

				foreach ($banner_image['banner_image_description'] as $language_id => $banner_image_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "banner_image_description SET banner_image_id = '" . (int)$banner_image_id . "', language_id = '" . (int)$language_id . "', banner_id = '" . (int)$banner_id . "', title = '" .  $this->db->escape($banner_image_description['title']) . "'");
				}
			}
		}

		$this->event->trigger('post.admin.banner.edit', $banner_id);
	}

	public function getBanner($banner_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "banner b LEFT JOIN " . DB_PREFIX . "banner_image bi ON (b.banner_id = bi.banner_id) WHERE b.banner_id = '" . (int)$banner_id . "' AND bi.vendor_id = '" . (int)$this->user->getVP() . "'");

		return $query->row;
	}

	public function getBanners($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "banner WHERE banner_sort > 0";

		$sort_data = array(
			'name',
			'banner_sort',
			'status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}
		
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
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

	public function getBannerImages($banner_id) {
		$banner_image_data = array();

		$banner_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image WHERE banner_id = '" . (int)$banner_id . "' AND vendor_id = '" . (int)$this->user->getVP() . "' ORDER BY sort_order ASC");

		foreach ($banner_image_query->rows as $banner_image) {
			$banner_image_description_data = array();

			$banner_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image_description WHERE banner_image_id = '" . (int)$banner_image['banner_image_id'] . "' AND banner_id = '" . (int)$banner_id . "'");

			foreach ($banner_image_description_query->rows as $banner_image_description) {
				$banner_image_description_data[$banner_image_description['language_id']] = array('title' => $banner_image_description['title']);
			}

			$banner_image_data[] = array(
				'banner_image_description' => $banner_image_description_data,
				'link'                     => $banner_image['link'],
				'image'                    => $banner_image['image'],
				'banner_width'             => $banner_image['banner_width'],
				'banner_height'            => $banner_image['banner_height'],
				'vendor_id'				   => $banner_image['vendor_id'],
				'sort_order'               => $banner_image['sort_order']
			);
		}

		return $banner_image_data;
	}

	public function getTotalBanners() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "banner WHERE banner_sort > 0");

		return $query->row['total'];
	}
	
	public function getVendors($data = array()) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vendors v ORDER BY v.vendor_name");
		$vendors_data = $query->rows;
		return $vendors_data;
		$this->cache->set('vendors', $vendors_data);
	}
	
	public function getValidBanners() {
	
		$query = $this->db->query("SELECT banner_id FROM " . DB_PREFIX . "banner WHERE banner_sort > 0");
		
		$banner_data = array();
		
		if ($query->rows) {
			foreach ($query->rows as $banner) {
				$banner_data[] = $banner['banner_id'];
			}
			return $banner_data;
		} else {
			return false;
		}
	}
	
}
<?php
class ModelAccountReward extends Model {
	public function getRewards($data = array()) {
	include($_SERVER['DOCUMENT_ROOT']."/pdo_cmg.php");
		$sql = "SELECT * FROM r_cash WHERE number = '" . $this->customer->getNumber() . "'";

		$sort_data = array(
			'csum',
			'note',
			'date',
			'id'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY id";
		} else {
			$sql .= " ORDER BY id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " DESC";
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


		$stmt = $pdo_cmg->query($sql);
		$query = $stmt->fetchAll();
		return $query;

		
	}

	public function getTotalRewards() {
	include($_SERVER['DOCUMENT_ROOT']."/pdo_cmg.php");
		$query = $pdo_cmg->query("SELECT COUNT(*) AS total FROM r_cash WHERE number = '" . $this->customer->getNumber() . "'");
		$query = $query->fetch();

		return $query['total'];
	}

	public function getTotalPoints() {
	include($_SERVER['DOCUMENT_ROOT']."/pdo_cmg.php");
		$query = $pdo_cmg->query("SELECT csum AS total FROM r_cash WHERE number = '" . $this->customer->getNumber() . "' ORDER BY id DESC limit 1");
		$query = $query->fetch();

		if ($query->num_rows) {
			return $query['total'];
		} else {
			return 0;
		}
	}
}
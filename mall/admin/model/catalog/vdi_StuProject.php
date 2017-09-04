<?php
class ModelCatalogVDIStuProject extends Model {
	
	public function getProducts($vendor_id){
				
		$sql = $this->db->query("SELECT * FROM `oc_StuProduct` sp
								 LEFT JOIN `oc_product_description` pd ON `sp`.`product_id` = `pd`.`product_id`
                                 LEFT JOIN `oc_product` p ON `sp`.`product_id` = `p`.`product_id`
								 WHERE `sp`.`Student_id` = " . $vendor_id
								);
		
		return $sql->rows;
	}
	
	
	public function getAllProducts(){
		$sql = $this->db->query("SELECT `pd`.`name`,`p`.`price`,`p`.`quantity`,`p`.`image`,`pd`.`StuLevel`,`p`.`product_id` FROM `oc_product` p 
								LEFT JOIN `oc_product_description` pd ON `p`.`product_id` = `pd`.`product_id`
								");
		return $sql->rows;
	}
	
	public function addProducts($ProductId,$vendor_id){
		
		$sql = $this->db->query("INSERT INTO `oc_StuProduct` SET `student_id` =" . $vendor_id . " , `product_id` = " . $ProductId);
	}
	public function deleteProducts($ProductId,$vendor_id){
		$sql = $this->db->query("DELETE FROM `oc_StuProduct` WHERE `student_id` =" . $vendor_id . " AND `product_id` = " . $ProductId);
	}
	public function getVendor(){
		$sql = $this->db->query("SELECT * FROM `oc_vendors` WHERE `user_id` = " . $this->user->getId());
		return $sql->row;
	}
}
?>
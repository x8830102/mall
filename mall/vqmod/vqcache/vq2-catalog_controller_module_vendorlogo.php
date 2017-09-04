<?php
class ControllerModuleVendorLogo extends Controller {
	public function getVendorInfo() {
    	$this->load->language('module/vendorlogo');

    	$this->document->setTitle($this->language->get('heading_vendor_info')); 
		
		
			$data['heading_title'] = $this->language->get('heading_vendor_info');
			
		$data['text_name'] = $this->language->get('text_name');
		$data['text_store_url'] = $this->language->get('text_store_url');
		$data['text_company'] = $this->language->get('text_company');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_firstname'] = $this->language->get('text_firstname');
		$data['text_lastname'] = $this->language->get('text_lastname');
		$data['text_address_1'] = $this->language->get('text_address_1');
		$data['text_address_2'] = $this->language->get('text_address_2');
		$data['text_city'] = $this->language->get('text_city');
		$data['text_postcode'] = $this->language->get('text_postcode');
		$data['text_zone'] = $this->language->get('text_zone');
		$data['text_country'] = $this->language->get('text_country');
		$data['text_description'] = $this->language->get('text_description');
		$data['button_view_all_products'] = $this->language->get('button_view_all_products');
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),			
			'separator' => false
		);
		
		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_vendors'),
			'href'      => $this->url->link('module/vendorlogo/getVendors'),			
			'separator' => $this->language->get('text_separator')
		);
		
		$this->load->model('catalog/vendorlogo');
		
    	$result = $this->model_catalog_vendorlogo->getVendor($this->request->get['vendor_id']);
	
		if ($result) {
			
			$this->load->model('tool/image');
			
			if ($result['vendor_image']) {
				$image = $this->model_tool_image->resize($result['vendor_image'], $this->config->get('mvd_logo_vw_image'), $this->config->get('mvd_logo_vh_image'));
			} else {
				$image = false;
			}
			
			$this->load->model('localisation/country');
			$country = $this->model_localisation_country->getCountry($result['country_id']);
			
			$this->load->model('localisation/zone');
			$zone = $this->model_localisation_zone->getZone($result['zone_id']);
			
			$data['vendor_id']		=	(int)$result['vendor_id'];
			$data['thumb']			=   $image;
			$data['vendor_name']	= 	$result['vendor_name'];
			$data['store_url']		=	$result['store_url'];
			$data['company']   		=	$result['company'];
			$data['telephone']   	=	$result['telephone'];
			$data['fax']   			=	$result['fax'];
			$data['email']   		=	$result['email'];
			$data['firstname']   	=	$result['firstname'];
			$data['lastname']   	=	$result['lastname'];
			$data['address_1']   	=	$result['address_1'];
			$data['address_2']   	=	$result['address_2'];
			$data['city']   		=	$result['city'];
			$data['postcode']   	=	$result['postcode'];
			$data['zone']   		=	isset($zone['name']) ? $zone['name'] : $this->language->get('text_none');
			$data['country']   		=	$country['name'];
			$data['description']  	=	isset($result['vendor_description']) ? $result['vendor_description'] : $this->language->get('text_none');
			$data['href']			=	$this->url->link('module/vendorlogo/visitstore', 'vendor_id=' . (int)$result['vendor_id']);
		
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/vendor.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/vendor.tpl', $data);
		} else {
			return $this->load->view('default/template/module/vendor.tpl', $data);
		}
  	}
	
	public function getVendors() {
    	$this->language->load('module/vendorlogo');
		
		$this->document->setTitle($this->language->get('heading_title_all_vendors'));
		$this->document->setDescription($this->language->get('heading_title_all_vendors'));
		$this->document->setKeywords($this->language->get('heading_title_all_vendors'));
		
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'vendor_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_product_limit');
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),			
			'separator' => false
		);
		
		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_vendors'),
			'href'      => $this->url->link('module/vendorlogo/getVendors'),			
			'separator' => $this->language->get('text_separator')
		);
		
		$url = '';
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
			
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
		
      	$data['heading_title'] = $this->language->get('heading_title_all_vendors');
		
		$data['text_limit'] = $this->language->get('text_limit');
		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_feedback'] = $this->language->get('text_feedback');	
		$data['text_order'] = $this->language->get('text_order');
		$data['text_sort'] = $this->language->get('text_sort');
		$data['text_limit'] = $this->language->get('text_limit');
		$data['text_display'] = $this->language->get('text_display');
		
		$data['button_allvendors'] = $this->language->get('button_allvendors');
		$data['button_list'] = $this->language->get('button_list');
		$data['button_grid'] = $this->language->get('button_grid');
		$data['button_continue'] = $this->language->get('button_continue');
				
		$this->load->model('catalog/vendorlogo');
		$this->load->model('tool/image');

		$data['vendor_data'] = array();		
		$vendors = array();
		$totalVendor = 0;
		
		if ($this->config->get('mvd_logo_vendors_selected')) {
			$vendors = $this->config->get('mvd_logo_vendors_selected');		
		} else {
			$getIDs = $this->model_catalog_vendorlogo->getDefaultVendorsID();
			if ($getIDs) {
				foreach ($getIDs as $getID) {
					$vendors[] = $getID['vendor_id'];
				}
			}
		}
		
		$filter_data = array(
			'vendors'	=> $vendors,
			'start'		=> ($page - 1) * $limit,
			'sort'      => $sort,
			'order'     => $order,
			'limit'     => $limit
		);
		
		$totalVendor = sizeof($vendors);
		
		if ($totalVendor) {
			$results = $this->model_catalog_vendorlogo->getTheVendors($filter_data);
			
			foreach ($results as $result) {
				if ($result['vendor_image']) {
					$image = $this->model_tool_image->resize($result['vendor_image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('no_image.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}				
				
				$preBool = $this->model_catalog_vendorlogo->preCheck();
				$total_feedback = $this->model_catalog_vendorlogo->getTotalFeedback($result['vendor_id']);
			
				if ($preBool) {
					$total_order = $this->model_catalog_vendorlogo->getTotalVendorOrders($result['vendor_id']);
				} else {
					$total_order = $this->model_catalog_vendorlogo->getOldTotalVendorOrders($result['vendor_id']);
				}
				
				$data['vendor_data'][] = array(
					'vendor_id' 	=> (int)$result['vendor_id'],
					'thumb'   	 	=> $image,
					'name'   		=> $result['vendor_name'],
					'rating'		=> $result['rating'],
					'description'	=> utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
					'review'		=> $this->language->get('text_feedback') . ' (' . $total_feedback . ') | ' . $this->language->get('text_order') . ' (' . $total_order . ')',
					'href'    	 	=> $this->url->link('module/vendorlogo/visitstore', 'vendor_id=' . (int)$result['vendor_id'])
				);
			}
		}

		$url = '';

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$data['sorts'] = array();

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_default'),
			'value' => 'vendor_id-ASC',
			'href'  => $this->url->link('module/vendorlogo/getVendors', '&sort=vendor_id&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_name_asc'),
			'value' => 'vendor_name-ASC',
			'href'  => $this->url->link('module/vendorlogo/getVendors', '&sort=vendor_name&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_name_desc'),
			'value' => 'vendor_name-DESC',
			'href'  => $this->url->link('module/vendorlogo/getVendors', '&sort=vendor_name&order=DESC' . $url)
		);

		if ($this->config->get('config_review_status')) {
			$data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_desc'),
				'value' => 'rating-DESC',
				'href'  => $this->url->link('module/vendorlogo/getVendors', '&sort=rating&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_asc'),
				'value' => 'rating-ASC',
				'href'  => $this->url->link('module/vendorlogo/getVendors', '&sort=rating&order=ASC' . $url)
			);
		}

		$url = '';
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['limits'] = array();

		$limits = array_unique(array($this->config->get('config_product_limit'), 25, 50, 75, 100));

		sort($limits);

		foreach($limits as $value) {
			$data['limits'][] = array(
				'text'  => $value,
				'value' => $value,
				'href'  => $this->url->link('module/vendorlogo/getVendors', $url . '&limit=' . $value)
			);
		}

		$url = '';

		if (isset($this->request->get['filter'])) {
			$url .= '&filter=' . $this->request->get['filter'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
		
		$pagination = new Pagination();
		$pagination->total = $totalVendor;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('module/vendorlogo/getVendors', $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($totalVendor) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($totalVendor - $limit)) ? $totalVendor : ((($page - 1) * $limit) + $limit), $totalVendor, ceil($totalVendor / $limit));

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mvd_vendors.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/module/mvd_vendors.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/module/mvd_vendors.tpl', $data));
		}
  	}
	

			public function getStoreCategory() {
				
				$this->language->load('module/vendorlogo');
				$data['text_empty'] = $this->language->get('text_empty');			
				$data['text_tax'] = $this->language->get('text_tax');
				$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
				$data['text_display'] = $this->language->get('text_display');
				$data['text_list'] = $this->language->get('text_list');
				$data['text_grid'] = $this->language->get('text_grid');
				$data['text_sort'] = $this->language->get('text_sort');
				$data['text_limit'] = $this->language->get('text_limit');
				$data['text_refine'] = $this->language->get('text_refine');
									
				$data['button_cart'] = $this->language->get('button_cart');
				$data['button_wishlist'] = $this->language->get('button_wishlist');
				$data['button_compare'] = $this->language->get('button_compare');
				$data['button_continue'] = $this->language->get('button_continue');
				$data['button_list'] = $this->language->get('button_list');
				$data['button_grid'] = $this->language->get('button_grid');
				
				$this->load->model('catalog/vdi_s_category'); 
				$this->load->model('catalog/vendorlogo');
				
				$this->load->model('tool/image');
				
				if (isset($this->request->get['filter'])) {
					$filter = $this->request->get['filter'];
				} else {
					$filter = '';
				}
				
				if (isset($this->request->get['sort'])) {
					$sort = $this->request->get['sort'];
				} else {
					$sort = 'p.sort_order';
				}

				if (isset($this->request->get['order'])) {
					$order = $this->request->get['order'];
				} else {
					$order = 'ASC';
				}
			
				if (isset($this->request->get['vendor_id'])) {
					$vendor_id = $this->request->get['vendor_id'];
				} else {
					$vendor_id = '0';
				}
				
				if (isset($this->request->get['page'])) {
					$page = $this->request->get['page'];
				} else { 
					$page = 1;
				}
				
				if (isset($this->request->get['limit'])) {
					$limit = $this->request->get['limit'];
				} else {
					$limit = $this->config->get('config_product_limit');
				}
				
				$data['breadcrumbs'] = array();

				$data['breadcrumbs'][] = array(
					'text' => $this->language->get('text_home'),
					'href' => $this->url->link('common/home')
				);

				$data['breadcrumbs'][] = array(
					'text'      => $this->language->get('text_vendors'),
					'href'      => $this->url->link('module/vendorlogo/getVendors'),			
					'separator' => $this->language->get('text_separator')
				);
				
				if (isset($this->request->get['vendor_id'])) {
					$vendor_id = $this->request->get['vendor_id'];
				}		
				
				if (isset($this->request->get['vpath'])) {
					$url = '';

					if (isset($this->request->get['sort'])) {
						$url .= '&sort=' . $this->request->get['sort'];
					}

					if (isset($this->request->get['order'])) {
						$url .= '&order=' . $this->request->get['order'];
					}

					if (isset($this->request->get['limit'])) {
						$url .= '&limit=' . $this->request->get['limit'];
					}
					
					$vpath = '';

					$parts = explode('_', (string)$this->request->get['vpath']);

					$category_id = (int)array_pop($parts);

					foreach ($parts as $path_id) {
						if (!$vpath) {
							$vpath = (int)$path_id;
						} else {
							$vpath .= '_' . (int)$path_id;
						}

						$category_info = $this->model_catalog_vdi_s_category->getCategory($path_id);

						if ($category_info) {
							$data['breadcrumbs'][] = array(
								'text' => $category_info['name'],
								'href' => $this->url->link('module/vendorlogo/getStoreCategory', 'vendor_id=' . $vendor_id . '&vpath=' . $vpath)
							);
						}
					}
				} else {
					$category_id = 0;
				}

				$category_info = $this->model_catalog_vdi_s_category->getCategory($category_id);
				
				$this->document->setTitle($category_info['meta_title']);
				$this->document->setDescription($category_info['meta_description']);
				$this->document->setKeywords($category_info['meta_keyword']);
				$data['heading_title'] = $category_info['name'];
				
				if ($category_info['image']) {
					$data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
				} else {
					$data['thumb'] = '';
				}

				$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
				
				$url = '';

				if (isset($this->request->get['filter'])) {
					$url .= '&filter=' . $this->request->get['filter'];
				}

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}
					
				$data['categories'] = array();

				$results = $this->model_catalog_vdi_s_category->getCategories($category_id,$vendor_id);

				foreach ($results as $result) {
					$filter_data = array(
						'filter_category_id'  => $result['category_id'],
						'vendor_id'			  => $vendor_id,
						'filter_sub_category' => true
					);

					$data['categories'][] = array(
						'name' => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_vdi_s_category->getTotalProducts($filter_data) . ')' : ''),
						'href' => $this->url->link('module/vendorlogo/getStoreCategory', 'vpath=' . $this->request->get['vpath'] . '_' . $result['category_id'] . '&vendor_id=' . (int)$vendor_id . $url)
					);
				}
				
				$data['compare'] = $this->url->link('product/compare');
				
				$filter_data = array(
					'vendor_id' 			=> $vendor_id,
					'filter_category_id'	=> $category_id,
					'filter_filter'         => $filter,
					'sort'      			=> $sort,
					'order'     			=> $order,
					'start' => ($page - 1) * $limit,
					'limit' => $limit
				);
				
				$results = $this->model_catalog_vdi_s_category->getProducts($filter_data);
				$product_total = $this->model_catalog_vdi_s_category->get2TotalProducts($filter_data);
				
				$data['products'] = array();
				
				foreach ($results as $result) {
					if ($result['image']) {
						$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
					} else {
						$image = false;
					}
								
					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}
							
					if ((float)$result['special']) {
						$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}
					
					if ($this->config->get('config_tax')) {
						$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
					} else {
						$tax = false;
					}
					
					if ($this->config->get('config_review_status')) {
						$rating = $result['rating'];
					} else {
						$rating = false;
					}
					
					$data['products'][] = array(
						'product_id'  => $result['product_id'],
						'thumb'       => $image,
						'name'        => $result['name'],
						'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
						'price'       => $price,
						'special'     => $special,
						'tax'         => $tax,
						'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
						'rating'      => $result['rating'],
						'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
						'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
					);
				}
				
				$url = '';
				
				if (isset($this->request->get['filter'])) {
					$url .= '&filter=' . $this->request->get['filter'];
				}
				
				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}
									
				$data['sorts'] = array();
				
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_default'),
					'value' => 'p.sort_order-ASC',
					'href'  => $this->url->link('module/vendorlogo/getStoreCategory', '&sort=p.sort_order&order=ASC&vendor_id=' . $vendor_id . '&vpath=' . $this->request->get['vpath'] . $url)
				);
					
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_name_asc'),
					'value' => 'pd.name-ASC',
					'href'  => $this->url->link('module/vendorlogo/getStoreCategory', '&sort=pd.name&order=ASC&vendor_id=' . $vendor_id . '&vpath=' . $this->request->get['vpath'] . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_name_desc'),
					'value' => 'pd.name-DESC',
					'href'  => $this->url->link('module/vendorlogo/getStoreCategory', '&sort=pd.name&order=DESC&vendor_id=' . $vendor_id . '&vpath=' . $this->request->get['vpath'] . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_price_asc'),
					'value' => 'p.price-ASC',
					'href'  => $this->url->link('module/vendorlogo/getStoreCategory', '&sort=p.price&order=ASC&vendor_id=' . $vendor_id . '&vpath=' . $this->request->get['vpath'] . $url)
				); 

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_price_desc'),
					'value' => 'p.price-DESC',
					'href'  => $this->url->link('module/vendorlogo/getStoreCategory', '&sort=p.price&order=DESC&vendor_id=' . $vendor_id . '&vpath=' . $this->request->get['vpath'] . $url)
				); 
					
				if ($this->config->get('config_review_status')) {
					$data['sorts'][] = array(
						'text'  => $this->language->get('text_rating_desc'),
						'value' => 'rating-DESC',
						'href'  => $this->url->link('module/vendorlogo/getStoreCategory', '&sort=rating&order=DESC&vendor_id=' . $vendor_id . '&vpath=' . $this->request->get['vpath'] . $url)
					); 
						
					$data['sorts'][] = array(
						'text'  => $this->language->get('text_rating_asc'),
						'value' => 'rating-ASC',
						'href'  => $this->url->link('module/vendorlogo/getStoreCategory', '&sort=rating&order=ASC&vendor_id=' . $vendor_id . '&vpath=' . $this->request->get['vpath'] . $url)
					);
				}
					
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_model_asc'),
					'value' => 'p.model-ASC',
					'href'  => $this->url->link('module/vendorlogo/getStoreCategory', '&sort=p.model&order=ASC&vendor_id=' . $vendor_id . '&vpath=' . $this->request->get['vpath'] . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_model_desc'),
					'value' => 'p.model-DESC',
					'href'  => $this->url->link('module/vendorlogo/getStoreCategory', '&sort=p.model&order=DESC&vendor_id=' . $vendor_id . '&vpath=' . $this->request->get['vpath'] . $url)
				);
					
				$url = '';

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}	

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
				
				if (isset($this->request->get['vendor_id'])) {
					$url .= '&vendor_id=' . (int)$this->request->get['vendor_id'];
				}
				
				$data['limits'] = array();
				
				$limits = array_unique(array($this->config->get('config_product_limit'), 15, 25, 75, 100));
				
				sort($limits);
				
				foreach($limits as $value) {
					$data['limits'][] = array(
						'text'  => $value,
						'value' => $value,
						'href'  => $this->url->link('module/vendorlogo/getStoreCategory', 'vpath=' . $this->request->get['vpath'] . $url . '&limit=' . $value)
						//'href'  => $this->url->link('module/vendorlogo/getStoreCategory', $url . '&limit=' . $value)
					);
				}
								
				$url = '';
			
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}	

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
				
				if (isset($this->request->get['vendor_id'])) {
					$url .= '&vendor_id=' . (int)$this->request->get['vendor_id'];
				}
				
				if (isset($this->request->get['vpath'])) {
					$url .= '&vpath=' . $this->request->get['vpath'];
				}
				
				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}
				
				$pagination = new Pagination();
				$pagination->total = $product_total;
				$pagination->page = $page;
				$pagination->limit = $limit;
				$pagination->url = $this->url->link('module/vendorlogo/getStoreCategory', $url . '&page={page}');

				$data['pagination'] = $pagination->render();

				$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

				$data['sort'] = $sort;
				$data['order'] = $order;
				$data['limit'] = $limit;

				$data['continue'] = $this->url->link('common/home');

				$data['column_left'] = $this->load->controller('common/column_left');
				$data['column_right'] = $this->load->controller('common/column_right');
				$data['content_top'] = $this->load->controller('common/content_top');
				$data['content_bottom'] = $this->load->controller('common/content_bottom');
				$data['footer'] = $this->load->controller('common/footer');
				$data['header'] = $this->load->controller('common/header');
				
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/vdi_s_category.tpl')) {
					$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/vdi_s_category.tpl', $data));
				} else {
					$this->response->setOutput($this->load->view('default/template/product/vdi_s_category.tpl', $data));
				}
			}
			
	public function visitstore() {
		
		$this->language->load('module/vendorlogo');
		$data['text_empty'] = $this->language->get('text_empty');			
		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
		$data['text_display'] = $this->language->get('text_display');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_grid'] = $this->language->get('text_grid');
		$data['text_sort'] = $this->language->get('text_sort');
		$data['text_limit'] = $this->language->get('text_limit');

		
			$data['heading_title'] = $this->language->get('heading_vendor_info');
			
		$data['text_store_name'] = $this->language->get('text_store_name');
		$data['text_store_url'] = $this->language->get('text_store_url');
		$data['text_company'] = $this->language->get('text_company');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_name'] = $this->language->get('text_name');
		$data['text_location'] = $this->language->get('text_location');
		$data['text_address_1'] = $this->language->get('text_address_1');
		$data['text_address_2'] = $this->language->get('text_address_2');
		$data['text_city'] = $this->language->get('text_city');
		$data['text_postcode'] = $this->language->get('text_postcode');
		$data['text_zone'] = $this->language->get('text_zone');
		$data['text_country'] = $this->language->get('text_country');
		$data['text_description'] = $this->language->get('text_description');
		$data['text_vendor_rating'] = $this->language->get('text_vendor_rating');
		$data['text_gps_location'] = $this->language->get('text_gps_location');
							
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_list'] = $this->language->get('button_list');
		$data['button_grid'] = $this->language->get('button_grid');
		
		$this->load->model('catalog/vendorlogo'); 
		
		$this->load->model('tool/image');
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
	
		if (isset($this->request->get['vendor_id'])) {
			$vendor_id = (int)$this->request->get['vendor_id'];
		} else {
			$vendor_id = '0';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
		}
		

			if (isset($this->request->get['shop_search'])) {
				$search = $this->request->get['shop_search'];
			} else {
				$search = '';
			}
			
		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_product_limit');
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_vendors'),
			'href'      => $this->url->link('module/vendorlogo/getVendors'),			
			'separator' => $this->language->get('text_separator')
		);

			$vendor_result = $this->model_catalog_vendorlogo->getVendor((int)$this->request->get['vendor_id']);
			
			$data['breadcrumbs'][] = array(
			'text'      => $vendor_result['vendor_name'],
			'href'      => $this->url->link('module/vendorlogo/visitstore', 'vendor_id=' . $vendor_result['vendor_id']),			
			'separator' => $this->language->get('text_separator')
			);
			
		
		if (isset($this->request->get['vendor_id'])) {
			$vendor_id = (int)$this->request->get['vendor_id'];
		}

		$filter_data = array(

			'filter_name'	=> $search,
			
			'sort'      => $sort,
			'order'     => $order,
			'vendor_id' => (int)$vendor_id,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);
		
		$data['compare'] = $this->url->link('product/compare');
		
		$preBool = $this->model_catalog_vendorlogo->preCheck();
		
		
			
		$rating = $this->model_catalog_vendorlogo->getVendorRating((int)$this->request->get['vendor_id']);
		$total_feedback = $this->model_catalog_vendorlogo->getTotalFeedback((int)$this->request->get['vendor_id']);

		if ($preBool) {
			$total_order = $this->model_catalog_vendorlogo->getTotalVendorOrders((int)$this->request->get['vendor_id']);
		} else {
			$total_order = $this->model_catalog_vendorlogo->getOldTotalVendorOrders((int)$this->request->get['vendor_id']);
		}
		
		if ($vendor_result) {
			if ($vendor_result['vendor_image']) {
				$image = $this->model_tool_image->resize($vendor_result['vendor_image'], $this->config->get('mvd_logo_vw_image'), $this->config->get('mvd_logo_vh_image'));
			} else {
				$image = false;
			}
			
			$this->load->model('localisation/country');
			$country = $this->model_localisation_country->getCountry($vendor_result['country_id']);

			$this->load->model('localisation/zone');
			$zone = $this->model_localisation_zone->getZone($vendor_result['zone_id']);
			
			$this->document->setTitle(sprintf($this->language->get('heading_title_visit_store'),$vendor_result['vendor_name']));
			$this->document->setDescription(utf8_substr(strip_tags(html_entity_decode($vendor_result['vendor_description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')));
			$this->document->setKeywords(sprintf($this->language->get('heading_title_visit_store'),$vendor_result['vendor_name']));
			$this->document->addLink($this->url->link('module/vendorlogo/visitstore', 'vendor_id=' . $vendor_result['vendor_id']), 'canonical');
			
			if ($this->config->get('mvd_logo_vendor_information')) {
				$data['show_detail'] = true;
			} else {
				$data['show_detail'] = false;
			}
			
			$data['heading_title_visit_store'] = sprintf($this->language->get('heading_title_visit_store'),$vendor_result['vendor_name']);
			$data['vendor_id'] 	= (int)$vendor_result['vendor_id'];
			$data['rating']		= $rating;
			$data['feedback']	= $this->language->get('text_feedback') . ' (' . (isset($total_feedback) ? $total_feedback : 0) . ') | ' . $this->language->get('text_order') . ' (' . (isset($total_order) ? $total_order : 0)  . ')';
			$data['thumb']		= $image;
			$data['store_name']	= $vendor_result['vendor_name'];
			$data['store_url']	= $vendor_result['store_url'];
			$data['company']   	= $vendor_result['company'];
			$data['telephone']  = $vendor_result['telephone'];
			$data['fax']   		= $vendor_result['fax'];
			$data['email']   	= $vendor_result['email'];
			$data['name']   	= $vendor_result['firstname'] . ' ' . $vendor_result['lastname'];
			$data['location']   = '<img src="image/flags/' . strtolower($country['iso_code_2']) . '.png" />' . ' ' . $country['name']  . ' (' . (isset($zone['name']) ? $zone['name'] : $this->language->get('text_none')) . ') (' . $vendor_result['city'] . ')';
			$data['address_1']  = $vendor_result['address_1'];
			$data['address_2']  = $vendor_result['address_2'];
			$data['city']   	= $vendor_result['city'];
			$data['postcode']   = $vendor_result['postcode'];
			$data['zone']   	= isset($zone['name']) ? $zone['name'] : $this->language->get('text_none');
			$data['country']   	= $country['name'];
			$data['geocode']   	= $vendor_result['geocode'];
			$data['description']= isset($vendor_result['vendor_description']) ? strip_tags(html_entity_decode($vendor_result['vendor_description'], ENT_QUOTES, 'UTF-8')) : $this->language->get('text_none');
		}
		
		$results = $this->model_catalog_vendorlogo->getProducts($filter_data);
		$product_total = $this->model_catalog_vendorlogo->getTotalProducts($filter_data);

		$data['products'] = array();
		
		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
			} else {
				$image = false;
			}
						
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = false;
			}
					
			if ((float)$result['special']) {
				$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$special = false;
			}
			
			if ($this->config->get('config_tax')) {
				$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
			} else {
				$tax = false;
			}
			
			if ($this->config->get('config_review_status')) {
				$rating = $result['rating'];
			} else {
				$rating = false;
			}
			
			$data['products'][] = array(
				'product_id'  => $result['product_id'],
				'thumb'       => $image,
				'name'        => $result['name'],
				'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
				'price'       => $price,
				'special'     => $special,
				'tax'         => $tax,
				'rating'      => $result['rating'],
				'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
				'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
			);
		}
		
		$url = '';
	
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
							
		$data['sorts'] = array();
		
		$data['sorts'][] = array(
			'text'  => $this->language->get('text_default'),
			'value' => 'p.sort_order-ASC',
			'href'  => $this->url->link('module/vendorlogo/visitstore', '&sort=p.sort_order&order=ASC&vendor_id=' . $vendor_id . $url)
		);
			
		$data['sorts'][] = array(
			'text'  => $this->language->get('text_name_asc'),
			'value' => 'pd.name-ASC',
			'href'  => $this->url->link('module/vendorlogo/visitstore', '&sort=pd.name&order=ASC&vendor_id=' . $vendor_id . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_name_desc'),
			'value' => 'pd.name-DESC',
			'href'  => $this->url->link('module/vendorlogo/visitstore', '&sort=pd.name&order=DESC&vendor_id=' . $vendor_id . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_price_asc'),
			'value' => 'p.price-ASC',
			'href'  => $this->url->link('module/vendorlogo/visitstore', '&sort=p.price&order=ASC&vendor_id=' . $vendor_id . $url)
		); 

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_price_desc'),
			'value' => 'p.price-DESC',
			'href'  => $this->url->link('module/vendorlogo/visitstore', '&sort=p.price&order=DESC&vendor_id=' . $vendor_id . $url)
		); 
			
		if ($this->config->get('config_review_status')) {
			$data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_desc'),
				'value' => 'rating-DESC',
				'href'  => $this->url->link('module/vendorlogo/visitstore', '&sort=rating&order=DESC&vendor_id=' . $vendor_id . $url)
			); 
				
			$data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_asc'),
				'value' => 'rating-ASC',
				'href'  => $this->url->link('module/vendorlogo/visitstore', '&sort=rating&order=ASC&vendor_id=' . $vendor_id . $url)
			);
		}
			
		$data['sorts'][] = array(
			'text'  => $this->language->get('text_model_asc'),
			'value' => 'p.model-ASC',
			'href'  => $this->url->link('module/vendorlogo/visitstore', '&sort=p.model&order=ASC&vendor_id=' . $vendor_id . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_model_desc'),
			'value' => 'p.model-DESC',
			'href'  => $this->url->link('module/vendorlogo/visitstore', '&sort=p.model&order=DESC&vendor_id=' . $vendor_id . $url)
		);
			
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}	

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['vendor_id'])) {
			$url .= '&vendor_id=' . (int)$this->request->get['vendor_id'];
		}
		
		$data['limits'] = array();
		$limits = array_unique(array($this->config->get('config_product_limit'), 25, 50, 75, 100));
		sort($limits);
		
		foreach($limits as $value) {
			$data['limits'][] = array(
				'text'  => $value,
				'value' => $value,
				'href'  => $this->url->link('module/vendorlogo/visitstore', $url . '&limit=' . $value)
			);
		}
						
		$url = '';
	
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}	

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['vendor_id'])) {
			$url .= '&vendor_id=' . (int)$this->request->get['vendor_id'];
		}
		
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
		
		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('module/vendorlogo/visitstore', $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mvd_visit_store.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/module/mvd_visit_store.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/module/mvd_visit_store.tpl', $data));
		}
  	}
}
?>
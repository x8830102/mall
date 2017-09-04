<?php
$contentslider = $this->rgen->storage->get('modtheme_data', 'rgen_contentslider');
if ($this->chk($contentslider)) {
	foreach ($contentslider as $k => $v) {
		if ($this->chk($v)) {
			$contentsld = $v;

			if ($v['status']) {
				$data['contentslider'][$k]['dots']['wrp']          = $factory->node($contentsld, 'dots/wrp', 1);
				$data['contentslider'][$k]['dots']['normal']       = $factory->node($contentsld, 'dots/normal', 1);
				$data['contentslider'][$k]['dots']['active']       = $factory->node($contentsld, 'dots/active', 1);
				
				$data['contentslider'][$k]['arrows']['wrp']        = $factory->node($contentsld, 'arrows/wrp', 1);
				$data['contentslider'][$k]['arrows']['arrow_line'] = $factory->node($contentsld, 'arrows/arrow_line', 1);
				$data['contentslider'][$k]['arrows']['arrow']      = $factory->node($contentsld, 'arrows/arrow', 1, 0, 'css_normal');
				$data['contentslider'][$k]['arrows']['arrow_h']    = $factory->node($contentsld, 'arrows/arrow', 1, 0, 'css_hover');

				$screen_k = array('d', 't', 'm');
				$blockstyles = array(
					'ctn_block1'
				);
				foreach ($screen_k as $screen_v) {
					$data['contentslider'][$k][$screen_v]['main']                = $factory->node($contentsld, $screen_v.'/main', 1);
					$data['contentslider'][$k][$screen_v]['main_bg']             = $this->cssimgpath($factory->node($contentsld, $screen_v.'/main_bg', 1));
					$data['contentslider'][$k][$screen_v]['mod_wrp']             = $factory->node($contentsld, $screen_v.'/mod_wrp', 1);
					$data['contentslider'][$k][$screen_v]['mod_content']         = $factory->node($contentsld, $screen_v.'/mod_content', 1);
					$data['contentslider'][$k][$screen_v]['mod_hd']              = $factory->node($contentsld, $screen_v.'/mod_hd', 1);
					$data['contentslider'][$k][$screen_v]['mod_sub_hd']          = $factory->node($contentsld, $screen_v.'/mod_sub_hd', 1);
					
					$data['contentslider'][$k][$screen_v]['t_html']              = $factory->node($contentsld, $screen_v.'/t_html', 1);
					$data['contentslider'][$k][$screen_v]['b_html']              = $factory->node($contentsld, $screen_v.'/b_html', 1);
					$data['contentslider'][$k][$screen_v]['l_html']              = $factory->node($contentsld, $screen_v.'/l_html', 1);
					$data['contentslider'][$k][$screen_v]['r_html']              = $factory->node($contentsld, $screen_v.'/r_html', 1);
					
					$data['contentslider'][$k][$screen_v]['rw']                  = $factory->node($contentsld, $screen_v.'/rw', 1);
					$data['contentslider'][$k][$screen_v]['l_cl']                = $factory->node($contentsld, $screen_v.'/l_cl', 1);
					$data['contentslider'][$k][$screen_v]['m_cl']                = $factory->node($contentsld, $screen_v.'/m_cl', 1);
					$data['contentslider'][$k][$screen_v]['r_cl']                = $factory->node($contentsld, $screen_v.'/r_cl', 1);
					
					$data['contentslider'][$k][$screen_v]['outer_rw']            = $factory->node($contentsld, $screen_v.'/outer_rw/rw', 1);
					$data['contentslider'][$k][$screen_v]['outer_rw_first']      = $factory->node($contentsld, $screen_v.'/outer_rw/first_rw', 1);
					$data['contentslider'][$k][$screen_v]['outer_rw_last']       = $factory->node($contentsld, $screen_v.'/outer_rw/last_rw', 1);
					$data['contentslider'][$k][$screen_v]['outer_rw_cl']         = $factory->node($contentsld, $screen_v.'/outer_rw/cl', 1);
					$data['contentslider'][$k][$screen_v]['outer_rw_cl_first']   = $factory->node($contentsld, $screen_v.'/outer_rw/first_cl', 1);
					$data['contentslider'][$k][$screen_v]['outer_rw_cl_last']    = $factory->node($contentsld, $screen_v.'/outer_rw/last_cl', 1);
					
					$data['contentslider'][$k][$screen_v]['content_rw']          = $factory->node($contentsld, $screen_v.'/content_rw/rw', 1);
					$data['contentslider'][$k][$screen_v]['content_rw_cl']       = $factory->node($contentsld, $screen_v.'/content_rw/cl', 1);
					$data['contentslider'][$k][$screen_v]['content_rw_cl_first'] = $factory->node($contentsld, $screen_v.'/content_rw/first_cl', 1);
					$data['contentslider'][$k][$screen_v]['content_rw_cl_last']  = $factory->node($contentsld, $screen_v.'/content_rw/last_cl', 1);

					foreach ($blockstyles as $blockstyle) {
						$blockstyle_data = $factory->node($contentsld, $screen_v.'/'.$blockstyle, 0, 0);

						if ($blockstyle_data) {
							$data['contentslider'][$k][$screen_v][$blockstyle]['main'] = $factory->node($blockstyle_data, 'setting/main', 1);
							$data['contentslider'][$k][$screen_v][$blockstyle]['hd'] = $factory->node($blockstyle_data, 'setting/hd', 1);
							$data['contentslider'][$k][$screen_v][$blockstyle]['info'] = $factory->node($blockstyle_data, 'setting/info', 1);
						}
					}

				}
			}
		}
	}
}
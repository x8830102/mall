-- ------------------------------------
-- 
-- Module - menu
-- 
-- ------------------------------------

DELETE FROM `rgen_modules` WHERE `section` LIKE '%menu%';

INSERT INTO `rgen_modules` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_module', 'rgen_menu_set', 'set_rgRiF', '{"data":[{"module_id":"rgvP4","layout_id":"9999","position":"main_menu","status":true,"sort_order":0,"align":"center","menuwidth":"fw"}],"name":"Menu 01"}');
INSERT INTO `rgen_modules` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_module', 'rgen_menu', 'rgvP4', '{"data":[{"id":0,"depth":1,"status":true,"node_type":"main","node_title":"Shop by Category","submenu_type":"mega","item_data":{"node":"main","title":{"1":"Shop by Category"},"url":"","icon":{"status":true,"type":"ico","icon":"glyphicon glyphicon-th-large","size":"16px","color":"#ffffff","image":"..\\/image\\/no_image.png","bgsize":"auto","bgsize_w":"100%","bgsize_h":"100%","position":"center center","block_w":"","block_h":"","css":"font-size: 16px;"},"icon_position":"l","icon_block":[],"css_class":"","label":{"status":false,"type":"txt","text":{"1":"en - No data"},"image":"..\\/image\\/no_image.png","img_w":40,"background":"#000","text_color":"#fff","text_size":"12px","css_class":"","block":[],"top":-15,"left":0},"submenu_type":"mega","submenu_size":"sub-size5"},"items":[{"id":"0-1","depth":2,"status":true,"node_type":"row","node_title":"Row item","item_data":{"node":"row","gutter":"gt30","margin_b":"mb0"},"items":[{"id":"0-1-1","depth":3,"status":true,"node_type":"col","node_title":"Column item","item_data":{"node":"col","col_size":"cl4","lg_desktop":"cl6","desktop":" d-xl6","tablet":" t-xl6","mob_xl":" m-xl6","mob_sm":" m-sm12","mob_xs":" m-xs12","classGroup":"cl6 d-xl6 t-xl6 m-xl6 m-sm12 m-xs12","border":{"status":true,"size":"dif","size_all":0,"size_t":0,"size_r":"1","size_b":0,"size_l":0,"style":"solid","radius":"all","radius_all":0,"radius_t":0,"radius_r":0,"radius_b":0,"radius_l":0,"color_type":"all","color":"rgba(0, 0, 0, 0.06)","color_t":"#eeeeee","color_r":"#eeeeee","color_b":"#eeeeee","color_l":"#eeeeee","css":"border-width: 0px 1px 0px 0px;border-style: solid;border-color: rgba(0, 0, 0, 0.06);border-radius: 0px;"}},"items":[{"id":"0-1-1-1","depth":4,"status":true,"node_type":"item","node_title":"Desktops","item_data":{"node":"item","item_type":"cat","tab":{"status":false,"tab_style":"side"},"sub_item":{"category":{"id":"20","name":"Desktops"},"image_w":"150","image_h":"150","win":"n","style":1,"max_sub":5}},"items":[]},{"id":"0-1-1-1","depth":4,"status":true,"node_type":"item","node_title":"Laptops & Notebooks","item_data":{"node":"item","item_type":"cat","tab":{"status":false,"tab_style":"side"},"sub_item":{"category":{"id":"18","name":"Laptops & Notebooks"},"image_w":"150","image_h":"150","win":"n","style":1,"max_sub":5}},"items":[]},{"id":"0-1-1-2","depth":4,"status":true,"node_type":"item","node_title":"Components","item_data":{"node":"item","item_type":"cat","tab":{"status":false,"tab_style":"side"},"sub_item":{"category":{"id":"25","name":"Components"},"image_w":"150","image_h":"150","win":"n","style":1,"max_sub":5}},"items":[]}]},{"id":"0-1-1","depth":3,"status":true,"node_type":"col","node_title":"Column item","submenu_type":"mega","item_data":{"node":"col","col_size":"cl4","lg_desktop":"cl6","desktop":" d-xl6","tablet":" t-xl6","mob_xl":" m-xl6","mob_sm":" m-sm12","mob_xs":" m-xs12","classGroup":"cl6 d-xl6 t-xl6 m-xl6 m-sm12 m-xs12","border":[]},"items":[{"id":"0-1-1-1","depth":4,"status":true,"node_type":"item","node_title":"Tablets","item_data":{"node":"item","item_type":"cat","tab":{"status":false,"tab_style":"side"},"sub_item":{"category":{"id":"57","name":"Tablets"},"image_w":"150","image_h":"150","win":"n","style":1,"max_sub":5}},"items":[]},{"id":"0-1-1-1","depth":4,"status":true,"node_type":"item","node_title":"Software","item_data":{"node":"item","item_type":"cat","tab":{"status":false,"tab_style":"side"},"sub_item":{"category":{"id":"17","name":"Software"},"image_w":"150","image_h":"150","win":"n","style":1,"max_sub":5}},"items":[]},{"id":"0-1-1-2","depth":4,"status":true,"node_type":"item","node_title":"Phones & PDAs","item_data":{"node":"item","item_type":"cat","tab":{"status":false,"tab_style":"side"},"sub_item":{"category":{"id":"24","name":"Phones & PDAs"},"image_w":"150","image_h":"150","win":"n","style":1,"max_sub":5}},"items":[]},{"id":"0-1-1-3","depth":4,"status":true,"node_type":"item","node_title":"Cameras","item_data":{"node":"item","item_type":"cat","tab":{"status":false,"tab_style":"side"},"sub_item":{"category":{"id":"33","name":"Cameras"},"image_w":"150","image_h":"150","win":"n","style":1,"max_sub":5}},"items":[]},{"id":"0-1-1-4","depth":4,"status":true,"node_type":"item","node_title":"MP3 Players","item_data":{"node":"item","item_type":"cat","tab":{"status":false,"tab_style":"side"},"sub_item":{"category":{"id":"34","name":"MP3 Players"},"image_w":"150","image_h":"150","win":"n","style":1,"max_sub":6}},"items":[]}]}]}]},{"id":1,"depth":1,"status":true,"node_type":"main","node_title":"Shop by brands","submenu_type":"mega","item_data":{"node":"main","title":{"1":"Shop by brands"},"url":"\\/\\/rgenmodernstore.rgenesis.com\\/01\\/index.php?route=product\\/manufacturer","icon":{"status":false,"type":"ico","icon":"glyphicon glyphicon-fire","size":"14px","color":"#ffffff","image":"..\\/image\\/no_image.png","bgsize":"auto","bgsize_w":"100%","bgsize_h":"100%","position":"center center","css":"font-size: 14px;","block_w":"","block_h":""},"css_class":"","label":{"status":false,"type":"txt","text":{"1":"en - No data"},"image":"..\\/image\\/no_image.png","background":"#000","text_color":"#fff","text_size":"12px","css_class":""},"submenu_type":"mega","submenu_size":"sub-size6"},"items":[{"id":"1-1","depth":2,"status":true,"node_type":"row","node_title":"Row item","item_data":{"node":"row","gutter":"gt30","margin_b":"mb0"},"items":[{"id":"1-1-1","depth":3,"status":true,"node_type":"col","node_title":"Column item","item_data":{"node":"col","col_size":"cl4","lg_desktop":"cl6","desktop":" d-xl6","tablet":" t-xl6","mob_xl":" m-xl12","mob_sm":" m-sm12","mob_xs":" m-xs12","classGroup":"cl6 d-xl6 t-xl6 m-xl12 m-sm12 m-xs12","border":{"status":false,"size":"dif","size_all":0,"size_t":0,"size_r":"1","size_b":0,"size_l":0,"style":"solid","radius":"all","radius_all":0,"radius_t":0,"radius_r":0,"radius_b":0,"radius_l":0,"color_type":"all","color":"rgba(0, 0, 0, 0.06)","color_t":"#eeeeee","color_r":"#eeeeee","color_b":"#eeeeee","color_l":"#eeeeee","css":"border-width: 0px 1px 0px 0px;border-style: solid;border-color: rgba(0, 0, 0, 0.06);border-radius: 0px;"}},"items":[{"id":"1-1-1-1","depth":4,"status":true,"node_type":"item","node_title":"Brands","item_data":{"node":"item","item_type":"brand","tab":{"status":false,"tab_style":"side"},"sub_item":{"brands":[{"id":"8","name":"Apple"},{"id":"9","name":"Canon"},{"id":"7","name":"Hewlett-Packard"},{"id":"5","name":"HTC"},{"id":"6","name":"Palm"},{"id":"10","name":"Sony"}],"image_w":"300","image_h":"300","style":2,"grid_settings":{"lg_desktop":"eq2","desktop":"d-eq2","tablet":"t-eq2","mob_xl":"mxl-eq2","mob_sm":"msm-eq2","mob_xs":"mxs-eq2","gutter":"gt10","margin_b":"mb10","classGroup":" eq2 d-eq2 t-eq2 mxl-eq2 msm-eq2 mxs-eq2 gt10 mb10"}}},"items":[]}]},{"id":"1-1-1","depth":3,"status":true,"node_type":"col","node_title":"Column item","item_data":{"node":"col","col_size":"cl4","lg_desktop":"cl6","desktop":" d-xl6","tablet":" t-xl6","mob_xl":" m-xl6","mob_sm":" m-sm12","mob_xs":" m-xs12","classGroup":"cl6 d-xl6 t-xl6 m-xl6 m-sm12 m-xs12","border":[]},"items":[{"id":"1-1-1-1","depth":4,"status":true,"node_type":"item","node_title":"Products","item_data":{"node":"item","item_type":"prd","tab":{"status":false,"tab_style":"side"},"sub_item":{"products":[{"id":"41","name":"iMac"},{"id":"40","name":"iPhone"},{"id":"36","name":"iPod Nano"},{"id":"42","name":"Apple Cinema 30\\""}],"image_w":"150","image_h":"150","style":2,"grid_settings":{"lg_desktop":"eq1","desktop":"d-eq1","tablet":"t-eq1","mob_xl":"mxl-eq1","mob_sm":"msm-eq1","mob_xs":"mxs-eq1","gutter":"gt0","margin_b":"mb10","classGroup":" eq1 d-eq1 t-eq1 mxl-eq1 msm-eq1 mxs-eq1 gt0 mb10"}}},"items":[]}]}]}]},{"id":2,"depth":1,"status":true,"node_type":"main","node_title":"Top items","submenu_type":"mega","item_data":{"node":"main","title":{"1":"Top items"},"url":"","icon":{"status":true,"type":"ico","icon":"glyphicon glyphicon-fire","size":"16px","color":"#ffffff","image":"..\\/image\\/no_image.png","bgsize":"auto","bgsize_w":"100%","bgsize_h":"100%","position":"center center","css":"font-size: 16px;","block_w":"","block_h":""},"icon_position":"l","icon_block":{"status":true,"fonts":[],"background":"","color":"rgb(255, 221, 0)","f_size":"16px","text_align":"left","border":[],"padding":[],"margin":[],"shadow":[],"w":"","h":"","css":"color: rgb(255, 221, 0); font-size: 16px; text-align: left; "},"css_class":"","label":{"status":false,"type":"txt","text":{"1":"en - No data"},"image":"..\\/image\\/no_image.png","img_w":40,"background":"#000","text_color":"#fff","text_size":"12px","css_class":"","block":[],"top":-15,"left":0},"submenu_type":"mega","submenu_size":"sub-size6"},"items":[{"id":"2-1","depth":2,"status":true,"node_type":"row","node_title":"Row item","item_data":{"node":"row","gutter":"gt20","margin_b":"mb0"},"items":[{"id":"2-1-1","depth":3,"status":true,"node_type":"col","node_title":"Column item","item_data":{"node":"col","col_size":"cl4","lg_desktop":"cl12","desktop":" d-xl12","tablet":" t-xl12","mob_xl":" m-xl12","mob_sm":" m-sm12","mob_xs":" m-xs12","classGroup":"cl12 d-xl12 t-xl12 m-xl12 m-sm12 m-xs12","border":[]},"items":[{"id":"2-1-1-1","depth":4,"status":true,"node_type":"item","node_title":"Products","item_data":{"node":"item","item_type":"prd","tab":{"status":false,"tab_style":"side"},"sub_item":{"products":[{"id":"41","name":"iMac"},{"id":"40","name":"iPhone"},{"id":"36","name":"iPod Nano"},{"id":"48","name":"iPod Classic"},{"id":"34","name":"iPod Shuffle"},{"id":"42","name":"Apple Cinema 30\\""}],"image_w":"150","image_h":"150","style":1,"grid_settings":{"lg_desktop":"eq3","desktop":"d-eq3","tablet":"t-eq3","mob_xl":"mxl-eq2","mob_sm":"msm-eq2","mob_xs":"mxs-eq1","gutter":"gt10","margin_b":"mb10","classGroup":" eq3 d-eq3 t-eq3 mxl-eq2 msm-eq2 mxs-eq1 gt10 mb10"}}},"items":[]}]}]}]},{"id":3,"depth":1,"status":true,"node_type":"main","node_title":"Our items","submenu_type":"mega","item_data":{"node":"main","title":{"1":"Our items"},"url":"\\/\\/themeforest.net\\/user\\/R_GENESIS\\/portfolio","icon":{"status":true,"type":"img","icon":"fa fa-chevron-up","size":"14px","color":"#ffffff","image":"..\\/image\\/catalog\\/rgen\\/demo02_images\\/other\\/envato-logo.png","bgsize":"cover","bgsize_w":"100%","bgsize_h":"100%","position":"center center","block_w":"14","block_h":"14","css":"background-size: cover;background-position: center center;background-image: url(image\\/catalog\\/rgen\\/demo02_images\\/other\\/envato-logo.png); background-repeat: no-repeat;width: 14px;height: 14px;"},"icon_position":"l","icon_block":[],"css_class":"","label":{"status":true,"type":"txt","text":{"1":"Envato Market"},"image":"..\\/image\\/no_image.png","img_w":40,"background":"rgb(129, 180, 65)","text_color":"rgb(255, 255, 255)","text_size":"12px","css_class":"","block":[],"top":-15,"left":"20"},"submenu_type":"mega","submenu_size":"sub-size-full"},"items":[{"id":"3-1","depth":2,"status":true,"node_type":"row","node_title":"Row item","item_data":{"node":"row","gutter":"gt20","margin_b":"mb0"},"items":[{"id":"3-1-1","depth":3,"status":true,"node_type":"col","node_title":"Column item","item_data":{"node":"col","col_size":"cl4","lg_desktop":"cl3","desktop":" d-xl3","tablet":" t-xl6","mob_xl":" m-xl12","mob_sm":" m-sm12","mob_xs":" m-xs12","classGroup":"cl3 d-xl3 t-xl6 m-xl12 m-sm12 m-xs12","border":[]},"items":[{"id":"3-1-1-1","depth":4,"status":true,"node_type":"item","node_title":"Info boxes","item_data":{"node":"item","item_type":"infobox","tab":{"status":false,"tab_style":"side"},"sub_item":{"title":{"1":"R.Gen - OpenCart Modern Store Design"},"image":"..\\/image\\/catalog\\/rgen\\/demo02_images\\/other\\/r.gen-opencart-modern-store-design.jpg","description":{"1":"R.Gen - OpenCart Modern Store is a premium OpenCart theme with advanced admin module."},"url":"http:\\/\\/themeforest.net\\/item\\/rgen-opencart-modern-store-design\\/2699592?ref=R_GENESIS","win":"n","style":3,"margin_b":" mrb5","image_w":"400","image_h":"300","align":"left","button":{"1":"Purchase"}}},"items":[]}]},{"id":"3-1-1","depth":3,"status":true,"node_type":"col","node_title":"Column item","item_data":{"node":"col","col_size":"cl4","lg_desktop":"cl3","desktop":" d-xl3","tablet":" t-xl6","mob_xl":" m-xl12","mob_sm":" m-sm12","mob_xs":" m-xs12","classGroup":"cl3 d-xl3 t-xl6 m-xl12 m-sm12 m-xs12","border":[]},"items":[{"id":"3-1-1-1","depth":4,"status":true,"node_type":"item","node_title":"Info boxes","item_data":{"node":"item","item_type":"infobox","tab":{"status":false,"tab_style":"side"},"sub_item":{"title":{"1":"Classic Metal Badges"},"image":"..\\/image\\/catalog\\/rgen\\/demo02_images\\/other\\/classic-metal-badges_01.jpg","description":{"1":"A pack of 9 Classic metal badges perfect to use as logos, buttons or as promotion graphics for your website."},"url":"http:\\/\\/graphicriver.net\\/item\\/classic-metal-badges\\/1130469?ref=R_GENESIS","win":"n","style":3,"margin_b":" mrb5","image_w":"400","image_h":"300","align":"left","button":{"1":"Purchase"}}},"items":[]}]},{"id":"3-1-2","depth":3,"status":true,"node_type":"col","node_title":"Column item","item_data":{"node":"col","col_size":"cl4","lg_desktop":"cl3","desktop":" d-xl3","tablet":" t-xl6","mob_xl":" m-xl12","mob_sm":" m-sm12","mob_xs":" m-xs12","classGroup":"cl3 d-xl3 t-xl6 m-xl12 m-sm12 m-xs12","border":[]},"items":[{"id":"3-1-2-1","depth":4,"status":true,"node_type":"item","node_title":"Info boxes","item_data":{"node":"item","item_type":"infobox","tab":{"status":false,"tab_style":"side"},"sub_item":{"title":{"1":"Royal Golden Badges"},"image":"..\\/image\\/catalog\\/rgen\\/demo02_images\\/other\\/14.jpg","description":{"1":"10 Royal Golden Badges are perfect to use as logos, buttons or as promotion graphics for your website or any other material."},"url":"http:\\/\\/graphicriver.net\\/item\\/royal-golden-badges\\/1468714?ref=R_GENESIS","win":"n","style":3,"margin_b":" mrb5","image_w":"400","image_h":"300","align":"left","button":{"1":"Purchase"}}},"items":[]}],"submenu_type":"mega"},{"id":"3-1-3","depth":3,"status":true,"node_type":"col","node_title":"Column item","item_data":{"node":"col","col_size":"cl4","lg_desktop":"cl3","desktop":" d-xl3","tablet":" t-xl6","mob_xl":" m-xl12","mob_sm":" m-sm12","mob_xs":" m-xs12","classGroup":"cl3 d-xl3 t-xl6 m-xl12 m-sm12 m-xs12","border":[]},"items":[{"id":"3-1-3-1","depth":4,"status":true,"node_type":"item","node_title":"Info boxes","item_data":{"node":"item","item_type":"infobox","tab":{"status":false,"tab_style":"side"},"sub_item":{"title":{"1":"R.Gen - Circle Creative PSD Template"},"image":"..\\/image\\/catalog\\/rgen\\/demo02_images\\/other\\/circle-theme.jpg","description":{"1":"Unique design in circle style with blog pages. Item include 3 theme options to quickly use."},"url":"http:\\/\\/themeforest.net\\/item\\/rgen-circle-creative-psd-template\\/2297212?ref=R_GENESIS","win":"n","style":3,"margin_b":" mrb5","image_w":"400","image_h":"300","align":"left","button":{"1":"Purchase"}}},"items":[]}]}],"submenu_type":"mega"}]},{"id":4,"depth":1,"status":true,"node_type":"main","node_title":"Information","submenu_type":"fly","item_data":{"node":"main","title":{"1":"Information"},"url":"","icon":{"status":false,"type":"ico","icon":"fa fa-chevron-up","size":"14px","color":"#ffffff","image":"..\\/image\\/no_image.png","bgsize":"auto","bgsize_w":"100%","bgsize_h":"100%","position":"center center","css":""},"icon_position":"l","icon_block":[],"css_class":"","label":{"status":false,"type":"txt","text":{"1":"en - No data"},"image":"..\\/image\\/no_image.png","img_w":40,"background":"#000","text_color":"#fff","text_size":"12px","css_class":"","block":[],"top":-15,"left":0},"submenu_type":"fly","submenu_size":"sub-size2"},"items":[{"id":"4-1","depth":2,"status":true,"node_type":"item","node_title":"About Us","item_data":{"node":"item","item_type":"normal","tab":{"status":false,"tab_style":"side"},"sub_item":{"title":{"1":"About Us"},"url":"\\/\\/rgenmodernstore.rgenesis.com\\/01\\/index.php?route=information\\/information&information_id=4","win":"n","style":"normal","test":"test data"}},"items":[]},{"id":"4-1","depth":2,"status":true,"node_type":"item","node_title":"Delivery Information","item_data":{"node":"item","item_type":"normal","tab":{"status":false,"tab_style":"side"},"sub_item":{"title":{"1":"Delivery Information"},"url":"\\/\\/rgenmodernstore.rgenesis.com\\/01\\/index.php?route=information\\/information&information_id=6","win":"n","style":"normal","test":"test data"}},"items":[]},{"id":"4-2","depth":2,"status":true,"node_type":"item","node_title":"Privacy Policy","item_data":{"node":"item","item_type":"normal","tab":{"status":false,"tab_style":"side"},"sub_item":{"title":{"1":"Privacy Policy"},"url":"\\/\\/rgenmodernstore.rgenesis.com\\/01\\/index.php?route=information\\/information&information_id=3","win":"n","style":"normal","test":"test data"}},"items":[]},{"id":"4-3","depth":2,"status":true,"node_type":"item","node_title":"Terms & Conditions","item_data":{"node":"item","item_type":"normal","tab":{"status":false,"tab_style":"side"},"sub_item":{"title":{"1":"Terms & Conditions"},"url":"\\/\\/rgenmodernstore.rgenesis.com\\/01\\/index.php?route=information\\/information&information_id=5","win":"n","style":"normal","test":"test data"}},"items":[]},{"id":"4-4","depth":2,"status":true,"node_type":"item","node_title":"Contact Us","item_data":{"node":"item","item_type":"normal","tab":{"status":false,"tab_style":"side"},"sub_item":{"title":{"1":"Contact Us"},"url":"\\/\\/rgenmodernstore.rgenesis.com\\/01\\/index.php?route=information\\/contact","win":"n","style":"normal","test":"test data"}},"items":[]}]},{"id":5,"depth":1,"status":true,"node_type":"main","node_title":"Purchase","submenu_type":"n","item_data":{"node":"main","title":{"1":"Purchase"},"url":"http:\\/\\/themeforest.net\\/item\\/rgen-opencart-modern-store-design\\/2699592?ref=R_GENESIS","icon":{"status":true,"type":"ico","icon":"fa fa-rocket","size":"14px","color":"#ffffff","image":"..\\/image\\/no_image.png","bgsize":"auto","bgsize_w":"100%","bgsize_h":"100%","position":"center center","block_w":"","block_h":"","css":"font-size: 14px;"},"css_class":"theme-buy","label":{"status":false,"type":"txt","text":{"1":"en - No data"},"image":"..\\/image\\/no_image.png","background":"#000","text_color":"#fff","text_size":"12px","css_class":""},"submenu_type":"n","submenu_size":"sub-size4"},"items":[]}],"name":"Main menu"}');


DELETE FROM `rgen_modules_customize` WHERE `key` LIKE '%menu%';

INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.flyout', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.normalhd', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.normallink', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.cat1links', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.cat2hd', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.cat2links', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.cat1hd', '{"family":"Droid+Serif:regular","subset":"latin"}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.prd1btn', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.prd2btn', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.brd1', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.img1', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.img3', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.infobox1hd', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.infobox1bt', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.infobox2hd', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.infobox2bt', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.infobox3hd', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.menuitem', '{"family":"Droid+Serif:regular","subset":"latin"}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.infobox3bt', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.infobox4hd', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.infobox4bt', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'fonts', 'rgen_menu.rgvP4.customhtml', '{"family":"","subset":""}');
INSERT INTO `rgen_modules_customize` (`store_id`, `group`, `section`, `key`, `value`) VALUES ('0', 'rgen_modtheme', 'rgen_menu', 'rgen_menu.rgvP4', '{"status":true,"container":{"status":true,"fonts":[],"background":"rgb(0, 0, 0)","color":"","f_size":"13px","text_align":"left","border":[],"padding":[],"margin":{"status":true,"type":"all","mrg":0,"mrg_type":"auto","mrg_t":0,"mrg_t_type":"auto","mrg_r":0,"mrg_r_type":"auto","mrg_b":0,"mrg_b_type":"auto","mrg_l":0,"mrg_l_type":"auto","css":"margin: auto;"},"shadow":[],"w":"","h":"","css":"background-color: rgb(0, 0, 0); margin: auto;"},"menubar":[],"menuitem":{"wrapper":[],"link":{"font_color":{"normal":"rgb(255, 255, 255)","hover":"#ffffff"},"background":{"normal":"","hover":"rgb(193, 170, 143)"},"f_size":"16px","text_align":"center","status":true,"fonts":{"status":true,"type":"google","family":"Droid+Serif","variants":"regular","subsets":"latin","size":"13px","line_height":"1.2","style":"normal","transform":"none","letter_spacing":"0px","color":"#666666","css":"font-family: Droid Serif; font-size: 13px; line-height: 1.2; font-style: normal; font-weight: normal; color: #666666; text-transform: none; letter-spacing: 0px;"},"border":{"normal":[],"hover":[]},"padding":{"status":true,"type":"dif","pad":0,"pad_type":"inherit","pad_t":"15","pad_t_type":"int","pad_r":"20","pad_r_type":"int","pad_b":"15","pad_b_type":"int","pad_l":"20","pad_l_type":"int","css":"padding-top: 15px; padding-right: 20px; padding-bottom: 15px; padding-left: 20px; "},"margin":[],"shadow":{"normal":[],"hover":[]},"css_normal":"font-family: Droid Serif; font-size: 13px; line-height: 1.2; font-style: normal; font-weight: normal; color: #666666; text-transform: none; letter-spacing: 0px;color: rgb(255, 255, 255); padding-top: 15px; padding-right: 20px; padding-bottom: 15px; padding-left: 20px; font-size: 16px; text-align: center; ","css_hover":"color: #ffffff; background-color: rgb(193, 170, 143); "}},"flyoutmenu":{"wrapper":{"status":true,"fonts":[],"background":"rgb(193, 170, 143)","color":"","f_size":"13px","text_align":"left","border":[],"padding":[],"margin":[],"shadow":[],"w":"","h":"","css":"background-color: rgb(193, 170, 143); "},"link":{"status":true,"fonts":[],"font_color":{"normal":"rgb(255, 255, 255)","hover":"rgb(255, 255, 255)"},"background":{"normal":"","hover":"rgb(0, 0, 0)"},"border":{"normal":[],"hover":[]},"padding":[],"margin":[],"shadow":{"normal":[],"hover":[]},"f_size":"12px","text_align":"left","css_normal":"color: rgb(255, 255, 255); font-size: 12px; text-align: left; ","css_hover":"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0); "}},"megamenu":{"wrapper":{"status":true,"fonts":[],"background":"","color":"","f_size":"13px","text_align":"left","border":{"status":true,"size":"all","size_all":"5","size_t":0,"size_r":0,"size_b":0,"size_l":0,"style":"solid","radius":"all","radius_all":0,"radius_t":0,"radius_r":0,"radius_b":0,"radius_l":0,"color_type":"all","color":"rgb(193, 170, 143)","color_t":"#eeeeee","color_r":"#eeeeee","color_b":"#eeeeee","color_l":"#eeeeee","css":"border: 5px; border-style: solid;border-color: rgb(193, 170, 143);border-radius: 0px;"},"padding":[],"margin":[],"shadow":[],"w":"","h":"","css":"border: 5px; border-style: solid;border-color: rgb(193, 170, 143);border-radius: 0px;"},"normalmenu":{"block":[],"heading":[],"links":[]},"catblock1":{"block":[],"heading":{"status":true,"fonts":{"status":true,"type":"google","family":"Droid+Serif","variants":"regular","subsets":"latin","size":"13px","line_height":"1.2","style":"normal","transform":"none","letter_spacing":"0px","color":"#666666","css":"font-family: Droid Serif; font-size: 13px; line-height: 1.2; font-style: normal; font-weight: normal; color: #666666; text-transform: none; letter-spacing: 0px;"},"font_color":{"normal":"rgb(73, 73, 82)","hover":"rgb(0, 0, 0)"},"background":{"normal":"","hover":""},"border":{"normal":{"status":true,"size":"dif","size_all":0,"size_t":0,"size_r":0,"size_b":"1","size_l":0,"style":"dotted","radius":"all","radius_all":0,"radius_t":0,"radius_r":0,"radius_b":0,"radius_l":0,"color_type":"all","color":"rgba(0, 0, 0, 0.1)","color_t":"#eeeeee","color_r":"#eeeeee","color_b":"#eeeeee","color_l":"#eeeeee","css":"border-width: 0px 0px 1px 0px;border-style: dotted;border-color: rgba(0, 0, 0, 0.1);border-radius: 0px;"},"hover":[]},"padding":{"status":true,"type":"dif","pad":0,"pad_type":"inherit","pad_t":0,"pad_t_type":"inherit","pad_r":0,"pad_r_type":"inherit","pad_b":"11","pad_b_type":"int","pad_l":0,"pad_l_type":"inherit","css":"padding-top: inherit; padding-right: inherit; padding-bottom: 11px; padding-left: inherit; "},"margin":[],"shadow":{"normal":[],"hover":[]},"f_size":"16px","text_align":"left","css_normal":"font-family: Droid Serif; font-size: 13px; line-height: 1.2; font-style: normal; font-weight: normal; color: #666666; text-transform: none; letter-spacing: 0px;color: rgb(73, 73, 82); border-width: 0px 0px 1px 0px;border-style: dotted;border-color: rgba(0, 0, 0, 0.1);border-radius: 0px;padding-top: inherit; padding-right: inherit; padding-bottom: 11px; padding-left: inherit; font-size: 16px; text-align: left; ","css_hover":"color: rgb(0, 0, 0); "},"links":{"status":true,"fonts":[],"font_color":{"normal":"rgb(193, 170, 143)","hover":"rgb(0, 0, 0)"},"background":{"normal":"","hover":""},"border":{"normal":[],"hover":[]},"padding":[],"margin":[],"shadow":{"normal":[],"hover":[]},"f_size":"13px","text_align":"left","css_normal":"color: rgb(193, 170, 143); font-size: 13px; text-align: left; ","css_hover":"color: rgb(0, 0, 0); "}},"catblock2":{"block":[],"image":[],"heading":[],"links":[]},"prdblock1":{"block":[],"linktext":{"normal":"","hover":""},"price":"","button":{"status":true,"fonts":{"status":true,"type":"default","family":"Arial, Helvetica, sans-serif","variants":"regular","subsets":"latin","size":"11px","line_height":"1.2","style":"normal","transform":"uppercase","letter_spacing":"0px","color":"#666666","css":"font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 1.2; font-style: normal; font-weight: normal; color: #666666; text-transform: uppercase; letter-spacing: 0px;"},"font_color":{"normal":"rgb(255, 255, 255)","hover":"rgb(255, 255, 255)"},"background":{"normal":"rgb(193, 170, 143)","hover":"rgb(0, 0, 0)"},"border":{"normal":{"status":true,"size":"all","size_all":0,"size_t":0,"size_r":0,"size_b":0,"size_l":0,"style":"solid","radius":"all","radius_all":0,"radius_t":0,"radius_r":0,"radius_b":0,"radius_l":0,"color_type":"all","color":"#eeeeee","color_t":"#eeeeee","color_r":"#eeeeee","color_b":"#eeeeee","color_l":"#eeeeee","css":"border: 0px; border-style: solid;border-color: #eeeeee;border-radius: 0px;"},"hover":{"status":true,"size":"all","size_all":0,"size_t":0,"size_r":0,"size_b":0,"size_l":0,"style":"solid","radius":"all","radius_all":0,"radius_t":0,"radius_r":0,"radius_b":0,"radius_l":0,"color_type":"all","color":"#eeeeee","color_t":"#eeeeee","color_r":"#eeeeee","color_b":"#eeeeee","color_l":"#eeeeee","css":"border: 0px; border-style: solid;border-color: #eeeeee;border-radius: 0px;"}},"padding":{"status":true,"type":"dif","pad":0,"pad_type":"inherit","pad_t":"4","pad_t_type":"int","pad_r":"10","pad_r_type":"int","pad_b":"4","pad_b_type":"int","pad_l":"10","pad_l_type":"int","css":"padding-top: 4px; padding-right: 10px; padding-bottom: 4px; padding-left: 10px; "},"margin":[],"shadow":{"normal":[],"hover":[]},"f_size":"13px","text_align":"left","css_normal":"font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 1.2; font-style: normal; font-weight: normal; color: #666666; text-transform: uppercase; letter-spacing: 0px;color: rgb(255, 255, 255); background-color: rgb(193, 170, 143); border: 0px; border-style: solid;border-color: #eeeeee;border-radius: 0px;padding-top: 4px; padding-right: 10px; padding-bottom: 4px; padding-left: 10px; ","css_hover":"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0); border: 0px; border-style: solid;border-color: #eeeeee;border-radius: 0px;"}},"prdblock2":{"block":[],"linktext":{"normal":"","hover":""},"price":"","button":{"status":true,"fonts":{"status":true,"type":"default","family":"Arial, Helvetica, sans-serif","variants":"regular","subsets":"latin","size":"10px","line_height":"1.0","style":"normal","transform":"uppercase","letter_spacing":"0px","color":"#666666","css":"font-family: Arial, Helvetica, sans-serif; font-size: 10px; line-height: 1.0; font-style: normal; font-weight: normal; color: #666666; text-transform: uppercase; letter-spacing: 0px;"},"font_color":{"normal":"rgb(255, 255, 255)","hover":"rgb(255, 255, 255)"},"background":{"normal":"rgb(193, 170, 143)","hover":"rgb(0, 0, 0)"},"border":{"normal":{"status":true,"size":"all","size_all":0,"size_t":0,"size_r":0,"size_b":0,"size_l":0,"style":"solid","radius":"all","radius_all":0,"radius_t":0,"radius_r":0,"radius_b":0,"radius_l":0,"color_type":"all","color":"#eeeeee","color_t":"#eeeeee","color_r":"#eeeeee","color_b":"#eeeeee","color_l":"#eeeeee","css":"border: 0px; border-style: solid;border-color: #eeeeee;border-radius: 0px;"},"hover":{"status":true,"size":"all","size_all":0,"size_t":0,"size_r":0,"size_b":0,"size_l":0,"style":"solid","radius":"all","radius_all":0,"radius_t":0,"radius_r":0,"radius_b":0,"radius_l":0,"color_type":"all","color":"#eeeeee","color_t":"#eeeeee","color_r":"#eeeeee","color_b":"#eeeeee","color_l":"#eeeeee","css":"border: 0px; border-style: solid;border-color: #eeeeee;border-radius: 0px;"}},"padding":{"status":true,"type":"dif","pad":0,"pad_type":"inherit","pad_t":"3","pad_t_type":"int","pad_r":"6","pad_r_type":"int","pad_b":"2","pad_b_type":"int","pad_l":"6","pad_l_type":"int","css":"padding-top: 3px; padding-right: 6px; padding-bottom: 2px; padding-left: 6px; "},"margin":[],"shadow":{"normal":[],"hover":[]},"f_size":"13px","text_align":"left","css_normal":"font-family: Arial, Helvetica, sans-serif; font-size: 10px; line-height: 1.0; font-style: normal; font-weight: normal; color: #666666; text-transform: uppercase; letter-spacing: 0px;color: rgb(255, 255, 255); background-color: rgb(193, 170, 143); border: 0px; border-style: solid;border-color: #eeeeee;border-radius: 0px;padding-top: 3px; padding-right: 6px; padding-bottom: 2px; padding-left: 6px; ","css_hover":"color: rgb(255, 255, 255); background-color: rgb(0, 0, 0); border: 0px; border-style: solid;border-color: #eeeeee;border-radius: 0px;"}},"brandblock1":{"block":{"normal":[],"hover":[]},"linktext":{"normal":[],"hover":[]}},"brandblock2":{"block":[],"hover":{"background":"","textcolor":""}},"imageblock1":{"block":{"normal":[],"hover":[]},"linktext":{"normal":[],"hover":[]}},"imageblock2":{"block":[],"hover":{"background":"","textcolor":""}},"imageblock3":{"block":{"normal":[],"hover":[]},"linktext":{"normal":[],"hover":[]}},"imageblock4":{"block":[]},"infoblock1":{"block":[],"image":[],"heading":[],"content":[],"button_wrp":[],"button":[]},"infoblock2":{"block":[],"image":[],"heading":[],"content":[],"button_wrp":[],"button":[]},"infoblock3":{"block":[],"image":[],"heading":[],"content":[],"button_wrp":[],"button":[]},"infoblock4":{"block":[],"image":[],"heading":[],"content":[],"button":[]},"customhtml":{"block":[]}},"m_handle":{"status":true,"fonts":[],"background":"rgba(255, 255, 255, 0.3)","color":"","f_size":"13px","text_align":"left","border":[],"padding":[],"margin":[],"shadow":[],"w":"","h":"","css":"background-color: rgba(255, 255, 255, 0.3); font-size: 13px; "},"m_subhandle":[],"m_nav":{"status":true,"fonts":[],"background":"rgba(255, 255, 255, 0.3)","color":"","f_size":"13px","text_align":"left","border":{"status":true,"size":"all","size_all":0,"size_t":0,"size_r":0,"size_b":0,"size_l":0,"style":"solid","radius":"all","radius_all":0,"radius_t":0,"radius_r":0,"radius_b":0,"radius_l":0,"color_type":"all","color":"#eeeeee","color_t":"#eeeeee","color_r":"#eeeeee","color_b":"#eeeeee","color_l":"#eeeeee","css":"border: 0px; border-style: solid;border-color: #eeeeee;border-radius: 0px;"},"padding":[],"margin":[],"shadow":[],"w":"","h":"","css":"background-color: rgba(255, 255, 255, 0.3); border: 0px; border-style: solid;border-color: #eeeeee;border-radius: 0px;"},"m_subwrp":[],"m_mainitem":{"status":true,"fonts":[],"background":"","color":"","f_size":"13px","text_align":"left","border":{"status":true,"size":"dif","size_all":0,"size_t":0,"size_r":0,"size_b":"1","size_l":0,"style":"dotted","radius":"all","radius_all":0,"radius_t":0,"radius_r":0,"radius_b":0,"radius_l":0,"color_type":"all","color":"rgba(255, 255, 255, 0.3)","color_t":"#eeeeee","color_r":"#eeeeee","color_b":"#eeeeee","color_l":"#eeeeee","css":"border-width: 0px 0px 1px 0px;border-style: dotted;border-color: rgba(255, 255, 255, 0.3);border-radius: 0px;"},"padding":[],"margin":[],"shadow":[],"w":"","h":"","css":"font-size: 13px; border-width: 0px 0px 1px 0px;border-style: dotted;border-color: rgba(255, 255, 255, 0.3);border-radius: 0px;"},"m_subitem":[]}');


DELETE FROM `layout_module` WHERE `code` LIKE '%menu%';

INSERT INTO `layout_module` (`layout_id`, `code`, `position`, `sort_order`) VALUES ('9999', 'rgen_menu.set_rgRiF.rgvP4', 'main_menu', '0');


DELETE FROM `setting` WHERE `code` LIKE '%menu%';

INSERT INTO `setting` (`store_id`, `code`, `key`, `value`, `serialized`) VALUES ('0', 'rgen_menu', 'rgen_menu_R.set_rgRiF.rgvP4', '1', '0');
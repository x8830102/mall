<?php
define('DIR_THEME'               , 'rgen-opencart');
define('RGEN_VER'                , '4.24');
define('RGEN_APP'                , DIR_SYSTEM . '../rgen/system/rgen_app.php');

// FRONT
define('FILE_FRONT_ASSETS'       , DIR_SYSTEM.'../rgen/data/catalog/assets_data.json');
define('FILE_FRONT_CONFIG'       , DIR_SYSTEM.'../rgen/data/catalog/default_config.json');
define('FILE_FRONT_PARTIALS'     , DIR_SYSTEM.'../rgen/data/catalog/partials.json');
define('FILE_CSS_PROCESSOR'      , DIR_THEME.'/template/rgen/css_processor.tpl');
define('FILE_CONFIG_STYLE'       , 'catalog/view/theme/'.DIR_THEME.'/stylesheet/config_style.css');
define('DIR_FRONT_MODULE'        , DIR_THEME.'/template/rgen/');

// CACHING SYSTEM
define('DIR_MINIFY_CSS'          , 'rgen/cache/css/');
define('DIR_MINIFY_JS'           , 'rgen/cache/js/');
define('FILE_CACHING'            , DIR_SYSTEM.'../rgen/catalog/controller/modules/module_common/caching.php');
define('FILE_MODULE_COMMON'      , DIR_SYSTEM.'../rgen/catalog/controller/modules/module_common/common_fn.php');
define('FILE_MODULE_RENDER'      , DIR_SYSTEM.'../rgen/catalog/controller/modules/module_common/module_render.php');
define('DIR_MODULE_CACHE'        , 'rgen/cache/modules/');

// ADMIN
define('FILE_ADMIN_ASSETS'       , DIR_SYSTEM.'../rgen/data/admin/assets_data.json');
define('FILE_ADMIN_PARTIALS'     , DIR_SYSTEM.'../rgen/data/admin/partials.json');
define('FILE_ADMIN_CONFIG'       , '');
define('DIR_DB_BACKUP'           , DIR_SYSTEM.'../rgen/data/db_backup/');
define('DIR_THEME_STORAGE'       , DIR_SYSTEM.'../rgen/data/theme_storage/');
define('FILE_THEME_STORAGE_LIST' , DIR_THEME_STORAGE.'rgen_themelist.json');
define('DIR_ADMIN_TPL'           , '../rgen/admin/template/');
define('DIR_ADMIN_DIRECTIVE'     , '../rgen/admin/template/directive/');

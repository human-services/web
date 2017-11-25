<?php
$salt = "h0lm3sCOUNTY!@#";

$allow_ips = "54.173.109.62";

$openapi_hsda_url = 'https://raw.githubusercontent.com/human-services/holmes-county-portal/master/_data/api-commons/openapi-hsda.yaml';
$openapi_hsda_search_url = 'https://raw.githubusercontent.com/human-services/holmes-county-portal/master/_data/api-commons/openapi-hsda-search.yaml';
$openapi_hsda_bulk_url = 'https://raw.githubusercontent.com/human-services/holmes-county-portal/master/_data/api-commons/openapi-hsda-bulk.yaml';
$openapi_hsda_meta_url = 'https://raw.githubusercontent.com/human-services/holmes-county-portal/master/_data/api-commons/openapi-hsda-meta.yaml';
$openapi_hsda_taxonomy_url = 'https://raw.githubusercontent.com/human-services/holmes-county-portal/master/_data/api-commons/openapi-hsda-taxonomy.yaml';
$openapi_hsda_management_url = 'https://raw.githubusercontent.com/human-services/holmes-county-portal/master/_data/api-commons/openapi-hsda-management.yaml';
$openapi_hsda_orchestation_url = '';
$openapi_hsda_utility_url = 'https://raw.githubusercontent.com/human-services/holmes-county-portal/master/_data/api-commons/openapi-hsda-utility.yaml';

$default_openapi_hsda_url;

$openapi = array();

// HSDA
if($openapi_hsda_url!='')
	{ 
	$openapi_yaml_raw = file_get_contents($openapi_hsda_url);
	$openapi_yaml = yaml_parse($openapi_yaml_raw);		
	$openapi['hsda'] = $openapi_yaml;
	}
else
	{ 
	$openapi['hsda'] = array();
	}
	
// HSDA Search
if($openapi_hsda_search_url!='')
	{ 
	$openapi_yaml_raw = file_get_contents($openapi_hsda_search_url);
	$openapi_yaml = yaml_parse($openapi_yaml_raw);		
	$openapi['hsda-search'] = $openapi_yaml;
	}
else
	{ 
	$openapi['hsda-search'] = array();
	}
	
// HSDA Bulk
if($openapi_hsda_bulk_url!='')
	{ 
	$openapi_yaml_raw = file_get_contents($openapi_hsda_bulk_url);
	$openapi_yaml = yaml_parse($openapi_yaml_raw);		
	$openapi['hsda-bulk'] = $openapi_yaml;
	}
else
	{ 
	$openapi['hsda-bulk'] = array();
	}	
	
// HSDA Meta
if($openapi_hsda_meta_url!='')
	{ 
	$openapi_yaml_raw = file_get_contents($openapi_hsda_meta_url);
	$openapi_yaml = yaml_parse($openapi_yaml_raw);		
	$openapi['hsda-meta'] = $openapi_yaml;
	}
else
	{ 
	$openapi['hsda-meta'] = array();
	}	
	
// HSDA Taxonomy
if($openapi_hsda_taxonomy_url!='')
	{ 
	$openapi_yaml_raw = file_get_contents($openapi_hsda_taxonomy_url);
	$openapi_yaml = yaml_parse($openapi_yaml_raw);		
	$openapi['hsda-taxonomy'] = $openapi_yaml;
	}
else
	{ 
	$openapi['hsda-taxonomy'] = array();
	}
	
// HSDA Management
if($openapi_hsda_management_url!='')
	{ 
	$openapi_yaml_raw = file_get_contents($openapi_hsda_management_url);
	$openapi_yaml = yaml_parse($openapi_yaml_raw);		
	$openapi['hsda-management'] = $openapi_yaml;
	}
else
	{ 
	$openapi['hsda-management'] = array();
	}
	
// HSDA Orchestration
if($openapi_hsda_orchestation_url!='')
	{ 
	$openapi_yaml_raw = file_get_contents($openapi_hsda_orchestation_url);
	$openapi_yaml = yaml_parse($openapi_yaml_raw);		
	$openapi['hsda-orchestration'] = $openapi_yaml;
	}
else
	{ 
	$openapi['hsda-orchestration'] = array();
	}
	
// HSDA Utility
if($openapi_hsda_utility_url!='')
	{ 
	$openapi_yaml_raw = file_get_contents($openapi_hsda_utility_url);
	$openapi_yaml = yaml_parse($openapi_yaml_raw);		
	$openapi['hsda-utility'] = $openapi_yaml;
	}
else
	{ 
	$openapi['hsda-utility'] = array();
	}	
	
// SET Default
$openapi['hsda-default-system'] = 'hsda';
$openapi['hsda-default'] = $openapi['hsda'];

$admin_login = 'apievangelist';
$admin_code = 'a72da85fe82199de92ced6f626145c2d6f42446b';
	
$apis_json = 'https://raw.githubusercontent.com/human-services/portal/master/_data/apis.yaml';
?>


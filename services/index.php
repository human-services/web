<?php
require_once "../config.php";
require_once "../graphical/header.php";
?>

<?php

// grab this path
$host = "http://" . $openapi['hsda-default']['host'];
//echo "host: " . $host . "<br />";

// grab this path
$definitions = $openapi['hsda-default']['definitions'];

// organizations
$services_path = '/services/full/';
$services_url = $host . $services_path;
//echo "url: " . $services_url . "<br />";

$http = curl_init();  
curl_setopt($http, CURLOPT_URL, $services_url);  
curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);   

$output = curl_exec($http);
//echo $output;
$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
$info = curl_getinfo($http);
$services = json_decode($output);
?>
<h4>Services</h4>
<p>These are the services available in the Holmes County Human Services Database.</p>
<div class="table-wrapper">
<table class="alt">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th></th>
		</tr>
	</thead>
	<tbody>			
	<?php				
	foreach($services as $service)
		{
		$id = $service->id;
		$organization_id = $service->organization_id;
		$program_id = $service->program_id;
		$location_id = $service->location_id;
		$name = $service->name;
		$alternate_name = $service->alternate_name;
		$description = $service->description;
		$url = $service->url;
		$email = $service->email;
		$status = $service->status;
		$interpretation_services = $service->interpretation_services;
		$application_process = $service->application_process;
		$wait_time = $service->wait_time;
		$fees = $service->fees;
		$accreditations = $service->accreditations;
		$licenses = $service->licenses;
    	?>
		<tr>
			<td><?php echo $name; ?></td>
			<td><?php echo $description; ?></td>
			<td align="center" valign="middle">
				<a href="/services/details.php?id=<?php echo $id; ?>" class="button">View Details</a>
			</td>
		</tr>
    	<?php			    	
		}
		?>
	</tbody>
</table>
</div>
<?php
require_once "../graphical/footer.php";
?>
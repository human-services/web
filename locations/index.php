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
$locations_path = '/locations/full/';
$locations_url = $host . $locations_path;
//echo "url: " . $locations_url . "<br />";

$http = curl_init();  
curl_setopt($http, CURLOPT_URL, $locations_url);  
curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);   

$output = curl_exec($http);
$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
$info = curl_getinfo($http);
$organizations = json_decode($output);
?>
<h4>Locations</h4>
<p>These are the locations available in the Holmes County Human Services Database.</p>
<div class="table-wrapper">
	<table class="alt">
		<thead>
			<tr>
				<th>Location Name</th>
				<th>Description</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach($organizations as $organization)
			{
			$id = $organization->id;
			$organization_id = $organization->organization_id;
			$name = $organization->name;
			$alternate_name = $organization->alternate_name;
			$description = $organization->description;
			$transportation = $organization->transportation;
			$latitude = $organization->latitude;
			$longitude = $organization->longitude;
			$regular_schedule = $organization->regular_schedule;
			$holiday_schedule = $organization->holiday_schedule;
			$languages = $organization->languages;
			$postal_address = $organization->postal_address;
			$physical_address = $organization->physical_address;
			$phones = $organization->phones;
			$service = $organization->service;
			$accessibility_for_disabilities = $organization->accessibility_for_disabilities;
			?>
			<tr>
				<td><?php echo $name; ?></td>
				<td><?php echo $description; ?></td>
				<td align="center" valign="middle">
					<a href="details.php?id=<?php echo $id; ?>" class="button">Edit Details</a>
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
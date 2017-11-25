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
$organization_path = '/organizations/full/';
$organization_url = $host . $organization_path;
//echo "url: " . $organization_url . "<br />";

$http = curl_init();  
curl_setopt($http, CURLOPT_URL, $organization_url);  
curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);   

$output = curl_exec($http);
//echo "HERE:" . $output;

$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
$info = curl_getinfo($http);
$organizations = json_decode($output);
?>
<h4>Organizations</h4>
<p>These are the organizations available in the Holmes County Human Services Database.</p>
<div class="table-wrapper">
	<table class="alt">
		<thead>
			<tr>
				<th>Organization Name</th>
				<th>Description</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach($organizations as $organization)
			{
			$id = $organization->id;
			$name = $organization->name;
			$alternate_name = $organization->alternate_name;
			$description = $organization->description;
			$email = $organization->email;
			$url = $organization->url;
			$tax_status = $organization->tax_status;
			$tax_id = $organization->tax_id;
			$year_incorporated = $organization->year_incorporated;
			$legal_status = $organization->legal_status;
			$contacts = $organization->contacts;
			$funding = $organization->funding;
			$locations = $organization->locations;
			$programs = $organization->programs;
			$services = $organization->services;
			?>
			<tr>
				<td><?php echo $name; ?></td>
				<td><?php echo $description; ?></td>
				<td align="center" valign="middle">
					<a href="details.php?id=<?php echo $id; ?>" class="button">View Details</a></li>
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
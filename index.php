<?php
require_once "config.php";
require_once "graphical/header.php";
?>

<h4>Holmes County Human Services</h4>
<p>This is the main search for the Holmes County Human Services. A search will return information across all organizations, locations, and services. You can also browse all three areas by selecting them on the left hand navigation.</p>
<center>
<form method="post" action="/" method="get">
	<div class="row uniform">
		<div align="center" style="width: 80%">
			<center><input type="text" name="query" id="query" value="<?php if(isset($_REQUEST['query'])){ echo $_REQUEST['query']; } ?>" placeholder="Search Keyword or Phrase" style="width: 100%; margin-left: 100px; margin-right: 100px;" /></center>
		</div>
		<!-- Break -->
		<div class="12u$">
			<ul class="actions">
				<li><input type="submit" value="Search" class="special" /></li>
				<li><input type="reset" value="Reset" /></li>
			</ul>
		</div>
	</div>
</form>
</center>

<?php

if(isset($_REQUEST['query']))
	{

	$query = $_REQUEST['query'];
	//echo "query: " . $query . "<br />";

	// grab this path
	$host = "http://" . $openapi['hsda-search']['host'];
	//echo "host: " . $host . "<br />";
	
	// grab this path
	$definitions = $openapi['hsda-search']['definitions'];
	
	// organizations
	$search_path = '/search/?query=' . $query;
	$search_url = $host . $search_path;
	//echo "url: " . $search_url . "<br />";
	
	$http = curl_init();  
	curl_setopt($http, CURLOPT_URL, $search_url);  
	curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);   
	
	$output = curl_exec($http);
	//echo $output;
	$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
	$info = curl_getinfo($http);
	$search = json_decode($output);
	//var_dump($search);

	$organizations = $search->organizations;
	?>
	<h4>Organizations</h4>
	<div class="table-wrapper">
		<table class="alt">
			<tbody>
			<?php
			if(count($organizations) > 0)
				{			
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
				}
			else
				{
		    	?>
				<tr>
					<td colspan="3" align="center">No Organizations Returned</td>
				</tr>
		    	<?php				
				}					
			?>
			</tbody>
		</table>
	</div>			
	<?php
	$locations = $search->locations;
	?>
	<h4>Locations</h4>
	<div class="table-wrapper">
		<table class="alt">
			<tbody>
			<?php
			if(count($services) > 0)
				{			
				foreach($locations as $location)
					{
					$id = $location->id;
					$organization_id = $location->organization_id;
					$name = $location->name;
					$alternate_name = $location->alternate_name;
					$description = $location->description;
					$transportation = $location->transportation;
					$latitude = $location->latitude;
					$longitude = $location->longitude;
					$regular_schedule = $location->regular_schedule;
					$holiday_schedule = $location->holiday_schedule;
					$languages = $location->languages;
					$postal_address = $location->postal_address;
					$physical_address = $location->physical_address;
					$phones = $location->phones;
					$service = $location->service;
					$accessibility_for_disabilities = $location->accessibility_for_disabilities;
					?>
					<tr>
						<td><?php echo $name; ?></td>
						<td><?php echo $description; ?></td>
						<td align="center" valign="middle">
							<a href="details.php?id=<?php echo $id; ?>" class="button">View Details</a>
						</td>
					</tr>
					<?php
					}
				}
			else
				{
		    	?>
				<tr>
					<td colspan="3" align="center">No Locations Returned</td>
				</tr>
		    	<?php				
				}				
			?>
			</tbody>
		</table>
	</div>			
	<?php			
	$services = $search->services;
	?>
	<h4>Services</h4>
	<div class="table-wrapper">
	<table class="alt">
		<tbody>			
		<?php	
		if(count($services) > 0)
			{
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
			}
		else
			{
	    	?>
			<tr>
				<td colspan="3" align="center">No Services Returned</td>
			</tr>
	    	<?php				
			}
			?>
		</tbody>
	</table>
	</div>			
	<?php
	}
	?>
	<p>Use the left hand navigation to browse organizations, locations, and services. You can also navigate to the developer API for the Holmes County Human Services, as well as the administrative area if you have proper access.</p>
	<?php
require_once "graphical/footer.php";
?>
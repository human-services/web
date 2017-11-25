<?php
require_once "../config.php";
require_once "../graphical/header.php";
?>

<?php

if(isset($_REQUEST['id']))
	{
	
	$id = $_REQUEST['id'];
	
	// grab this path
	$host = "http://" . $openapi['hsda-default']['host'];
	//echo "host: " . $host . "<br />";
	
	// grab this path
	$definitions = $openapi['hsda-default']['definitions'];
	
	// organizations
	$organization_path = '/organizations/full/' . $id . "/";
	$organization_url = $host . $organization_path;
	//echo "url: " . $organization_url . "<br />";
	
	$http = curl_init();  
	curl_setopt($http, CURLOPT_URL, $organization_url);  
	curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);   
	
	$output = curl_exec($http);
	$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
	$info = curl_getinfo($http);
	//echo $output;
	$organization = json_decode($output);
	$organization = $organization[0];
	//var_dump($organization);

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
	<h3><?php echo $name; ?><?php if($alternate_name!=''){ ?> (<?php echo $alternate_name;  ?>)<?php } ?></h3>
	<p><?php echo $description; ?></p>
	<hr />
	<?php
	if($email!='')
		{
		?><strong>Email:</strong> <?php echo $email; ?><br /><?php
		}
	?>
	<?php
	if($url!='')
		{
		?><strong>URL:</strong> <?php echo $url; ?><br /><?php	
		}
	?>
	
	<hr />
	<?php
	if($tax_status!='')
		{
		?><strong>Tax Status:</strong> <?php echo $tax_status; ?><br /><?php
		}
	?>
	
	<?php
	if($tax_id!='')
		{
		?><strong>Tax ID:</strong> <?php echo $tax_id; ?><br /><?php	
		}
	?>	
	<?php
	if($tax_id!='')
		{
		?><strong>Legal Status:</strong> <?php echo $legal_status; ?><br /><?php	
		}
	?>	
	
	<hr />
	<h4>Contacts</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($contacts) > 0) 
			{ 
			?>
			<table class="alt">
				<thead>
					<tr>
						<th>Name</th>
						<th>Title</th>
						<th>Department</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>			
				<?php				
				foreach($contacts as $contact)
					{
					$id = $contact->id;
					$organization_id = $contact->organization_id;
					$service_id = $contact->service_id;
					$service_at_location_id = $contact->service_at_location_id;
					$name = $contact->name;
					$title = $contact->title;
					$department = $contact->department;
			    	$email = $contact->email;
			    	?>
					<tr>
						<td><?php echo $name; ?></td>
						<td><?php echo $title; ?></td>
						<td><?php echo $department; ?></td>
						<td><?php echo $email; ?></td>
					</tr>
			    	<?php			    	
					}
					?>
				</tbody>
			</table>				
			<?php  
			} 
		else 
			{ 
			?>
			<p>No Contacts</p>
			<?php 
			} 
		?>
	</div>
	
	<hr />
	<h4>Funding</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($funding) > 0) 
			{ 
			?>
			<table class="alt">
				<thead>
					<tr>
						<th>Source</th>
					</tr>
				</thead>
				<tbody>			
				<?php				
				foreach($funding as $fund)
					{
					$id = $fund->id;
					$organization_id = $fund->organization_id;
					$service_id = $fund->service_id;
					$source = $fund->source;
			    	?>
					<tr>
						<td><?php echo $source; ?></td>
					</tr>
			    	<?php
					}
					?>
				</tbody>
			</table>				
			<?php 
			} 
		else 
			{ 
			?>
			<p>No Funding Entries</p>
			<?php 
			} 
		?>
	</div>
	
	<hr />
	<h4>Locations</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($locations) > 0) 
			{ 
			?>
			<table class="alt">
				<tbody>			
				<?php
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
						<td align="center" valign="middle" width="20%">
							<a href="/locations/details.php?id=<?php echo $id; ?>" class="button">View Details</a>
						</td>
					</tr>
			    	<?php
					}
				?>
				</tbody>
			</table>
			<?php 
			} 
		else 
			{ 
			?>
			<p>No Locations</p>
			<?php 
			} 
		?>
	</div>	

	<hr />
	<h4>Programs</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($programs) > 0) 
			{ 
			?>
			<table class="alt">
				<thead>
					<tr>
						<th>Source</th>
					</tr>
				</thead>
				<tbody>			
				<?php				
				foreach($programs as $program)
					{
					$id = $fund->id;
					$organization_id = $fund->organization_id;
					$name = $fund->name;
					$alternate_name = $fund->alternate_name;
					
			    	?>
					<tr>
						<td><?php echo $name; ?>><?php if($alternate_name!=''){ ?> (<?php echo $alternate_name;  ?>)<?php } ?></td>
					</tr>
			    	<?php
					}
					?>
				</tbody>
			</table>				
			<?php 
			} 
		else 
			{ 
			?>
			<p>No Programs</p>
			<?php 
			} 
		?>
	</div>

	<hr />
	<h4>Services</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($services) > 0) 
			{ 
			?>
			<table class="alt">
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
						<td align="center" valign="middle" width="20%">
							<a href="/services/details.php?id=<?php echo $id; ?>" class="button">View Details</a>
						</td>
					</tr>
			    	<?php
					}
				?>
				</tbody>
			</table>
			<?php 
			} 
		else 
			{ 
			?>
			<p>No Locations</p>
			<?php 
			} 
		?>
	</div>	
	<p align="center"><a href="index.php"><strong>View All Listings</strong></a></p>
	<?php
	}
	
require_once "../graphical/footer.php";
?>
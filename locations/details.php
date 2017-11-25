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
	$locations_path = '/locations/full/' . $id . "/";
	$locations_url = $host . $locations_path;
	//echo "url: " . $locations_url . "<br />";
	
	$http = curl_init();  
	curl_setopt($http, CURLOPT_URL, $locations_url);  
	curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);   
	
	$output = curl_exec($http);
	$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
	$info = curl_getinfo($http);
	//echo $output;
	$organization = json_decode($output);
	$organization = $organization[0];

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
	<h3><?php echo $name; ?><?php if($alternate_name!=''){ ?> (<?php echo $alternate_name;  ?>)<?php } ?></h3>
	<p><?php echo $description; ?></p>
	
	<hr />
	<h4>Transportation</h4>
	<?php
	if($transportation!='')
		{
		?><strong>Transportation:</strong> <?php echo $transportation; ?><br /><?php	
		}
	else
		{
		?><p>No Transportation Details</p><?php	
		}
	?>	
	
	<hr />
	<h4>Latitude / Longitude</h4>
	<?php
	if($transportation!='')
		{
		?><?php echo $latitude; ?> / <?php echo $longitude; ?><br /><?php	
		}
	else
		{
		?><p>No Latitude / Longitude Entered</p><?php	
		}
	?>	
	
	<hr />
	<h4>Regular Schedule</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($regular_schedule) > 0) 
			{ 
			?>
			<table class="alt">
				<thead>
					<tr>
						<th>Weekday</th>
						<th>Opens At</th>
						<th>Close At</th>
					</tr>
				</thead>
				<tbody>			
				<?php				
				foreach($regular_schedule as $schedule)
					{
					$id = $schedule->id;
					$service_id = $schedule->service_id;
					$service_at_location_id = $schedule->service_at_location_id;
					$weekday = $schedule->weekday;
					$opens_at = $schedule->opens_at;
					$opens_at = $schedule->closes_at;
			    	?>
					<tr>
						<td><?php echo $weekday; ?></td>
						<td><?php echo $opens_at; ?></td>
						<td><?php echo $opens_at; ?></td>
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
			<p>No Regular Schedule Entered</p>
			<?php 
			} 
		?>
	</div>	
	
	<hr />
	<h4>Holiday Schedule</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($holiday_schedule) > 0) 
			{ 
			?>
			<table class="alt">
				<thead>
					<tr>
						<th>Closed</th>
						<th>Opens At</th>
						<th>Close At</th>
						<th>Start Date</th>
						<th>End Date</th>
					</tr>
				</thead>
				<tbody>			
				<?php				
				foreach($holiday_schedule as $schedule)
					{
					$id = $schedule->id;
					$service_id = $schedule->service_id;
					$service_at_location_id = $schedule->service_at_location_id;
					$closed = $schedule->closed;
					$opens_at = $schedule->opens_at;
					$closes_at = $schedule->closes_at;
					$start_date = $schedule->start_date;
					$end_date = $schedule->end_date;
			    	?>
					<tr>
						<td><?php echo $closed; ?></td>
						<td><?php echo $opens_at; ?></td>
						<td><?php echo $opens_at; ?></td>
						<td><?php echo $start_date; ?></td>
						<td><?php echo $end_date; ?></td>
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
			<p>No Holiday Schedule Entered</p>
			<?php 
			} 
		?>
	</div>	
	
	<hr />
	<h4>Languages</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($languages) > 0) 
			{ 
			?>
			<table class="alt">
				<tbody>			
				<?php				
				foreach($languages as $lang)
					{
					$id = $lang->id;
					$service_id = $lang->service_id;
					$location_id = $lang->location_id;
					$language = $lang->language;
			    	?>
					<tr>
						<td><?php echo $language; ?></td>
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
			<p>No Languages Entered</p>
			<?php 
			} 
		?>
	</div>	
	
	<hr />
	<h4>Physical Address</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($physical_address) > 0) 
			{ 
			?>
			<table class="alt">
				<thead>
					<tr>
						<th>Attention</th>
						<th>Address</th>
						<th>City</th>
						<th>Region</th>
						<th>State/Province</th>
						<th>Postal Code</th>
						<th>Country</th>
					</tr>
				</thead>
				<tbody>			
				<?php				
				foreach($physical_address as $address)
					{
					$id = $address->id;
					$location_id = $address->location_id;
					$attention = $address->attention;
					$address_1 = $address->address_1;
					$address_2 = $address->address_2;
					$address_3 = $address->address_3;
					$address_4 = $address->address_4;
					$city = $address->city;
					$region = $address->region;
					$state_province = $address->state_province;
					$postal_code = $address->postal_code;
					$country = $address->country;
			    	?>
					<tr>
						<td><?php echo $attention; ?></td>
						<td><?php echo $address_1; ?> <?php echo $address_2; ?> <?php echo $address_3; ?> <?php echo $address_4; ?></td>
						<td><?php echo $city; ?></td>
						<td><?php echo $region; ?></td>
						<td><?php echo $state_province; ?></td>
						<td><?php echo $postal_code; ?></td>
						<td><?php echo $country; ?></td>
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
			<p>No Postal Address Entered</p>
			<?php 
			} 
		?>
	</div>	
	
	<hr />
	<h4>Postal Address</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($postal_address) > 0) 
			{ 
			?>
			<table class="alt">
				<thead>
					<tr>
						<th>Attention</th>
						<th>Address</th>
						<th>City</th>
						<th>Region</th>
						<th>State/Province</th>
						<th>Postal Code</th>
						<th>Country</th>
					</tr>
				</thead>
				<tbody>			
				<?php				
				foreach($postal_address as $address)
					{
					$id = $address->id;
					$location_id = $address->location_id;
					$attention = $address->attention;
					$address_1 = $address->address_1;
					$address_2 = $address->address_2;
					$address_3 = $address->address_3;
					$address_4 = $address->address_4;
					$city = $address->city;
					$region = $address->region;
					$state_province = $address->state_province;
					$postal_code = $address->postal_code;
					$country = $address->country;
			    	?>
					<tr>
						<td><?php echo $attention; ?></td>
						<td><?php echo $address_1; ?> <?php echo $address_2; ?> <?php echo $address_3; ?> <?php echo $address_4; ?></td>
						<td><?php echo $city; ?></td>
						<td><?php echo $region; ?></td>
						<td><?php echo $state_province; ?></td>
						<td><?php echo $postal_code; ?></td>
						<td><?php echo $country; ?></td>
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
			<p>No Postal Address Entered</p>
			<?php 
			} 
		?>
	</div>	
	
	<hr />
	<h4>Phones</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($phones) > 0) 
			{ 
			?>
			<table class="alt">
				<thead>
					<tr>
						<th>Number</th>
						<th>Extension</th>
						<th>Type</th>
						<th>Department</th>
						<th>Language</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>			
				<?php				
				foreach($phones as $phone)
					{
					$id = $phone->id;
					$location_id = $phone->location_id;
					$service_id = $phone->service_id;
					$organization_id = $phone->organization_id;
					$contact_id = $phone->contact_id;
					$service_at_location_id = $phone->service_at_location_id;
					$number = $phone->number;
					$extension = $phone->extension;
					$type = $phone->type;
					$department = $phone->department;
					$language = $phone->language;
					$description = $phone->description;
			    	?>
					<tr>
						<td><?php echo $number; ?></td>
						<td><?php echo $extension; ?></td>
						<td><?php echo $region; ?></td>
						<td><?php echo $type; ?></td>
						<td><?php echo $department; ?></td>
						<td><?php echo $language; ?></td>
						<td><?php echo $description; ?></td>
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
			<p>No Phones Entered</p>
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
				<thead>
					<tr>
						<th>Attention</th>
						<th>Address</th>
						<th>City</th>
						<th>Region</th>
						<th>State/Province</th>
						<th>Postal Code</th>
						<th>Country</th>
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
			<?php  
			} 
		else 
			{ 
			?>
			<p>No Services Entered</p>
			<?php 
			} 
		?>
	</div>
	
	<hr />
	<h4>Accessibility</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($accessibility_for_disabilities) > 0) 
			{ 
			?>
			<table class="alt">
				<thead>
					<tr>
						<th>Accessibility</th>
						<th>Details</th>
					</tr>
				</thead>
				<tbody>			
				<?php				
				foreach($accessibility_for_disabilities as $access)
					{
					$id = $access->id;
					$location_id = $access->location_id;
					$accessibility = $access->accessibility;
					$details = $access->details;
			    	?>
					<tr>
						<td><?php echo $accessibility; ?></td>
						<td><?php echo $details; ?></td>
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
			<p>No Accessibility Details Entered</p>
			<?php 
			} 
		?>
	</div>	
	<p align="center"><a href="index.php"><strong>View All Listings</strong></a></p>
	<?php
	}
	
require_once "../graphical/footer.php";
?>
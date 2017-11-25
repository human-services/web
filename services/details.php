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
	$services_path = '/services/full/' . $id . "/";
	$services_url = $host . $services_path;
	//echo "url: " . $services_url . "<br />";
	
	$http = curl_init();  
	curl_setopt($http, CURLOPT_URL, $services_url);  
	curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);   
	
	$output = curl_exec($http);
	$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
	$info = curl_getinfo($http);
	//echo $output;
	$service = json_decode($output);
	$service = $service[0];

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
	$accreditations = $service->accreditations;
	$licenses = $service->licenses;
	
	$contacts = $service->contacts;
	$eligibility = $service->eligibility;
	$fees = $service->fees;
	$funding = $service->funding;
	$regular_schedule = $service->regular_schedule;
	$holiday_schedule = $service->holiday_schedule;
	$languages = $service->languages;
	$payment_accepted = $service->payment_accepted;
	$phones = $service->phones;
	$required_documents = $service->required_documents;
	$service_area = $service->service_area;

	?>
	<h3><?php echo $name; ?><?php if($alternate_name!=''){ ?> (<?php echo $alternate_name;  ?>)<?php } ?></h3>
	<p><?php echo $description; ?></p>
	
	<hr />
	<?php
	if($email!='')
		{
		?><strong>Email:</strong> <?php echo $email; ?><br /><?php
		}
	else
		{
		?><strong>Email:</strong> No Email Currently<br /><?php
		}
	?>
	<?php
	if($url!='')
		{
		?><strong>URL:</strong> <?php echo $url; ?><br /><?php	
		}
	else
		{
		?><strong>URL:</strong> No URL Currently<br /><?php
		}		
	?>
	<hr />
	<?php
	if($status!='')
		{
		?><strong>Status:</strong> <?php echo $status; ?><br /><?php
		}
	else
		{
		?><strong>Status:</strong> No Status Currently<br /><?php
		}		
	?>
	<hr />
	<?php
	if($interpretation_services!='')
		{
		?><strong>Interpretation Services:</strong> <?php echo $interpretation_services; ?><br /><?php
		}
	else
		{
		?><strong>Interpretation Services:</strong> No Interpretation Services Currently<br /><?php
		}		
	?>
	<?php
	if($application_process!='')
		{
		?><strong>Application Process:</strong> <?php echo $application_process; ?><br /><?php	
		}
	else
		{
		?><strong>Application Process:</strong> No Application Process Currently<br /><?php
		}		
	?>
	<?php
	if($wait_time!='')
		{
		?><strong>Wait Time:</strong> <?php echo $wait_time; ?><br /><?php	
		}
	else
		{
		?><strong>Wait Time:</strong> No Wait Time Currently<br /><?php
		}		
	?>
	<?php
	if($fees!='')
		{
		?><strong>Fees:</strong> <?php echo $fees; ?><br /><?php	
		}
	else
		{
		?><strong>Fees:</strong> No Fees Currently<br /><?php
		}		
	?>	
	<hr />
	<?php
	if($accreditations!='')
		{
		?><strong>Acreditation:</strong> <?php echo $accreditations; ?><br /><?php
		}
	else
		{
		?><strong>Acreditation:</strong> No Acreditation Currently<br /><?php
		}		
	?>
	<?php
	if($licenses!='')
		{
		?><strong>Licenses:</strong> <?php echo $licenses; ?><br /><?php	
		}
	else
		{
		?><strong>Licenses:</strong> No Licenses Currently<br /><?php
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
	<h4>Eligibility</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($eligibility) > 0) 
			{ 
			?>
			<table class="alt">
				<tbody>			
				<?php				
				foreach($eligibility as $eligib)
					{
					$id = $eligib->id;
					$service_id = $eligib->service_id;
					$eligibility = $eligib->eligibility;
			    	?>
					<tr>
						<td><?php echo $eligibility; ?></td>
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
			<p>No Eligibility Entries</p>
			<?php 
			} 
		?>
	</div>
	
	<hr />
	<h4>Fees</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($fees) > 0) 
			{ 
			?>
			<table class="alt">
				<tbody>			
				<?php				
				foreach($fees as $f)
					{
					$id = $f->id;
					$service_id = $f->service_id;
					$fee = $f->fee;
			    	?>
					<tr>
						<td><?php echo $fee; ?></td>
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
			<p>No Fee Entries</p>
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
	<h4>Payments Accepted</h4>
	<div style="padding-left: 10px;">
		<?php 
		if(count($payment_accepted) > 0) 
			{ 
			?>
			<table class="alt">
				<tbody>			
				<?php				
				foreach($payment_accepted as $pay)
					{
					$id = $pay->id;
					$service_id = $pay->service_id;
					$payment = $pay->payment;
			    	?>
					<tr>
						<td><?php echo $payment; ?></td>
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
			<p>No Payments Accepted Entered</p>
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
	
	<p align="center"><a href="index.php"><strong>View All Listings</strong></a></p>
	<?php
	}
	
require_once "../graphical/footer.php";
?>
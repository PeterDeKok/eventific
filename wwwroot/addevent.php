<?php

$root = $_SERVER['DOCUMENT_ROOT']."/..";

require_once($root . '/assets/includes/psl-config.php'); 

if(DEBUG) {
  ini_set("display_errors", "1");
  error_reporting(E_ALL);
}

require_once($root . '/assets/includes/classes/MysqliDb.class.php');
require_once($root . '/assets/includes/classes/session.class.php');
require_once($root . '/assets/includes/classes/Soundcloud.php');

require_once($root . '/assets/includes/db_connect.php');
require_once($root . '/assets/includes/event.inc.php');
require_once($root . '/assets/includes/functions.php');

if ((login_check($mysqli) == true) && (!(isset($_SESSION['FB']) && isset($_SESSION['valid'])))) {
    $logged = 'in';
    $_SESSION['login_type'] = "Default";
} elseif ((isset($_SESSION['FB']) && isset($_SESSION['valid']))) { 
  if (($_SESSION['FB'] == true && $_SESSION['valid'] == true)) {
    if (login_check($mysqli)) {
      $logged='in';
      $_SESSION['login_type'] = "Both";
    } else {
      $logged='in';
      $_SESSION['login_type'] = "FB";
    }
  } else {
    $logged = 'out';
    header("Location: /index.php");
    exit;
  }
} else {
    $logged = 'out';
    header("Location: /index.php");
    exit;
}

// Create Database object
$db = new MysqliDb(HOST, USER, PASSWORD, DATABASE);

// Create soundcloud client object with app credentials
$SC_client = new Services_Soundcloud('7b37fcac8f86d7d4111380375eee3911', '0e126e7ae1f33f743579e42899ffa764', 'http://eventific.mac/soundcloud.php');
$SC_client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));

if($logged == 'in') {
	if(isset($_GET['code'])){
		try {
			$SC_access_token = $SC_client->accessToken($_GET['code']);
			$SC_token = $SC_access_token['access_token'];
			$_SESSION['sc_token'] = $SC_token;
		} catch(Services_Soundcloud_invalid_Http_Response_Code_Exception $e) {
			exit($$e->getMessage());
		}
		try {
			$SC_client->setAccessToken($SC_token);
		} catch(Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
			exit($e->getMessage());
		}
		$SC_current_user = json_decode($SC_client->get('me'));
		
		$data = Array (
		    'sctoken' => $SC_token,
				'scuser' => $SC_current_user->id,
				'scusername' => $SC_current_user->username,
				'scpermalink_url' => $SC_current_user->permalink_url,
				'scavatar_url' => $SC_current_user->avatar_url
		);
		$db->where('id', $_SESSION['user_id']);
		if (!$db->update('members', $data))
		    exit('update failed: ' . $db->getLastError());
		
	} else {
		$db->where('id', $_SESSION['user_id']);
		$sc_response = $db->getOne('members', 'scuser, sctoken, scusername, scpermalink_url, scavatar_url');
		if($db->count > 0 && $sc_response['scuser'] && $sc_response['scusername'] && $sc_response['sctoken'] && $sc_response['scpermalink_url'] && $sc_response['scavatar_url']) {
			$_SESSION['SC'] = array(
				'userid' => $sc_response['scuser'],
				'username' => $sc_response['scusername'],
				'token' => $sc_response['sctoken']
			);
			$SC_current_user = new stdClass();
			$SC_current_user->id = $sc_response['scuser'];
			$SC_current_user->username = $sc_response['scusername'];
			$SC_current_user->token = $sc_response['sctoken'];
			$SC_current_user->permalink_url = $sc_response['scpermalink_url'];
			$SC_current_user->avatar_url = $sc_response['scavatar_url'];
			try {
				$SC_client->setAccessToken($SC_current_user->token);
			} catch(Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
				$SC_current_user = NULL;
				exit($e->getMessage());
			}
		}
	}
	
	if(!isset($SC_current_user)){
		$data = Array (
		    'sctoken' => NULL,
				'scuser' => NULL,
				'scusername' => NULL,
				'scpermalink_url' => NULL,
				'scavatar_url' => NULL
		);
		$db->where('id', $_SESSION['user_id']);
		if (!$db->update('members', $data))
		    exit('update failed: ' . $db->getLastError());
	} else {
		$SC_playlists = json_decode($SC_client->get('users/'.$SC_current_user->id.'/playlists')); // 49023114 (Martin Pieck)
	}
	
	$SC_event_id = "temp_id";
	
	if((isset($_GET['edit'])) && is_numeric($_GET['edit'])) {
		$editEvent = $_GET['edit'];
	} else {
		$editEvent = false;
	}
	
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Event Management System">
    <meta name="author" content="Web Technology Group 5">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title> Eventific</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <link href="assets/css/animate-custom.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
    
    <script src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="assets/js/forms.js"></script>
	<script type="text/javascript" src="assets/js/sha512.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body data-spy="scroll" data-offset="0" data-target="#navbar-main">
  
  	<div id="navbar-main">
      <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon icon-shield" style="font-size:30px; color:#3498db;"></span>
          </button>
          <a class="navbar-brand hidden-xs hidden-sm" href="index.php#home"><span class="icon icon-lamp" style="font-size:18px; color:#3498db;"></span></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php#home" class="smoothScroll">Home</a></li>
			<li> <a href="index.php#about" class="smoothScroll"> About Us</a></li>
			<li> <a href="index.php#services" class="smoothScroll"> E-ticketing</a></li>
			<li> <a href="index.php#team" class="smoothScroll"> Team</a></li>
			<li> <a href="index.php#blog" class="smoothScroll"> Stories</a></li>
			<li> <a href="index.php#contact" class="smoothScroll"> Contact</a></li>
	      <li role="presentation" class="divider"></li>
	      <?php
	        if ($logged=='in') {
	      ?>
	      <li><a href="/profile.php"> My Profile</a></li>
	      <li><a href="/redirect.php?action=logout">Log out</a></li>
	      <?php 
	        }
	      ?>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    </div>  
	
	
	<div class="container">
		<div class="row white">
			<br /><br />
			<h1 class="centered"><?php if($editEvent) { echo "EDIT"; } else { echo "CREATE";} ?> AN EVENT</h1>
			<hr />
		</div>
	</div>
	
	<!-- ==== SECTION DIVIDER1 -->
	<section class="section-divider textdivider divider1">
		<div class="container">
		</div><!-- container -->
	</section><!-- section -->
		
	<div id="greywrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					
					<div class="row">
						<div class="col-lg-offset-2 col-lg-10">
							<h2 class="centered">Soundcloud</h2>
						</div>
					</div>
			
					<div class="row">
						<div id="soundcloudWrapper" class="col-lg-offset-2 col-lg-10">
							<?php if(isset($SC_current_user)){ ?>
								<div class="avatar pull-left"><img src="<?php echo $SC_current_user->avatar_url; ?>" /></div>
								User: <a href="<?php echo $SC_current_user->permalink_url; ?>"><?php echo $SC_current_user->username; ?></a>
								<BR /><BR />
								<div class="col-md-9 pull-right">
									<form id="sc_search" method="post" name="sc_search" action="assets/includes/SC_search.php" data-success="" data-event-id="<?php echo $SC_event_id; ?>" data-member-id="<?php echo $_SESSION['user_id']; ?>">
										<div class="form-group">
											<label>Search track:</label>
											<input name="soundcloudTrack" type="text" class="form-control">
										</div>
										<div class="form-group text-center">
											<button type="submit" class="btn btn-primary">Search</button>
										</div>
									</form>
		
									<div id="sc_response"><?php
										if(isset($editEvent)) {
											$db = new MysqliDb(HOST, USER, PASSWORD, DATABASE);
	
											$db->where('event_id', $editEvent);
											$db->orderBy('addedAt', 'Desc');
											$SC_object = $db->get('soundcloud', 1);
							
											if($db->count && $SC_object[0]['sc_id']) {
												$response_html = '';
												$response_html .= '<div class="playlist_item row" data-id="'.$SC_object[0]['id'].'">';
												$response_html .= '	<div class="col-xs-3">';
												$response_html .= '		<div class="playlist_artwork">';
												$response_html .= '			<img src="'.$SC_object[0]['artwork_url'].'" />';
												$response_html .= '		</div>';
												$response_html .= '	</div>';
												$response_html .= '	<div class="col-xs-9">';
												$response_html .= '		<div class="title">'.$SC_object[0]['title'].'</div>';
												$response_html .= '		<div class="tracks">'.$SC_object[0]['type'].'</div>';
												$response_html .= '	</div>';
												$response_html .= '</div>';
												$response_html .= '<div class="collapse playlist_item_more row" id="collapseSCPlaylistsMoreOptions'.$SC_object[0]['id'].'">';
												$response_html .= '	<a class="btn btn-primary pull-right btn-xs" href="'.$SC_object[0]['permalink_url'].'">More info</a>';
												$response_html .= '</div>';
												echo $response_html;
											}
										}
									?></div>

									<div id="sc_user_playlists">
										<BR />
										<label>Playlists:</label>
										<?php
										foreach($SC_playlists as $value){
											?>
											<div class="playlist_item row" data-id="<?php echo $value->id; ?>" data-permalink_url="<?php echo $value->permalink_url; ?>">
												<div class="col-xs-3">
													<div class="playlist_artwork">
														<?php 
															if($value->artwork_url) {
																$sc_artwork = $value->artwork_url;
															} else {
																$sc_artwork = $value->tracks[0]->artwork_url;
															}
														?>
														<img src="<?php echo $sc_artwork; ?>" />
													</div>
												</div>
												<div class="col-xs-9">
													<div class="title"><?php echo $value->title; ?></div>
													<?php
													$hours = floor(($value->duration/1000) / 3600);
													$mins = floor((($value->duration/1000) - ($hours * 3600)) / 60);
													$secs = floor(($value->duration/1000) % 60);
													?>
													<div class="tracks"><?php echo count($value->tracks); ?>&nbsp;tracks, <?php echo $hours . 'h ' . $mins . 'm ' . $secs . 's '; ?></div>
												</div>
											</div>
											<div class="collapse playlist_item_more row" id="collapseSCPlaylistsMoreOptions<?php echo $value->id ?>">
												<a class="btn btn-primary pull-right btn-xs use" data-id="<?php echo $value->id; ?>" data-artwork="<?php echo $sc_artwork; ?>" data-title="<?php echo $value->title; ?>" data-type="playlists" data-member-id="<?php echo $_SESSION['user_id']; ?>" data-event-id="<?php echo $SC_event_id; ?>" data-permalink-url="<?php echo $value->permalink_url; ?>" href="#">Use</a><a class="btn btn-primary pull-right btn-xs" href="<?php echo $value->permalink_url; ?>">More info</a>
											</div>
											<?php
											echo "<script>console.log(".json_encode($value).")</script>";
										}
										?>
									</div>
									<?php
										if(isset($_GET['edit']) && $db->count && $SC_object[0]['sc_id']) {
											$response_html = '';
											$response_html .= '<script>';
											$response_html .= '$("#soundcloudWrapper #sc_user_playlists").hide();';
											$response_html .= '$("#soundcloudWrapper #sc_search").hide();';
											$response_html .= '</script>';
											echo $response_html;
										}
									?>
								</div>
							<?php } else { ?>
								<a class="btn btn-primary" target="_blank" href="<?php echo $SC_client->getAuthorizeUrl(array('scope' => 'non-expiring')); ?>">
									<span class="icon icon-soundcloud"></span>
									<span>Connect with Soundcloud</span>
								</a>
							<?php } ?>
						</div><!-- /SoundcloudWrapper-->
					</div>
				</div>
				
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-10">
							<h2 class="centered">Tips</h2>
						</div>
					</div>
			
					<div class="row">
						<div class="col-lg-10">
							<div class="addEventTips">
								<ul>
									<li>First connect to soundcloud</li>
									<li>bla</li>
								</ul>
							</div>
						</div>
					</div>
					
				</div>
				
			</div>
		</div> <!-- /Container -->
	</div> <!-- /Greywrap -->
	
	<div class="container">	
    <div class="row">
      <div class="col-lg-offset-2 col-lg-8 text-center">
        <?php 
        	$editEventData = getEditForm($mysqli, $editEvent);
       		if(!is_array($editEventData)) {
						$editEventData = array(
							'id' 						=> '',
							'name' 					=> '',
							'description' 	=> '',
							'start' 				=> '',
							'duration' 			=> '',
							'location' 			=> '',
							'soundcloud_id' => ''
						);
					}
				?>
				
        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="event_form" id="eventform" role="form" class="eventform" validate>
					<div class="row control-group">
						<div class="form-group col-xs-12">
							<label>Event name</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Name" value="<?php echo $editEventData['name']; ?>" required data-validation-required-message="A name for this event is required" />
							<p class="help-block text-danger"></p>
						</div>
					</div>
					<div class="row control-group">
						<div class="form-group col-xs-12">
							<label>Start time</label>
							<input type="datetime-local" name="time" class="form-control" placeholder="Start of event: YYYY-MM-DD HH:MM" value="<?php echo $editEventData['start']; ?>" required data-validation-required-message="A start time is required" />
							<p class="help-block text-danger"></p>
						</div>
					</div>
					<div class="row control-group">
						<div class="form-group col-xs-12">
							<label>Duration</label>
							<input type="text" name="duration" id="duration" class="form-control" placeholder="Duration (minutes)" value="<?php echo $editEventData['duration']; ?>" required data-validation-required-message="A duration is required" />
							<p class="help-block text-danger"></p>
						</div>
					</div>
					<div class="row control-group">
						<div class="form-group col-xs-12">
							<label>Location</label>
							<input type="text" name="location" id="location" class="form-control" placeholder="Location" value="<?php echo $editEventData['location']; ?>" required data-validation-required-message="A location is required" />
							<p class="help-block text-danger"></p>
						</div>
					</div>
					<div class="row control-group">
						<div class="form-group col-xs-12">
							<label>Description</label>
							<textarea name="description" id="description" class="form-control" placeholder="Description" required data-validation-required-message="A description is required"><?php echo $editEventData['description']; ?></textarea>
							<p class="help-block text-danger"></p>
						</div>
					</div>
					
					<input type="hidden" name="soundcloud_id" id="soundcloud_id" value="<?php echo $editEventData['soundcloud_id']; ?>" />
          <input type="hidden" name="editID" value="<?php echo $editEventData['id']; ?>" />
          <?php
						if (isset($_SESSION['login_type'])) { 
            	if (($_SESSION['login_type']=="FB") || ($_SESSION['login_type']=="Both")) {
								echo '<input type="hidden" name="logintype" value="FB">';
            	} else {
								echo '<input type="hidden" name="logintype" value="Default">';
          		} 
          	} else {
          		echo '<input type="hidden" name="logintype" value="non">';
            	echo '<tr><td>No session set</td></tr>';
          	}
					?>
          <br>
          <div id="success"></div>
          <div class="row">
            <div class="form-group col-xs-12 submit">
              <button type="submit" class="btn btn-success btn-lg"><?php if($editEvent) { echo "EDIT"; } else { echo "CREATE";} ?></button>
            </div>
          </div>
      	</form>
  			<?php 
    			existingEvents($mysqli, $_SESSION['login_type']);
      	?>
      </div>
			<div class="col-lg-offset-1 col-lg-5">
			
	
			</div><!-- /col -->
    </div>

	</div><!-- /Container -->

  <div id="footerwrap">
    <div class="container">
      <span class="icon icon-home"></span> TU Eindhoven<br/>
      <h4></a>Eventific - Copyright 2014  ©</h4>
    </div>
  </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/retina.js"></script>
	<script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="assets/js/smoothscroll.js"></script>
	<script type="text/javascript" src="assets/js/jquery-func.js"></script>
	<script type="text/javascript" src="assets/js/soundcloud.js"></script>
  </body>
</html>
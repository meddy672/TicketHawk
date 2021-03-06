<?php
//phpinfo();
/*
 Name: 			getContactUsForm.php
 Description: 	Displays a contact form for users
 written by:	Matthew Eddy
 Created:		12/22/14
 Modified:		d/m/yr
 */
?>
<?php session_start(); ?>
<?php
require ("botdetect.php");
$name = $email = $subject = $CaptchaCode = $var = $SampleCaptcha =null;
$nameErr = $emailErr = $CaptchaCodeErr= $formErr = "";
$errors = FALSE;
?>
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />
	<style>
		#button-div {
			margin-top: 5px;
		}
		#main-container {
			width: 300px;
		}
		#Captcha-div {
			margin-top: 8px;
		}
		#CaptchaCode {
			margin-top: 5px;
		}
		.error {
			color: red;
		}
	</style>
</head>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if (empty($_POST['name'])) 
		{
			$nameErr = "Name is Requred";
			$errors =TRUE;
		} 
		else {
			$name = test_input($_POST['name']);
			if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
				$nameErr = "Only letters and white space allowed";
				$errors =TRUE;
			}
		}
		if (empty($_POST["email"])) {
			$emailErr = "Email Required";
			$errors =TRUE;
		} 
		else {
			$email = test_input($_POST['email']);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format";
				$errors =TRUE;
			}
		}
		if (empty($_POST['CaptchaCode'])) {
			$CaptchaCodeErr = "Enter code";
			$errors =TRUE;
		}
		else {
			
			if (isset($_SESSION['CaptchaCode'])) {
				$isHuman = $SampleCaptcha->Validate();
				if (! $isHuman) {
					$CaptchaCodeErr = "Code does not match";
					$errors =TRUE;
				}
				
			}
		}
		$subject = test_input($_POST['subject']);
	}
	if ($errors == FALSE) {
		$to = "meddy672@gmail.com";
		mail($to, $name, $subject);
		
	}
	else {
		$formErr = "Form incomplete";
		//header("Location:http://localhost/web%20media/getContactUsForm.php");
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = strip_tags($data);
		return $data;
	}
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="homepage.php">Ticket Hawk</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active">
							<a href="homepage.php">Home</a>
						</li>
						<li>
							<a href="#about">About</a>
						</li>
						<li>
							<a href="getContactUsForm.php">Contact</a>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Search <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li class="dropdown-header">
									Sports
								</li>
								<li>
									<a href="#">All Sports</a>
								</li>
								<li>
									<a href="#">NBA</a>
								</li>
								<li>
									<a href="#">NFL</a>
								</li>
								<li>
									<a href="#">MLB</a>
								</li>
								<li>
									<a href="#">MLH</a>
								</li>
								<li>
									<a href="#">MLS</a>
								</li>
								<li>
									<a href="#">NASCAR</a>
								</li>
								<li class="divider"></li>
								<li class="dropdown-header">
									Movies
								</li>
								<li>
									<a href="#">All Movies</a>
								</li>
								<li>
									<a href="#">New Releases</a>
								</li>
								<li>
									<a href="#">Drama</a>
								</li>
								<li>
									<a href="#">Action</a>
								</li>
								<li>
									<a href="#">Horror</a>
								</li>
								<li>
									<a href="#">Comedy</a>
								</li>
								<li>
									<a href="#">Suspense</a>
								</li>
								<li class="divider"></li>
								<li class="dropdown-header">
									Special Events
								</li>
								<li>
									<a href="#">2016 Olympics</a>
								</li>
								<li>
									<a href="#">World Cup</a>
								</li>
								<li class="divider"></li>
								<li class="dropdown-header">
									Music Tour
								</li>
								<li>
									<a href="#">On The Run(Jay Z & Beyonce)</a>
								</li>
								<li>
									<a href="#">Rock</a>
								</li>
								<li>
									<a href="#">Rap</a>
								</li>
								<li>
									<a href="#">R&B</a>
								</li>
								<li>
									<a href="#">Jazz</a>
								</li>
								<li>
									<a href="#">Gospel</a>
								</li>
								<li class="divider"></li>
								<li class="dropdown-header">
									See All Listing
								</li>
								<li>
									<a href="#">All</a>
								</li>
							</ul>
						</li>
					</ul>
					<form class="navbar-form navbar-right">
						<div class="form-group">
							<input type="text" placeholder="Email" class="form-control">
						</div>
						<div class="form-group">
							<input type="password" placeholder="Password" class="form-control">
						</div>
						<button type="submit" class="btn btn-success" name="submit">
							Sign in
						</button>
					</form>
				</div><!--/.nav-collapse -->
			</div>
		</nav>


<div class="container" id="main-container">
	<h2>Contact Us</h2>
	<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" target="_self">
		<div class="form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" name="name" placeholder="Enter Name">
			<span class="error">* <?php echo $nameErr; ?></span>
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="email" class="form-control" name="email" placeholder="Email Address">
			<span class="error">* <?php echo $emailErr; ?></span>
		</div>

		<div>
			<textarea class="form-control" rows="5"  placeholder="Optional" name="subject"></textarea>
		</div>

		<div id="Captcha-div">
			<?php // Adding BotDetect Captcha to the page
			$SampleCaptcha = new Captcha("SampleCaptcha");
			$SampleCaptcha -> UserInputID = "CaptchaCode";
			echo $SampleCaptcha -> Html();
			?>
		</div>
		<div class="validationDiv">
			<label for="name">Enter the code below:</label>
        <input name="CaptchaCode" type="text" id="CaptchaCode" />
        <span class="error">* <?php echo $CaptchaCodeErr; ?></span>
      </div>
      <div id="button-div">
             <button type="submit" class="btn btn-primary" name="submit">
        	Submit
        	</button>
        	<span class="error"><?php echo $formErr; ?></span>
      </div>
	</form>
	<?php
	// echo "<h3>Output</h3>";
	// echo "<p>$name</p>";
	// echo "<p>$email</p>";
	// echo "<p>$subject</p>";
	// echo "<p>$CaptchaCode</p>";
?>
</div>
<?php ?>


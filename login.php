<?php
	include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapper">
			<h2 style="color:#FFFFFF">Welcome to Foxdrop</h2>
			<?php
				if (isset($_SESSION['u_id'])) {
					echo '<br><div style="text-align:center"><span style="color:green; font-size:25px">You are logged in!</span></div>';
				}
				else {
					echo '<br><div style="text-align:center"><span style="color:red; font-size:25px">Login failed.</span></div>';
				}
			?>
	</div>

<?php
	include_once 'footer.php';
?>

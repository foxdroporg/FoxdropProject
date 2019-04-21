<?php
	include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapper">
			<h2 style="color:#FFFFFF">Welcome to Foxdrop</h2>
			<?php
				if (isset($_SESSION['u_id'])) {
					echo '<span style="color:#FFFFFF;">You are logged in!</span>';
				}
			?>
	</div>

</section>



<?php
	include_once 'footer.php';
?>



<ul>
	<a href="/index.php" class="navlink"><li>Home</li></a>
	<li class="dropmenu">
		<p class="droptab">Products</p>
		<?php if(isset($navList)){echo $navList; } ?>
	</li>
	<a href="/index.php?action=charity" class="navlink"><li>Charity</li></a>
	<a href="/index.php?action=contact-us" class="navlink"><li>Contact Us</li></a>
</ul>

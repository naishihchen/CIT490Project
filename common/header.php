				<div id="header">
					<a href="/" id="logo-div"><img src="/images/site/logo.png" alt="site-logo" id="logo"></a>
					<?php if($_SESSION['loggedin'] == TRUE) {
					if(isset($_COOKIE['username'])){
 						echo "<a href=\"/accounts/index.php\" id=\"admin-link\"><span>Welcome $_COOKIE[username]</span></a>";
					} 
				}?>

					<div id="header-corner">
						<?php
							if ($_SESSION['loggedin'] == TRUE) {
								echo "<a href=\"/accounts/index.php?action=logout\" id=\"logout\">Log Out</a>";
    						} else {
        					echo "<a title=\"my-account\" href=\"/accounts/index.php?action=login\">Login/Register</a>";
							}
						?>
						<a href="/items/index.php?action=cart"><img src="/images/site/shopping-cart-icon.png" alt="cart" id="cart-img"></a>
					</div>
				</div>
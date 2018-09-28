<?php
/*
** public class
** creates footer
*
*/
class Footer {

	function __construct(){}
	
	/*
	** creates footer for pages that don't require log in
	*/
	function create_footer() {

		$footer = "<footer>
						<p>&#x263D; &#9765; MICHAELA OLAUSSON - 1ME324 &#9765; &#x263E;</p>
						<a href='log_in_page.php'>Logga In</a>
					</footer>";

		echo $footer;
	}
	/*
	** Footer for logged in users.
	*/
	function create_footer_out() {

		$footer_out = "<footer>
						<p>&#x263D; MICHAELA OLAUSSON - 1ME324 &#x263E;</p>
						<a href='src/php/log_out.php'>Logga Ut</a>
					</footer>";
		echo $footer_out;
	}
}
?>
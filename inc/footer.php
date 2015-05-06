		</div>
		<div class="footer" id="sources">
			<p>This site looks at a range of publicly available data on the current constituencies for the UK Parliament</p>
			<ul class="footer__list">
				<li class="footer__item">concept: <a href="http://twitter.com/cole007">@cole007</a></li>
				<?php
					foreach ($srcs AS $key => $value) {
						echo '<li class="footer__item"><a href="' . $value . '">' . $labels[$key] . '</a></li>';
					}
				?>				
			</ul> 
		</div>
	</div>
<script type="text/javascript" src="_assets/js/libs/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="_assets/js/libs/tablesaw.js"></script>
<script>
	var _gaq=[['_setAccount','UA-6525453-1'],['_trackPageview']]; // Change UA-XXXXX-X to be your site's ID
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>

</body>
</html>
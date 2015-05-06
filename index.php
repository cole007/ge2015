<?php

	include_once('inc/db.php');
	include_once('inc/header.php');

	$srcs = array(
		'meta'=>'http://visual.ons.gov.uk/visualising-your-constituency/',
		'demog'=>'http://www.ons.gov.uk/ons/rel/sape/parliament-constituency-pop-est/mid-2011--census-based-/index.html',
		'tenure'=>'http://www.constituencyexplorer.org.uk/explore/tenure',
		'geographic'=>'http://www.ordnancesurvey.co.uk/business-and-government/products/boundary-line.html',
		'votes'=>'http://www.constituencyexplorer.org.uk/explore/2010_election_results'
	);
	$labels = array(
		'meta'=>'Social data',
		'demog'=>'Demographic data',
		'tenure'=>'Housing and Tenancy data',
		'votes'=>'Voting data',
		'geographic'=>'Geographic data'
	);
	$data = array(
		'meta'=>array(
			'house'=>'Avg. House Price',
			'salary'=>'Avg. Salary',
			'publicsector'=>'Public Sector Employment',
			'degree'=>'% with Degree',
			'age'=>'Avg. Age',
			'nonukborn'=>'% Non UK-Born',
			'health'=>'% with Good Health',
		),
		'demog'=>array(
			'ages_all'=>'All',
			'males'=>'Males',
			'females'=>'Female',
			'mi'=>'area (m<sup>2</sup>)'
		),
		'tenure'=>array(
			'owned'=>'Owned %',
			'social'=>'Social rented %',
			'private'=>'Private rented %',
		),
		'votes'=>array(
			'electorate'=>'Electorate',
			'cast'=>'Votes Cast',
			'turnout'=>'Turnout %',
			'majority_share'=>'Majority share %',
			// 'con'=>'Con %',
			// 'lab'=>'Lab %',
			// 'lib'=>'Lib %',
			// 'other'=>'Other %',
		),
	);
	$party = array(
		'con'=>'Conservative',
		'lab'=>'Labour',
		'lib'=>'Liberal Democrat',
		'other'=>'Other',
	)
	?>

	<?php
		$q = "SELECT *
			FROM meta AS m
				JOIN population AS p ON m.PCON_id = p.PCON_id
				JOIN tenure AS t ON m.PCON_id = t.PCON_id
				JOIN votes AS v ON m.PCON_id = v.PCON_id 
				JOIN boundaries AS b ON m.PCON_id = b.PCON_id
				ORDER BY PCON_name ASC";
		
		echo '<table 
			id="table-001" 
			class="tablesaw tablesaw-swipe" 
			data-tablesaw-mode="swipe" 
			data-tablesaw-minimap 
			data-tablesaw-sortable
			data-tablesaw-columntoggle>';
		echo '<thead>';
		echo '<tr>';
		echo '<th data-tablesaw-sortable-col data-tablesaw-priority="persist">Name</th>';
		echo '<th data-tablesaw-sortable-col scope="col">Pop density</th>';
			foreach ($data AS $key => $value) {
				foreach ($value AS $index => $misc) {
					echo '<th data-tablesaw-sortable-col scope="col" >' . $misc . '</th>';
				}
			}
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		if ($result = $mysqli->query($q)) {
			// echo $result->num_rows;
			// echo ' results';
			while($row = $result->fetch_array()) {
				// echo $row['PCON_name'];
				// print_r($row);
				$votes['con'] = $row['con'];
				$votes['lab'] = $row['lab'];
				$votes['lib'] = $row['lib'];
				$votes['other'] = $row['other'];

				arsort($votes);
				reset($votes);
				$first_key = key($votes);				

				echo '<tr class="row row--'.$first_key.'" data-maj="'.$row['majority_share'].'" title="'.$party[$first_key].' Elected, ' . $row['majority_share']. '% majority">';
				echo '<td>' . $row['PCON_name'] . '</td>';
				echo '<td>' . number_format($row['ages_all'] / $row['mi']) . '/m<sup>2</sup></td>';
				echo '<!-- ' .$row['ages_all']. '  ' .$row['mi']. ' -->';
				foreach ($data AS $key => $value) {
					foreach ($value AS $index => $misc) {
						echo '<td>';
						if ($row[$index] > 1000) echo number_format($row[$index]);
						else echo $row[$index];
						echo '</td>';
					}
				}
				echo '</tr>';
			}
		} else {
			echo mysql_error();
			echo 'no!!!';
		}
		echo '</tbody>';
		echo '</table>';
			
	?>

<?php
	include_once('inc/footer.php');

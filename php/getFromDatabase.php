<?php
	/*------------------------------------------------*/
	/*If file is viewed on page itself uncomment below*/
	/*------------------------------------------------*/
	// $_POST['table'] = ['Temperatuur','Luchtdruk'];
	// $_POST['query'] = 'selectAll';
	/*------------------------------------------------*/
	/*------------------------------------------------*/

	require_once 'databaseConnection.php';
	$response = [];

	if(isset($_POST['table']) && !empty($_POST['table'])){
		$tableLength = count($_POST['table']);
		for ($i=0; $i < $tableLength; $i++){
			$table = $_POST['table'][$i];

			if(isset($_POST['query']) && !empty($_POST['query']) && $_POST['query'] == 'selectAll'){
				$response[$table] = [];
				$sql = 'SELECT * FROM `' . $table . '`';

				$rows = $pdo->query($sql);
				foreach ($rows as $row){
					/*SPLIT DATE AND TIME*/
					$splitDateFromTime = strpos($row['date'], ' ');
					$lengthDate = strlen($row['date']);
					$date = substr($row['date'], 0, $splitDateFromTime);
					$time = substr($row['date'], $splitDateFromTime, $lengthDate);

					$response[$table][] = ['id' => $row['id'],  'value' => $row['value'], 'date' => $date, 'time' => $time];
				}
			}
		}
	}
	echo json_encode($response);
?>
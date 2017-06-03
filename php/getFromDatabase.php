<?php
	/*------------------------------------------------*/
	/*If file is viewed on page itself uncomment below*/
	/*------------------------------------------------*/
	// $_POST['table'] = ['Temperature','Air-pressure'];
	// $_POST['query'] = 'selectAll';
	/*------------------------------------------------*/
	/*------------------------------------------------*/

	require_once 'databaseConnection.php';
	$response = [];

	//
	if(isset($_POST['table']) && !empty($_POST['table'])){
		$tableLength = count($_POST['table']);
		
		$sql = 'SELECT `date` FROM `collector`';
		$rows = $pdo->query($sql);

		/*GET ALL THE DATES*/
		foreach ($rows as $row){
			/*SPLIT DATE AND TIME*/
			$splitDateFromTime = strpos($row['date'], ' ');
			$lengthDate = strlen($row['date']);
			$date = substr($row['date'], 0, $splitDateFromTime);
			$time = substr($row['date'], $splitDateFromTime, $lengthDate);
			
			$response['Dates'][] = ['date' => $date, 'time' => $time];
		}

		/*MAKES AN ARRAY INTO A CALLEBLE SQL LIST*/
		for ($i=0; $i < $tableLength; $i++){
			$table = $_POST['table'][$i];
			try{
				if(isset($_POST['query']) && !empty($_POST['query']) && $_POST['query'] == 'selectAll'){
					$sql = 'SELECT `' . $table . '` FROM `collector` ';
					$rows = $pdo->query($sql);
					
					foreach ($rows as $row){
						$response[$table][] = ['value' => $row[$table]];
					}
				}else if(isset($_POST['query']) && !empty($_POST['query']) && $_POST['query'] == 'selectLast'){
					$sql = 'SELECT * FROM `collector` ORDER BY id DESC LIMIT 2';
					$rows = $pdo->query($sql);

					//Removing previouse inserted dates
					$response = [];
					foreach ($rows as $row) {
						$response[] = $row;
					}
				}
			}catch(Exception $e){
				$response[$table][] = ['error' => $e];
			}
		}
	}
	echo json_encode($response);
?>
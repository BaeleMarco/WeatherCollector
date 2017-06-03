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
				$sql = 'SELECT `' . $table . '` FROM `collector` ';
				$rows = $pdo->query($sql);
				
				foreach ($rows as $row){
					$response[$table][] = ['value' => $row[$table]];
				}
			}catch(Exception $e){
				$response[$table][] = ['error' => $e];
			}
		}
		// foreach ($value as $key => $data) {
		// 	if($key == $table){
		// 		echo $key . '=>' . $data . '</br>';
		// 		if(isset($_POST['query']) && !empty($_POST['query']) && $_POST['query'] == 'selectAll'){
		// 			$response[$table] = [];
		// 			try{
		// 				$sql = 'SELECT * FROM `' . $table . '` WHERE id = ' . $data;
		// 				$rows = $pdo->query($sql);
		// 				foreach ($rows as $row){
		// 					$response[$table][] = ['value' => $data['value']];
		// 				}
		// 			}catch(Exception $e){
		// 				$response[$table][] = ['error' => $e];
		// 			}
		// 		}
		// 		// }else if(isset($_POST['query']) && !empty($_POST['query']) && $_POST['query'] == 'selectLast'){
		// 			// SELECT * FROM Table ORDER BY ID DESC LIMIT 1
		// 			// SELECT TOP 1 * FROM Table ORDER BY ID DESC
		// 		// }
		// 	}
	}
	echo json_encode($response);
?>
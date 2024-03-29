<?php 
class ExamDAO{
	public static function getQuestion($q_number){
		global $db;

		$sql = "SELECT id,test_question,choice_A,choice_B,choice_C,choice_D,answer FROM test_question WHERE id ='{$q_number}'";
		$result = $db->query($sql);
		$question = $result->fetch_assoc();
		return $question;
	}

	public function getUser($email, $pass){
		global $db;
		try{
			$sql ="SELECT first_name, last_name, email, password FROM registration WHERE email = '{$email}' AND password = '{$pass}'";
			$result = $db->query($sql);
			if ($result->num_rows > 0){
				$insert = $result->fetch_assoc();
				$result->free();
				return $insert;
			}else{
				return false;
			}
		}catch(Exception $e) {
			error_log('Error Occur!');
			return false;
		}
	}

	public static function createUser($first_name, $last_name, $email, $password){
		global $db;
		if (!$email) return false;
		if (!$password) return false;
		try {
			$sql = "INSERT INTO registration (first_name, last_name, email, password) VALUES('$first_name', '$last_name', '$email', '$password')";
			$result = $db->query($sql);
			return $result;
		} catch (Exception $e) {
			error_log($e->getMessage());
			error_log('An Error Occur!');
			return false;
		}
		
	}

	public static function getCorrectAnswers(){
		global $db;
		try{
			$sql = "SELECT answer FROM test_question ORDER BY id";
			$result = $db->query($sql);
			$answer = array();
			while ($rows = $result->fetch_assoc()) {
				$answer[] = $rows['answer'];
			}	
			return $answer;
		}catch(Exception $e){
			error_log($e->getMessage());
			return false;
		}
	}

	 public static function checkAnswer($answers) {
	 	$correct = self::getCorrectAnswers();
	 	//$correct = array('','','','','', .....);
	 	if ($correct === false) {
	 		error_log('Correct Answers not ready!');
	 		return false;
	 	}
	 	if (count($correct) != strlen($answers)){
	 		error_log('Invalid Answer!');
	 		return false;
	 	}
	 	if ($answers === false) {
	 		error_log('Correct Answers not ready!');
	 		return false;
	 	}
	 	if ($correct == null || $answers == "") {
	 		error_log('Correct Answers not ready!');
	 		return false;
	 	}
	 	$total_correct = 0;
	 	for ($i = 0; $i < 10; $i++) {
	 		if ($correct[$i] == $answers[$i]) {
	 			$total_correct++; 
	 		} 
	 	}
	 	return $total_correct;
	 }

	 public static function getAll() {
	 	global $db;
 
	 	try {
	 		$sql = "SELECT id FROM test_question ORDER BY id";
	 		$result = $db->query($sql);
	 		$getId = '';
	 		if($result->num_rows > 0){
	 			while ($rows = $result->fetch_assoc()) {
	 				$getId .= $rows['id'];
	 			}
	 			return $getId;
	 		} else {
	 			return false;
	 		}
	 		
	 	} catch (Exception $e) {
	 		error_log('An Error Occur!');
	 		return false;
	 	}
	 	
	 }
}
 ?>
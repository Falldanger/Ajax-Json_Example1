<?php
$mysqli = new Mysqli('localhost', 'root', '', 'mybase');
/* Записуємо отримані з форми дані */
$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$age = intval($_POST['age']);


if($name && $surname && $age){
	//Вставляємо запис в БД
	$query = $mysqli->query("INSERT INTO `users` VALUES(NULL, '$name', '$surname', '$age')");
	
	
	
	//Отримуємо всі записи з таблиці
	$query2 = $mysqli->query("SELECT * FROM `users` ORDER BY `id` DESC");

	while($row = $query2->fetch_assoc()){
		$users['id'][] = $row['id'];
		$users['name'][] = $row['name'];
		$users['surname'][] = $row['surname'];
		$users['age'][] = $row['age'];
	}
	$message = 'Correct data';
}else{
	$message = 'Something went wrong';
}


/* Повертаємо відповіть скрипту */

// Формуємо масив даних для відправки
$out = array(
	'message' => $message,
	'users' => $users
);

// Встановлюємо заголовок в форматі json
header('Content-Type: text/json; charset=utf-8');

// Кодуємо дані в форматі json і відправляємо
echo json_encode($out);
?>
<?php
	require_once("library/CAS/connection.php");
	require_once("library/helperFunctions.php");

	// Logout
	if (isset($_REQUEST['logout'])) {
		phpCAS::logout();
		header("Location: /"); /* Redirect browser */
		exit();
	}
	$stmt = $old_db->prepare("SELECT * FROM eb_posts WHERE post_title = :test");
	$stmt->execute([
		"test" => "CIVE 353 - Quiz - Unknown - S'01 - Civil"
	]);
	$test_exam = $stmt->fetch();
?>
<html lang="en">
<head>
	<title>Exam Bank</title>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	Hello <?php echo $QuestName ?>!
	<?php echo TestClass::TEST_CONSTANT ?>
	<?php echo $test_exam["post_name"] ?>
	<a href="?logout=">LOGOUT</a>
</body>
</html>

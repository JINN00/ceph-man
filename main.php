<?php
include_once('./config.php');
require_once "./func.php";

	if($argc == 1) { echo "input any option\n"; exit(0); }

	if($argc != 1) { $s3con = connectS3(); }

	if($argv[1] === "list-bucket") { listbucket($s3con); }

	if($argv[1] === "create-bucket"){ 
		if( empty($argv[2]) ) { echo "input bucket name to create\n"; exit(0); }
		if( strlen($argv[2]) <= 4 ) { echo "please input at least 5 characters\n"; exit(0); }

		createbucket($s3con, $argv[2]); 
	}

	if($argv[1] === "delete-bucket"){
		if( empty($argv[2]) ) { echo "input bucket name to delete-bucket\n"; exit(0); }

                deletebucket($s3con, $argv[2]);

	}

	if($argv[1] === "list-object"){
		if( empty($argv[2]) ) { echo "input bucket name to query object\n"; exit(0); }
		
		listobject($s3con, $argv[2]);	
	}
	
	if($argv[1] === "help" || $argv[1] === "-h") { 
		echo "main.php help\n\n";
		echo "main.php list-bucket                \t\tprint bucket list for configured user\n";
		echo "main.php create-bucket bucket-name  \t\tcreate bucket for configured user\n";
		echo "                                    \t\tbucket name and rgw server's record must be match\n";
		echo "main.php delete-bucket              \t\tdelete bucket for configured user\n";
		
	}
?>

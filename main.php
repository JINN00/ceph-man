<?php
include_once('./config.php');
require_once "./func.php";

	if($argc == 1) { echo "input any option\n"; exit(0); }

	if($argc != 1) { 
                if( preg_match("/create-bucket|delete-bucket|list-bucket|list-object|create-object|delete-object|get-object|-h|help/",$argv[1]) == false ) {
			echo "Unkown options!\n";
                        exec('php ./main.php help',$output,$error);
			foreach($output as $i) { echo $i."\n"; }
			exit(0);
                }
		else { $s3con = connectS3(); }
	}

	if($argv[1] === "list-bucket") { listbucket($s3con); }

	if($argv[1] === "create-bucket"){ 
		if( empty($argv[2]) ) { echo "input bucket name to create\n"; exit(0); }
		if( strlen($argv[2]) <= 4 ) { echo "please input at least 5 characters\n"; exit(0); }

		createbucket($s3con, $argv[2]); 
		listbucket($s3con);
	}

	if($argv[1] === "delete-bucket"){
		if( empty($argv[2]) ) { echo "input bucket name to delete-bucket\n"; exit(0); }

                deletebucket($s3con, $argv[2]);
		listbucket($s3con);
	}

	if($argv[1] === "list-object"){
		if( empty($argv[2]) ) { echo "input bucket name to query object\n"; exit(0); }
		
		listobject($s3con, $argv[2]);	
	}

	if($argv[1] === "create-object"){
		if( empty($argv[2]) || empty($argv[3] )) { 
			echo "input bucket name and file name to create object\n"; exit(0); 
		}

		createobject($s3con, $argv[2], $argv[3]);
		listobject($s3con, $argv[2]);
	}

	if($argv[1] === "delete-object"){
		if( empty($argv[2]) || empty($argv[3] )) { 
			echo "input bucket name and file name to delete object\n"; exit(0); 
		}

		deleteobject($s3con, $argv[2], $argv[3]);
		listobject($s3con, $argv[2]);
	}
	
        if($argv[1] === "get-object"){
                if( empty($argv[2]) || empty($argv[3])) {
                        echo "input bucket name, file name\n"; exit(0);
                }
		error_reporting(0);
                getobject($s3con, $argv[2], $argv[3], $argv[4]);
       }


	if($argv[1] === "help" || $argv[1] === "-h") { 
		echo "main.php help\n";
		echo "bucket name and rgw server's DNS record must be match\n\n";
		echo "main.php list-bucket                                  \t\tprint bucket list\n";
		echo "main.php create-bucket bucket-name                    \t\tcreate bucket\n";
		echo "main.php delete-bucket bucket-name                    \t\tdelete bucket\n";
		echo "main.php list-object bucket-name                      \t\tprint object in bucket\n";
		echo "main.php create-object bucket-name file_path          \t\tcreate object in bucket\n";
		echo "main.php delete-object bucket-name file_path          \t\tdelete object in bucket\n";
		echo "main.php get-object bucket-name file_name             \t\tdownload file in bucket to working directory\n";
		echo "main.php get-object bucket-name file_name dest_dir    \t\tdownload file in bucket to destination directory\n";
		
	}
?>

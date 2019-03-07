<?php
require_once "./config.php";
require_once "./vendor/autoload.php";
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

function connectS3(){
	$s3Client = S3Client::factory(array(
		'base_url' => HOST,
		'port' => PORT,
		'key'      => AWS_KEY,
		'secret'   => AWS_SECRET_KEY
	));
	return $s3Client;
}

function listbucket($s3Client){
	$buckets = $s3Client->listBuckets();
	try {
	
		echo $buckets['Owner']['ID']."\t";
		echo $buckets['Owner']['DisplayName']."\n";
		foreach ($buckets['Buckets'] as $bucket){
			echo "{$bucket['Name']}\t${bucket['CreationDate']}.\n";
		}		

	} catch (S3Exception $e) {
		echo $e->getMessage();
		echo "\n";
	}
}

function createbucket($s3Client, $bucket_name){
	try {
		$s3Client->createBucket(array(
			'Bucket' => $bucket_name,
		));
		echo $bucket_name.' Bucket created.'."\n";     
	} catch (S3Exception $e) {
		echo $e->getMessage();
		echo "\n";
	}
}

function deletebucket($s3Client, $bucket_name){
	$s3Client->deleteBucket(array('Bucket' => $bucket_name));
}

function listobject($s3Client, $bucket_name){
	$o_iter = $s3Client->getIterator('ListObjects', array(
		'Bucket' => $bucket_name
	));
	foreach ($o_iter as $o) {
		echo "{$o['Key']}\t{$o['Size']}\t{$o['LastModified']}\n";
	}
}

?>

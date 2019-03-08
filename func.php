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
	
		echo "ID: ".$buckets['Owner']['ID']."\t";
		echo "DisplayName: ".$buckets['Owner']['DisplayName']."\n";
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
	echo $bucket_name.' Bucket deleted'."\n";

}

function listobject($s3Client, $bucket_name){
	$o_iter = $s3Client->getIterator('ListObjects', array(
		'Bucket' => $bucket_name
	));
	foreach ($o_iter as $o) {
		echo "{$o['Key']}\t{$o['Size']}\t{$o['LastModified']}\n";
	}
}

function createobject($s3Client, $bucket_name, $file_path){
	$key = basename($file_path);
	try{
		$result = $s3Client->putObject([
		'Bucket'     => $bucket_name,
		'Key'        => $key,
		'SourceFile' => $file_path,
		'ACL'        => 'private',
		]);
	        echo $key.' object created'."\n";
	} catch (S3Exception $e) {
		echo $e->getMessage() . "\n";
	}
}


function deleteobject($s3Client, $bucket_name, $file_path){
        $key = basename($file_path);
        try{
		$s3Client->deleteObject(array(
			'Bucket' => $bucket_name,
			'Key'    => $key,
		));
	        echo $key.' object deleted'."\n";
        } catch (S3Exception $e) {
                echo $e->getMessage() . "\n";
        }
}

?>

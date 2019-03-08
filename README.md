# ceph-man

Simple Ceph Object Gateway Management tool via php cli and aws s3 <br>
<pre>
main.php help
bucket name and rgw server's DNS record must be match

main.php list-bucket                                            print bucket list
main.php create-bucket bucket-name                              create bucket
main.php delete-bucket bucket-name                              delete bucket
main.php list-object bucket-name                                print object in bucket
main.php create-object bucket-name file_path                    create object in bucket
main.php delete-object bucket-name file_path                    delete object in bucket
main.php get-object bucket-name file_name                       download file in bucket to working directory
main.php get-object bucket-name file_name dest_dir              download file in bucket to destination directory
</pre>

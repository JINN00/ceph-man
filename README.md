# ceph-man

Simple Ceph Object Gateway Management tool via php cli and aws s3 <br>
<pre>
main.php list-bucket                                    print bucket list for configured user
main.php create-bucket bucket-name                      create bucket for configured user
                                                        bucket name and rgw server's record must be match
main.php delete-bucket bucket-name                      delete bucket for configured user
main.php list-object bucket-name                        print object in bucket for configured user
main.php create-object bucket-name file_path            create object in bucket for configured user
main.php delete-object bucket-name file_path            delete object in bucket for configured user
</pre>

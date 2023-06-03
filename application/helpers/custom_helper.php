<?php

require 'vendor/autoload.php';
use S3\S3Client;

function uploadToS3($file_Path, $image_path, $upload_path) {
    $path = explode('/', trim($upload_path,'/'));
    if (count($path) > 1) {
        $image_path = end($path).'/'.$image_path;
    }
    $bucket = "zanomy";
    $data = array();
    $data['message'] = "false";
    try {
        $s3Client = new Aws\S3\S3Client([
            'version' => 'latest',
            'region' => 'us-east-2',
            'credentials' => [
                'key' => 'AKIAXFI6DT4UHTM7Y45T',
                'secret' => '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',
            ],
        ]);
        $result = $s3Client->putObject([
            'Bucket' => $bucket,
            'Key' => $image_path,
            'SourceFile' => $file_Path,
            //'body'=> $file_Path,
            'ACL' => 'public-read',
                //'StorageClass' => 'REDUCED_REDUNDANCY',
        ]);
        // print_r($result['ObjectURL']);
        // die;
        $data['message'] = "sucess";
        $data['imagename'] = $image_path;
        $data['imagepath'] = $result['ObjectURL'];
    } catch (Exception $e) {
        $data['message'] = "false";
        // echo $e->getMessage() . "\n";
    }
    return $data;
}

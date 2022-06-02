<?php

namespace Tringuyen\CarForRent\Service;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Dotenv\Dotenv;
use Tringuyen\CarForRent\Bootstrap\Application;
use Tringuyen\CarForRent\Exception\UploadFileException;

class FileUploadService
{
    private static Dotenv $dotenv;
    /**
     * @param $file
     * @return mixed|null
     * @throws UploadFileException
     */
    public function uploadImage($file): ?string
    {
        static::$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        static::$dotenv->load();
        $bucketName = $_ENV['S3_BUCKET_NAME'];
        $bucketRegion = $_ENV['S3_BUCKET_REGION'];

        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => $bucketRegion,
            'credentials' => ['key' => $_ENV['S3_KEY_ID'], 'secret' => $_ENV['S3_KEY_SECRET']]
        ]);
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            throw new UploadFileException('Invalid request method');
        }
        $path = Application::$ROOT_DIR . "/public/assets/car_img/";
        $filename = md5(date('Y-m-d H:i:s:u')) . $file["name"];
        if (move_uploaded_file($file["tmp_name"], $path . $filename)) {
            $file_Path = $path . $filename;
            $key = basename($file_Path);
            try {
                $result = $s3Client->putObject([
                    'Bucket' => $bucketName,
                    'Key' => $key,
                    'SourceFile' => $file_Path,
                ]);
                unlink($path . $filename);
                return $result->get('ObjectURL');
            } catch (S3Exception $e) {
                return null;
            }
        } else {
            throw new UploadFileException("Error: There was an error uploading your file.");
        }
    }
}

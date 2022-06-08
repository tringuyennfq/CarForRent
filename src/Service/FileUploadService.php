<?php

namespace Tringuyen\CarForRent\Service;

use Aws\Result;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Dotenv\Dotenv;
use Tringuyen\CarForRent\Bootstrap\Application;

class FileUploadService
{
    private static Dotenv $dotenv;


    private function getENV(): array
    {
        static::$dotenv = Dotenv::createImmutable(__DIR__.'/../');
        static::$dotenv->load();
        return [
            'bucketName' => $_ENV['S3_BUCKET_NAME'],
            'bucketRegion' => $_ENV['S3_BUCKET_REGION'],
            'key' => $_ENV['S3_KEY_ID'],
            'secret' => $_ENV['S3_KEY_SECRET']
        ];
    }

    public function getS3Client(array $env): S3Client
    {
        return new S3Client([
            'version' => 'latest',
            'region' => $env['bucketRegion'],
            'credentials' => ['key' => $env['key'], 'secret' => $env['secret']]
        ]);
    }
    /**
     * @param $file
     * @return ?string
     */
    public function uploadImage($file): ?string
    {
        $env = $this->getENV();
        $s3Client = $this->getS3Client($env);
        $filePath = $this->getFilePath($file['name']);
        if (move_uploaded_file($file["tmp_name"], $filePath)) {
            $filePut = $this->putFileS3($s3Client, $env['bucketName'], basename($filePath), $filePath);
            unlink($filePath);
            return $filePut->get('ObjectURL');
        }
        return null;
    }

    public function getFilePath(string $fileName): string
    {
        return Application::$ROOT_DIR . "/public/assets/car_img/" . md5(date('Y-m-d H:i:s:u')) . $fileName;
    }

    public function putFileS3(S3Client $s3Client, string $bucketName,string $key, string $filePath): ?Result
    {
        try {
            $result = $s3Client->putObject([
                'Bucket' => $bucketName,
                'Key' => $key,
                'SourceFile' => $filePath,
            ]);
            return $result;
        } catch (S3Exception $e) {
            return null;
        }
    }
}

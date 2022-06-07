<?php

namespace Tringuyen\CarForRent\Validator;

use Tringuyen\CarForRent\Bootstrap\Application;
use Tringuyen\CarForRent\Exception\UploadFileException;
use Tringuyen\CarForRent\Model\AddCarRequest;

class AddCarValidator
{
    public function validateCarAdd(AddCarRequest $addCarRequest)
    {
        $val = new Validator();
        $val->name('name')->value($addCarRequest->getName())->required()->max(250);
        $val->name('brand')->value($addCarRequest->getBrand())->required()->max(150);
        $val->name('price')->value($addCarRequest->getPrice())->required()->is_numeric();
        $val->name('color')->value($addCarRequest->getColor())->required()->max(100);
        $val->name('description')->value($addCarRequest->getDescription())->required()->max(500);
        if ($val->isSuccess()) {
            return true;
        }
        return $val->getErrors();
    }

    public function validateImageUpload($file, int $maxfilesizeMB)
    {
        if (!isset($file) || $file["error"] != 0) {
            throw new UploadFileException('File upload does not exist');
        }
        $allowed = array(
            "jpg" => "image/jpg",
            "jpeg" => "image/jpeg",
            "gif" => "image/gif",
            "png" => "image/png"
        );
        $path = Application::$ROOT_DIR . "/public/assets/car_img/";
        $filename = md5(date('Y-m-d H:i:s:u')) . $file["name"];
        $filetype = $file["type"];
        $filesize = $file["size"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) {
            throw new UploadFileException("Error: Please select a valid file format.");
        }
        $maxsize = $maxfilesizeMB * 1024 * 1024;
        if ($filesize > $maxsize) {
            throw new UploadFileException("Error: File size is larger than the allowed limit.");
        }
        // Validate type of the file
        if (!in_array($filetype, $allowed)) {
            throw new UploadFileException("Error: Please select a valid file format.");
        }
        return true;
    }
}

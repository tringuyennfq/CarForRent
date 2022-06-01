<?php

namespace Tringuyen\CarForRent\Controller;

use Exception;
use Tringuyen\CarForRent\Bootstrap\View;
use Tringuyen\CarForRent\Exception\UploadFileException;
use Tringuyen\CarForRent\Model\AddCarRequest;
use Tringuyen\CarForRent\Model\AddCarResponse;
use Tringuyen\CarForRent\Service\CarService;
use Tringuyen\CarForRent\Service\FileUploadService;
use Tringuyen\CarForRent\Validator\AddCarValidator;

class AddCarController
{
    private CarService $carService;
    private AddCarRequest $carRequest;
    private AddCarResponse $carResponse;
    private AddCarValidator $carValidator;
    private FileUploadService $fileUploadService;
    public function __construct(CarService $carService, AddCarRequest $carRequest, AddCarResponse $carResponse, AddCarValidator $carValidator, FileUploadService $fileUploadService)
    {
        $this->carService = $carService;
        $this->carRequest = $carRequest;
        $this->carResponse = $carResponse;
        $this->carValidator = $carValidator;
        $this->fileUploadService = $fileUploadService;
    }

    public function addCar()
    {
        try{
            $errors =[];
            $success = false;
            if($this->carRequest->getMethod() === 'POST'){
                $requestBody = $this->carRequest->getBody();
                $this->carRequest->fromArray($requestBody);
                $this->carValidator->validateImageUpload($_FILES['image'],2);
                $validate = $this->carValidator->validateCarAdd($this->carRequest);
                if($validate === true){
                    $uploadImage = $this->fileUploadService->uploadImage($_FILES['image']);
                    $this->carResponse->fromArray([...$requestBody,'image' => $uploadImage]);
                    $this->carService->save($this->carResponse);
                    $success = true;
                }
                $errors = $validate;
            }
        }catch (UploadFileException $exception){
            $errors['image'] = $exception->getMessage();
        }catch (Exception $exception){
            $errors['exception'] = $exception->getMessage();
        }
        return View::renderView('addCar',[
            'title' => 'AddCar',
            'error' => $errors,
            'success' => $success
        ]);

    }
}
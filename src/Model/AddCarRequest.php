<?php

namespace Tringuyen\CarForRent\Model;

use Tringuyen\CarForRent\Http\Request;

class AddCarRequest extends Request
{
    private string $name;
    private string $brand;
    private int|string $price;
    private string $color;
    private string $description;

    public function fromArray(array $body)
    {
        $this->setName($body['name']);
        $this->setBrand($body['brand']);
        $this->setPrice($body['price']);
        $this->setColor($body['color']);
        $this->setDescription($body['description']);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }


    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(int|string $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
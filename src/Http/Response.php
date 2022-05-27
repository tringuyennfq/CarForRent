<?php

namespace Tringuyen\CarForRent\Http;

class Response
{
    const HTTP_OK = 200;
    const HTTP_NOT_FOUND = 404;
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_BAD_REQUEST = 400;

    protected int $statusCode;
    protected ?array $data = null;

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param array|null $data
     */
    public function setData(?array $data): void
    {
        $this->data = $data;
    }
    public function toJson(array $data, int $statusCode = self::HTTP_OK)
    {
        $this->setStatusCode($statusCode);
        http_response_code($statusCode);
        $this->setData([...$data]);
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($this->getData());
    }

}

<?php


namespace App\Util;


class ExceptionMessage implements \JsonSerializable
{
    private array $errors;
    private string $message;

    /**
     * ExceptionMessage constructor.
     * @param array $errors
     * @param string $message
     */
    public function __construct(array $errors, string $message)
    {
        $this->errors = $errors;
        $this->message = $message;
    }

    public function jsonSerialize()
    {
        return [
            "errors" => $this->errors,
            "message" => $this->message
        ];
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }


}

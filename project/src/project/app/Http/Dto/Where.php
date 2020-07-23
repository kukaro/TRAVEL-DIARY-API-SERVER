<?php


namespace App\Http\Dto;


class Where
{
    private string $column;
    private string $op;
    private string $value;

    public function __construct(string $column, string $op, string $value)
    {
        $this->column = $column;
        $this->op = $op;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * @param string $column
     */
    public function setColumn(string $column): void
    {
        $this->column = $column;
    }

    /**
     * @return string
     */
    public function getOp(): string
    {
        return $this->op;
    }

    /**
     * @param string $op
     */
    public function setOp(string $op): void
    {
        $this->op = $op;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}

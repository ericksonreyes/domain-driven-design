<?php

namespace EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

class Measurement
{
    /**
     * @var UnitOfMeasurement
     */
    private $unitOfMeasurement;

    /**
     * @var int
     */
    private $value;

    /**
     * Measurement constructor.
     * @param int $value
     * @param UnitOfMeasurement $unitOfMeasurement
     */
    public function __construct(int $value, UnitOfMeasurement $unitOfMeasurement)
    {
        $this->value = $value;
        $this->unitOfMeasurement = $unitOfMeasurement;
    }

    /**
     * @return UnitOfMeasurement
     */
    public function unitOfMeasurement(): UnitOfMeasurement
    {
        return $this->unitOfMeasurement;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return Measurement
     */
    public function incrementBy(int $value): Measurement
    {
        $newValue = $this->value() + $value;
        return new self($newValue, $this->unitOfMeasurement());
    }

    /**
     * @param int $value
     * @return Measurement
     */
    public function decrementBy(int $value): Measurement
    {
        $newValue = $this->value() - $value;
        return new self($newValue, $this->unitOfMeasurement());
    }

    /**
     * @param int $number
     * @return Measurement
     */
    public function multiplyBy(int $number): Measurement
    {
        $newValue = $this->value() * $number;
        return new self($newValue, $this->unitOfMeasurement());
    }

    /**
     * @param int $number
     * @return Measurement
     */
    public function divideBy(int $number): Measurement
    {
        $newValue = $this->value() / $number;
        return new self($newValue, $this->unitOfMeasurement());
    }

    public function multiplyAndConvertTo($number, UnitOfMeasurement $newUnitOfMeasurement): Measurement
    {
        $newValue = $this->value() * $number;
        return new self($newValue, $newUnitOfMeasurement);
    }

    public function divideAndConvertTo($number, UnitOfMeasurement $newUnitOfMeasurement): Measurement
    {
        $newValue = $this->value() / $number;
        return new self($newValue, $newUnitOfMeasurement);
    }
}

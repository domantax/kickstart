<?php


namespace App\Services;


class AgeCalculator
{
    private $birthDate;
    private $currentDate;
    private $age;

    /**
     * AgeCalculator constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->currentDate = new \DateTime();
    }

    /**
     * @return \DateInterval
     */
    public function calculateAge (): \DateInterval
    {
        $age = $this->currentDate->diff($this->birthDate);
        $this->age = $age;

        return $age;
    }

    /**
     * @param string $birthDate
     *
     * @return \App\Services\AgeCalculator
     * @throws \Exception
     */
    public function setBirthDate(string $birthDate): AgeCalculator
    {
        $this->birthDate = new \DateTime($birthDate);

        return $this;
    }
}
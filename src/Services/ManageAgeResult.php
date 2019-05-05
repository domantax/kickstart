<?php


namespace App\Services;


class ManageAgeResult
{
    private $ageCalculator;
    private $adultAge;

    /**
     * ManageAgeResult constructor.
     *
     * @param \App\Services\AgeCalculator $ageCalculator
     *
     * @throws \Exception
     */
    public function __construct(AgeCalculator $ageCalculator)
    {
        $this->ageCalculator = $ageCalculator;
        $this->adultAge = new \DateInterval('P18Y');
    }

    /**
     * @param string $birthDate
     *
     * @return bool
     * @throws \Exception
     */
    public function checkIfAdult (string $birthDate): bool
    {
        $age = $this->ageCalculator->setBirthDate($birthDate)->calculateAge();

        return ($this->adultAge->y <= $age->y);
    }

    /**
     * @return string
     */
    public function formatAdultResponse ():string
    {
        return 'Am I an Adult? ---- YES!!';
    }

    /**
     * @return string
     */
    public function formatNotAdultResponse ():string
    {
        return 'Am I an adult? ---- NO!!';
    }

    /**
     * @param string $birthDate
     *
     * @return string
     * @throws \Exception
     */
    public function formatYearsOldResponse (string $birthDate): string
    {
        $age = $this->ageCalculator->setBirthDate($birthDate)->calculateAge();

        return 'I am ' . $age->format('%y years') . ' old';
    }
}
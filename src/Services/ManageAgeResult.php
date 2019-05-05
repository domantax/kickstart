<?php


namespace App\Services;


class ManageAgeResult
{
    private $ageCalculator;
    private $adultAge;

    public function __construct(AgeCalculator $ageCalculator)
    {
        $this->ageCalculator = $ageCalculator;
        $this->adultAge = new \DateInterval('P18Y');
    }

    public function checkIfAdult (string $birthDate): bool
    {
        $age = $this->ageCalculator->setBirthDate($birthDate)->calculateAge();
        return ($this->adultAge->y <= $age->y);
    }

    public function formatAmIAdultResponse (string $birthDate) {
        if($this->checkIfAdult($birthDate)) {
            $formattedResponse = 'Am I an Adult? ---- YES!!';
        }
        else
        {
            $formattedResponse = 'Am I an Adult? ---- NO!!';
        }
        return $formattedResponse;
    }

    public function formatYearsOldResponse (string $birthDate) {
        $age = $this->ageCalculator->setBirthDate($birthDate)->calculateAge();
        return 'I am ' . $age->format('%y years') . ' old';
    }
}
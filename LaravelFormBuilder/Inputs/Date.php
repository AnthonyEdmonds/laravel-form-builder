<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Inputs;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Input;
use Carbon\Carbon;

class Date extends Input
{
    public string $autocompleteDay;

    public string $autocompleteMonth;

    public string $autocompleteYear;

    public string $dayId;
    
    public string $dayName;
    
    public ?int $dayValue;
    
    public string $monthId;
    
    public string $monthName;
    
    public ?int $monthValue;
    
    public string $yearId;
    
    public string $yearName;
    
    public ?int $yearValue;
    
    public function __construct(
        string $label, 
        string $name, 
        string $autocomplete = 'on', 
        ?string $hint = null, 
        ?string $id = null, 
        mixed $value = null,
        public bool $noDay = false,
        public bool $noMonth = false,
        public bool $noYear = false,
    ) {
        parent::__construct($label, $name, $autocomplete, $hint, $id, 'date', $value);

        $this->dayId = "$this->id-day";
        $this->monthId = "$this->id-month";
        $this->yearId = "$this->id-year";
        
        $this->dayName = "$this->name-day";
        $this->monthName = "$this->name-month";
        $this->yearName = "$this->name-year";

        $this->dayValue = $this->setDateValue($this->dayName, 'day');
        $this->monthValue = $this->setDateValue($this->monthName, 'month');
        $this->yearValue = $this->setDateValue($this->yearName, 'year');

        $this->autocompleteDay = $this->setAutocompleteDay();
        $this->autocompleteMonth = $this->setAutocompleteMonth();
        $this->autocompleteYear = $this->setAutocompleteYear();
        
        $this->noDay = $this->setNoDay();
    }
    
    public function setAutocompleteDay(): string
    {
        return match ($this->autocomplete) {
            'bday', 'bday-day', 'bday-month', 'bday-year' => 'bday-day',
            'cc-exp', 'cc-exp-month', 'cc-exp-year' => '',
            default => $this->autocomplete,
        };
    }

    public function setAutocompleteMonth(): string
    {
        return match ($this->autocomplete) {
            'bday', 'bday-day', 'bday-month', 'bday-year' => 'bday-month',
            'cc-exp', 'cc-exp-month', 'cc-exp-year' => 'cc-exp-month',
            default => $this->autocomplete,
        };
    }

    public function setAutocompleteYear(): string
    {
        return match ($this->autocomplete) {
            'bday', 'bday-day', 'bday-month', 'bday-year' => 'bday-year',
            'cc-exp', 'cc-exp-month', 'cc-exp-year' => 'cc-exp-year',
            default => $this->autocomplete,
        };
    }
    
    public function setNoDay(): bool
    {
        return match ($this->autocomplete) {
            'cc-exp', 'cc-exp-month', 'cc-exp-year' => true,
            default => $this->noDay,
        };
    }
    
    public function setDateValue(string $name, string $key): ?int
    {
        $value = is_a($this->value, Carbon::class) === true
            ? $this->value->$key
            : $this->value[$key] ?? null;
        
        return old($name, $value);
    }
}

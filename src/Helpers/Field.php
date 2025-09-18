<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Helpers;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use Illuminate\Support\Collection;

// TODO Renderable component
class Field
{
    public string $accept = '*';

    public string $hint = '';

    public string $id;

    public string $max = '';

    public string $min = '';

    public bool $optional = false;

    public array $options = [];

    public string $step = '';

    public InputType $type = InputType::Text;

    public int|string|float|null $value = null;

    // Setup
    /**
     * @param string $name Should correspond to a Model attribute, unless configured otherwise on the Question
     * @param string $label Should be phrased as a question, such as "What is your name?"
     */
    final public function __construct(
        public string $name,
        public string $label,
    ) {
        $this->id = $name;
    }

    public static function make(string $name, string $label): static
    {
        return new static($name, $label);
    }

    // Setters
    public function optional(): static
    {
        return $this->setOptional(true);
    }

    public function required(): static
    {
        return $this->setOptional(false);
    }

    public function setAccept(string $accept): static
    {
        $this->accept = $accept;
        return $this;
    }

    public function setHint(string $hint): static
    {
        $this->hint = $hint;
        return $this;
    }

    public function setId(string $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function setMax(string|int|float $max) :static
    {
        $this->max = (string) $max;
        return $this;
    }

    public function setMin(string|int|float $min) :static
    {
        $this->min = (string) $min;
        return $this;
    }

    public function setOptional(bool $optional): static
    {
        $this->optional = $optional;
        return $this;
    }

    public function setOptions(array|Collection $options): static
    {
        $this->options = is_a($options, Collection::class) === true
            ? $options->toArray()
            : $options;

        return $this;
    }

    public function setStep(string|int|float $step) :static
    {
        $this->step = (string) $step;
        return $this;
    }

    public function setType(InputType $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function setValue(int|string|float|null $value): static
    {
        $this->value = $value;
        return $this;
    }

    // Common field types
    public static function checkboxes(
        string $name,
        string $label,
        array|Collection $options,
    ): static {
        return static::make($name, $label)
            ->setOptions($options)
            ->setType(InputType::Checkbox);
    }

    public static function file(
        string $name,
        string $label,
        string $accept = '*',
    ): static {
        return static::make($name, $label)
            ->setAccept($accept)
            ->setType(InputType::File);
    }

    public static function hidden(
        string $name,
        ?string $value,
    ): static {
        return static::make($name, '') // TODO Hide from task / summary list
            ->setType(InputType::Hidden)
            ->setValue($value);
    }

    public static function input(
        string $name,
        string $label,
        InputType $type,
    ): static {
        return static::make($name, $label)
            ->setType($type);
    }

    public static function password(
        string $name,
        string $label,
    ): static {
        return static::make($name, $label)
            ->setType(InputType::Password);
    }

    public static function radios(
        string $name,
        string $label,
        array|Collection $options,
    ): static {
        return static::make($name, $label)
            ->setOptions($options)
            ->setType(InputType::Radio);
    }

    public static function range(
        string $name,
        string $label,
        string|int|float $min = '',
        string|int|float $max = '',
        string|int|float $step = '',
    ): static {
        return static::make($name, $label)
            ->setMin($min)
            ->setMax($max)
            ->setStep($step)
            ->setType(InputType::Range);
    }

    public static function select(
        string $name,
        string $label,
        array|Collection $options,
    ): static {
        return static::make($name, $label)
            ->setOptions($options)
            ->setType(InputType::Select);
    }

    public static function textarea(
        string $name,
        string $label,
    ): static {
        return static::make($name, $label)
            ->setType(InputType::TextArea);
    }
}

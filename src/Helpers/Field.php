<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Helpers;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

// TODO Label must be question, label must be... display name?
// TODO Expand attributes, such as spellcheck, autocomplete, describedby, etc
class Field implements Arrayable
{
    public string $accept = '*';

    public string $hint = '';

    public string $id;

    public bool $isTitle = false;

    public string $displayName;

    public string $max = '';

    public string $min = '';

    public string $noOptionsMessage = 'No options available';

    public bool $optional = false;

    public string $optionalLabel = '(optional)';

    public array $options = [];

    public string $step = '';

    public InputType $type = InputType::Text;

    public mixed $value = null;

    // Setup
    /**
     * @param string $name Should correspond to a Model attribute, unless configured otherwise on the Question, such as "name"
     * @param string $label Should be phrased as a question, such as "What is your name?"
     * @param ?string $displayName How the field should be shown when summarising, such as "Name"
     */
    final public function __construct(
        public string $name,
        public string $label,
        ?string $displayName = null,
    ) {
        $this->id = $name;

        $this->displayName = $displayName !== null
            ? $displayName
            : Str::of($name)
                ->replace(['_', '.', '-'], ' ')
                ->ucfirst();
    }

    public static function make(
        string $name,
        string $label,
        ?string $displayName = null,
    ): static {
        return new static($name, $label, $displayName);
    }

    // Arrayable
    public function toArray(): array
    {
        return [
            'accept' => $this->accept,
            'hint' => $this->hint,
            'id' => $this->id,
            'isTitle' => $this->isTitle,
            'displayName' => $this->displayName,
            'label' => $this->label,
            'max' => $this->max,
            'min' => $this->min,
            'name' => $this->name,
            'noOptionsMessage' => $this->noOptionsMessage,
            'optional' => $this->optional,
            'optionalLabel' => $this->optionalLabel,
            'options' => $this->options,
            'step' => $this->step,
            'type' => $this->type->value,
            'value' => $this->value,
        ];
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

    public function setAccept(string|array $accept): static
    {
        $this->accept = is_array($accept) === true
            ? implode(',', $accept)
            : $accept;

        return $this;
    }

    public function setDisplayName(string $displayName): static
    {
        $this->displayName = $displayName;
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

    public function setLabel(string $label): static
    {
        $this->label = $label;
        return $this;
    }

    public function setMax(string|int|float $max): static
    {
        $this->max = (string) $max;
        return $this;
    }

    public function setMin(string|int|float $min): static
    {
        $this->min = (string) $min;
        return $this;
    }

    public function setNoOptionsMessage(string $message): static
    {
        $this->noOptionsMessage = $message;
        return $this;
    }

    public function setOptional(bool $optional): static
    {
        $this->optional = $optional;
        return $this;
    }

    public function setOptionalLabel(string $label): static
    {
        $this->optionalLabel = $label;
        return $this;
    }

    public function setOptions(array|Collection $options): static
    {
        $this->options = is_a($options, Collection::class) === true
            ? $options->toArray()
            : $options;

        return $this;
    }

    public function setStep(string|int|float $step): static
    {
        $this->step = (string) $step;
        return $this;
    }

    public function setType(InputType $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function setValue(mixed $value): static
    {
        $this->value = $value;
        return $this;
    }

    public function title(): static
    {
        $this->isTitle = true;
        return $this;
    }

    // Builders
    public static function checkboxes(
        string $name,
        string $label,
        array|Collection $options,
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setOptions($options)
            ->setType(InputType::Checkbox);
    }

    public static function file(
        string $name,
        string $label,
        string|array $accept = '*',
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setAccept($accept)
            ->setType(InputType::File);
    }

    public static function hidden(
        string $name,
        ?string $value,
    ): static {
        return static::make($name, '', '')
            ->setType(InputType::Hidden)
            ->setValue($value);
    }

    public static function input(
        string $name,
        string $label,
        InputType $type = InputType::Text,
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setType($type);
    }

    public static function password(
        string $name,
        string $label,
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setType(InputType::Password);
    }

    public static function radios(
        string $name,
        string $label,
        array|Collection $options,
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setOptions($options)
            ->setType(InputType::Radio);
    }

    public static function range(
        string $name,
        string $label,
        string|int|float $min = '',
        string|int|float $max = '',
        string|int|float $step = '',
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setMin($min)
            ->setMax($max)
            ->setStep($step)
            ->setType(InputType::Range);
    }

    public static function select(
        string $name,
        string $label,
        array|Collection $options,
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setOptions($options)
            ->setType(InputType::Select);
    }

    public static function textarea(
        string $name,
        string $label,
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setType(InputType::TextArea);
    }
}

<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Helpers;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

// TODO Expand attributes, such as spellcheck, autocomplete, describedby, etc
class Field
{
    public string $accept = '*';

    public string $hint = '';

    public string $id;

    public bool $isTitle = false;

    public string $label;

    public string $max = '';

    public string $min = '';

    public string $noOptionsMessage = 'No options available';

    public bool $optional = false;

    public string $optionalLabel = '(optional)';

    public array $options = [];

    public string $step = '';

    public InputType $type = InputType::Text;

    public int|string|float|array|null $value = null;

    // Setup
    /**
     * @param string $name Should correspond to a Model attribute, unless configured otherwise on the Question, such as "name"
     * @param string $question Should be phrased as a question, such as "What is your name?"
     * @param ?string $label How the field should be shown when summarising, such as "Name"
     */
    final public function __construct(
        public string $name,
        public string $question,
        ?string $label = null,
    ) {
        $this->id = $name;

        $this->label = $label !== null
            ? $label
            : Str::of($name)
                ->replace(['_', '.', '-'], ' ')
                ->ucfirst();
    }

    public static function make(
        string $name,
        string $question,
        ?string $label = null,
    ): static {
        return new static($name, $question, $label);
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

    public function setValue(int|string|float|array|null $value): static
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
        string $question,
        array|Collection $options,
        ?string $label = null,
    ): static {
        return static::make($name, $question, $label)
            ->setOptions($options)
            ->setType(InputType::Checkbox);
    }

    public static function file(
        string $name,
        string $question,
        string|array $accept = '*',
        ?string $label = null,
    ): static {
        return static::make($name, $question, $label)
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
        string $question,
        InputType $type = InputType::Text,
        ?string $label = null,
    ): static {
        return static::make($name, $question, $label)
            ->setType($type);
    }

    public static function password(
        string $name,
        string $question,
        ?string $label = null,
    ): static {
        return static::make($name, $question, $label)
            ->setType(InputType::Password);
    }

    public static function radios(
        string $name,
        string $question,
        array|Collection $options,
        ?string $label = null,
    ): static {
        return static::make($name, $question, $label)
            ->setOptions($options)
            ->setType(InputType::Radio);
    }

    public static function range(
        string $name,
        string $question,
        string|int|float $min = '',
        string|int|float $max = '',
        string|int|float $step = '',
        ?string $label = null,
    ): static {
        return static::make($name, $question, $label)
            ->setMin($min)
            ->setMax($max)
            ->setStep($step)
            ->setType(InputType::Range);
    }

    public static function select(
        string $name,
        string $question,
        array|Collection $options,
        ?string $label = null,
    ): static {
        return static::make($name, $question, $label)
            ->setOptions($options)
            ->setType(InputType::Select);
    }

    public static function textarea(
        string $name,
        string $question,
        ?string $label = null,
    ): static {
        return static::make($name, $question, $label)
            ->setType(InputType::TextArea);
    }
}

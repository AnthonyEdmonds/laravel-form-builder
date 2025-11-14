<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Helpers;

use AnthonyEdmonds\LaravelFormBuilder\Enums\InputType;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Field implements Arrayable
{
    public string $accept = '*';

    public string $autocomplete = 'on';

    public string $blade = 'text-input';

    public ?int $count = null;

    public string $hint = '';

    public string $id;

    public bool $isTitle = false;

    public string $displayName;

    public bool $isInline = false;

    public string $inputmode = 'text';

    public string $max = '';

    public string $min = '';

    public string $noOptionsMessage = 'No options available';

    public bool $optional = false;

    public string $optionalLabel = '(optional)';

    public array $options = [];

    public ?string $placeholder = null;

    public ?string $prefix = null;

    public int $rows = 5;

    public bool $spellcheck = false;

    public string $step = '';

    public ?string $suffix = null;

    public ?int $threshold = null;

    public InputType $type = InputType::Text;

    public mixed $value = null;

    public ?int $width = null;

    public ?int $words = null;

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
            'autocomplete' => $this->autocomplete,
            'blade' => $this->blade,
            'count' => $this->count,
            'displayName' => $this->displayName,
            'hint' => $this->hint,
            'id' => $this->id,
            'inputmode' => $this->inputmode,
            'isInline' => $this->isInline,
            'isTitle' => $this->isTitle,
            'label' => $this->optional === true
                ? "$this->label $this->optionalLabel"
                : $this->label,
            'max' => $this->max,
            'min' => $this->min,
            'name' => $this->name,
            'noOptionsMessage' => $this->noOptionsMessage,
            'optional' => $this->optional,
            'optionalLabel' => $this->optionalLabel,
            'options' => $this->options,
            'placeholder' => $this->placeholder,
            'prefix' => $this->prefix,
            'rows' => $this->rows,
            'spellcheck' => $this->spellcheck,
            'step' => $this->step,
            'suffix' => $this->suffix,
            'threshold' => $this->threshold,
            'type' => $this->type->value,
            'value' => $this->value,
            'width' => $this->width,
            'words' => $this->words,
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

    public function setAutocomplete(string $autocomplete): static
    {
        $this->autocomplete = $autocomplete;
        return $this;
    }

    public function setBlade(string $blade): static
    {
        $this->blade = $blade;
        return $this;
    }

    public function setCount(int $count): static
    {
        $this->count = $count;
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

    public function setInputmode(string $mode): static
    {
        $this->inputmode = $mode;
        return $this;
    }

    public function setIsInline(bool $inline): static
    {
        $this->isInline = $inline;
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

    public function setPlaceholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function setPrefix(string $prefix): static
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function setRows(int $rows): static
    {
        $this->rows = $rows;
        return $this;
    }

    public function setSpellcheck(bool $enabled): static
    {
        $this->spellcheck = $enabled;
        return $this;
    }

    public function setStep(string|int|float $step): static
    {
        $this->step = (string) $step;
        return $this;
    }

    public function setSuffix(string $suffix): static
    {
        $this->suffix = $suffix;
        return $this;
    }

    public function setThreshold(int $threshold): static
    {
        $this->threshold = $threshold;
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

    public function setWidth(int $width): static
    {
        $this->width = $width;
        return $this;
    }

    public function setWords(int $words): static
    {
        $this->words = $words;
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
            ->setBlade('checkboxes')
            ->setOptions($options)
            ->setType(InputType::Checkbox);
    }

    public static function date(
        string $name,
        string $label,
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setBlade('date-input')
            ->setType(InputType::Date);
    }

    public static function file(
        string $name,
        string $label,
        string|array $accept = '*',
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setAccept($accept)
            ->setBlade('file-upload')
            ->setType(InputType::File);
    }

    public static function hidden(
        string $name,
        ?string $value,
    ): static {
        return static::make($name, '', '')
            ->setBlade('hidden-input')
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
            ->setBlade('text-input')
            ->setType($type);
    }

    public static function password(
        string $name,
        string $label,
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setBlade('password')
            ->setType(InputType::Password);
    }

    public static function radios(
        string $name,
        string $label,
        array|Collection $options,
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setBlade('radios')
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
            ->setBlade('text-input')
            ->setMin($min)
            ->setMax($max)
            ->setStep($step)
            ->setType(InputType::Range);
    }

    public static function readonly(
        string $label,
        ?string $value,
    ): static {
        return static::make($label, $label, $label)
            ->setType(InputType::ReadOnly)
            ->setValue($value);
    }

    public static function select(
        string $name,
        string $label,
        array|Collection $options,
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setBlade('select')
            ->setOptions($options)
            ->setType(InputType::Select);
    }

    public static function textarea(
        string $name,
        string $label,
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setBlade('textarea')
            ->setType(InputType::TextArea);
    }

    public static function time(
        string $name,
        string $label,
        ?string $displayName = null,
    ): static {
        return static::make($name, $label, $displayName)
            ->setBlade('time-input')
            ->setType(InputType::Time);
    }
}

# Upgrading

## Update to version 2.x from version 1.x

### Answers are now derived from the Model

Getting and formatting answers has been deferred from the `Question` to the `Model`.

This allows you to keep all formatting on the `Model` instead of defining formats on the `Question`.

> If you have not implemented any answer overrides on your `Question` classes, the provided `HasForm` trait will continue working as expected.

1. Remove any calls to the following from any `Question` classes:
   * `blankAnswerLabel($fieldName)`
   * `getFormattedAnswer($fieldName)`
   * `getRawAnswer($fieldName)`
   * `hasAnswer($fieldName)`
2. Implement any custom formatting on the relevant `Model` instead:
   * `blankAnswer($property)`
   * `hasAnswer($property)`
   * `formattedAnswer($property)`
   * `rawAnswer($property)`

Here is an example custom implementation of `formattedAnswer()` on a `Model`:

```php
public function formattedAnswer(string $property): mixed
{
    return match ($property) {
        'my_text_area' => nl2br($this->my_text_area),
        'a_currency',
        'another_currency' => Number::currency($this->property, 'GBP'),
        default => $this->getAnswer($property),
    } ?? $this->blankAnswer($property);
}
```

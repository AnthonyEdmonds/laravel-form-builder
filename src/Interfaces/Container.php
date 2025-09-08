<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Interfaces;

use Illuminate\Http\RedirectResponse;

interface Container
{
    public function findItem(string $itemKey): ?Item;

    /** @param class-string<Item>[] $items */
    public function findNextItem(string $currentKey, array $items): ?Item;

    /** @param class-string<Item>[] $items */
    public function findPreviousItem(string $currentKey, array $items): ?Item;

    /** @returns class-string<Item>[] */
    public function items(): array;

    /** @param class-string<Item> $itemClass */
    public function makeItem(string $itemClass): Item;

    public function nextItem(string $currentKey): RedirectResponse;

    public function previousItem(string $currentKey): RedirectResponse;
}

<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Container as ContainerInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

abstract class Container extends Item implements ContainerInterface
{
    /** @returns class-string<Item>[] */
    abstract public function items(): array;

    /** @param class-string<Item> $itemClass */
    abstract public function makeItem(string $itemClass): Item;

    public function findItem(string $itemKey): ?Item
    {
        $items = $this->items();

        foreach ($items as $itemClass) {
            if ($itemClass::key() === $itemKey) {
                return $this->makeItem($itemClass);
            }
        }

        return null;
    }

    public function findNextItem(string $currentKey, array $items): ?Item
    {
        $found = false;

        /** @var class-string<Item> $itemClass */
        foreach ($items as $itemClass) {
            if ($found === true) {
                return $this->makeItem($itemClass);
            }

            if ($itemClass::key() === $currentKey) {
                $found = true;
            }
        }

        return null;
    }

    public function findPreviousItem(string $currentKey, array $items): ?Item
    {
        return $this->findNextItem(
            $currentKey,
            array_reverse($items),
        );
    }

    public function nextItem(string $currentKey): RedirectResponse
    {
        $nextItem = $this->findNextItem(
            $currentKey,
            $this->items(),
        );

        return Redirect::route(
            $nextItem !== null
                ? $nextItem->route()
                : $this->route(),
        );
    }

    public function previousItem(string $currentKey): RedirectResponse
    {
        $previousItem = $this->findPreviousItem(
            $currentKey,
            $this->items(),
        );

        return Redirect::route(
            $previousItem !== null
                ? $previousItem->route()
                : $this->route(),
        );
    }
}

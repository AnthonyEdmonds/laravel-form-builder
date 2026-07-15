<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\FormRequests;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\FormBuilderFileStore;

class TestFileStore extends FormBuilderFileStore
{
    public int $maxFileSize = 0;

    public array $allowedMimes = [];

    public function maxFiles(): int
    {
        return 3;
    }

    public function maxStoreSize(): int
    {
        return 1024;
    }

    public function maxFileSize(): int
    {
        return $this->maxFileSize;
    }

    public function allowedMimes(): array
    {
        return $this->allowedMimes;
    }
}

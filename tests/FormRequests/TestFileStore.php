<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\FormRequests;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\FormBuilderFileStore;

class TestFileStore extends FormBuilderFileStore
{
    public function maxFiles(): int
    {
        return 3;
    }

    public function maxStoreSize(): int
    {
        return 1024;
    }
}

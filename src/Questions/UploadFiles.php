<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Questions;

use AnthonyEdmonds\LaravelFileStore\FileStore;
use AnthonyEdmonds\LaravelFormBuilder\FormRequests\UploadFileRequest;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;

abstract class UploadFiles extends Question
{
    /** @return string How the Field should be labelled */
    abstract public function displayName(): string;

    /** @return FileStore The FileStore to use on the Model */
    abstract public function fileStore(): FileStore;

    /** @return int How many files are required to continue */
    public function filesRequired(): int
    {
        return 0;
    }

    // Question
    public function label(): string
    {
        return 'Upload files';
    }

    public function fields(): array
    {
        $fileStore = $this->fileStore();

        $mimes = $fileStore->allowedMimes(false);
        $formats = $fileStore->allowedMimes();
        $size = $fileStore->maxSize();

        return [
            Field::file(
                'file',
                'Which file would you like to upload?',
                $mimes,
                $this->displayName(),
            )->setHint("You may upload a file up to $size in the following formats: $formats"),
        ];
    }

    public function formRequest(): string
    {
        return UploadFileRequest::class;
    }

    public function applySave(FormRequest $formRequest): void
    {
        $fileStore = $this->fileStore();

        $fileStore->add(
            $formRequest->file('file'),
        );
    }

    public function hideTitle(): bool
    {
        return false;
    }

    // TODO
    public function blade(): string
    {
        return 'form-builder::upload-file';
    }

    // TODO
    public function show(): View
    {
        $fileStore = $this->fileStore();

        return parent::show()
            ->with(
                'fileList',
                $fileStore->list(),
            );
    }

    public function saveLabel(): string
    {
        return 'Upload file';
    }

    public function loopingIsEnabled(): bool
    {
        return true;
    }

    public function skipIsEnabled(): bool
    {
        return $this->isValid() === true;
    }

    public function skipLabel(): string
    {
        return 'Done and continue';
    }

    public function hasNotBeenStarted(): bool
    {
        $fileStore = $this->fileStore();

        return $this->filesRequired() > 0
            && $fileStore->count() === 0;
    }

    public function isValid(): bool
    {
        $fileStore = $this->fileStore();

        return $fileStore->count() >= $this->filesRequired();
    }
}

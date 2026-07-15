<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Questions;

use AnthonyEdmonds\LaravelFileStore\FileStore;
use AnthonyEdmonds\LaravelFormBuilder\FormRequests\UploadFileRequest;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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

        $hint = 'You may upload a file ';

        $hint .= $fileStore->maxFileSize() > 0
            ? "up to {$fileStore->maxFileSizeString()} "
            : 'of any size ';

        $hint .= empty($fileStore->allowedMimes()) === false
            ? "in the following formats: {$fileStore->allowedMimesString()}"
            : 'in any format';

        return [
            Field::file(
                'file',
                'Which file would you like to upload?',
                $fileStore->allowedMimes(),
                $this->displayName(),
            )->setHint($hint),
        ];
    }

    public function formRequest(): string
    {
        return UploadFileRequest::class;
    }

    public function applySave(FormRequest $formRequest): void
    {
        $this->fileStore()->add(
            $formRequest->file('file'),
        );
    }

    public function hideTitle(): bool
    {
        return false;
    }

    public function blade(): string
    {
        return 'form-builder::upload-file';
    }

    public function show(): View
    {
        $fileStore = $this->fileStore();
        $filesRequired = $this->filesRequired();
        $maxFiles = $fileStore->maxFiles();

        $with = [
            'filesList' => $fileStore->list([
                'form' => $this->form::key(),
                'task' => $this->task::key(),
                'question' => static::key(),
            ]),
        ];

        if ($filesRequired > 0) {
            $with['filesMinimum'] = Str::plural('file', $filesRequired, true);
        }

        if ($maxFiles > 0) {
            $with['filesLimit'] = $fileStore->maxFilesString();
        }

        if (
            $filesRequired > 0
            || $maxFiles > 0
        ) {
            $with['filesCurrent'] = $fileStore->countString();
        }

        if ($fileStore->maxStoreSize() > 0) {
            $with['storeCurrent'] = $fileStore->currentStoreSizeString();
            $with['storeLimit'] = $fileStore->maxStoreSizeString();
        }

        return parent::show()->with($with);
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
        return $this->filesRequired() > 0
            && $this->fileStore()->count() === 0;
    }

    public function isValid(): bool
    {
        return $this->fileStore()->count() >= $this->filesRequired();
    }

    public function validationData(): array
    {
        $data = parent::validationData();
        $data['fileStore'] = $this->fileStore();

        return $data;
    }

    public function validate(): void
    {
        request()->merge([
            'fileStore' => $this->fileStore(),
        ]);

        parent::validate();
    }
}

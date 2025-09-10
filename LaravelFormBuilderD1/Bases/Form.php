<?php

abstract class Form
{
    public function save(): RedirectResponse
    {
        if (static::SAVE_ENABLED !== true) {
            return $this->submit();
        }

        $canSave = $this->model->canSave();
        if ($canSave !== true) {
            return back()->withErrors([
                'content' => $canSave,
            ]);
        }

        $this->saveModel();
        Session::forget(static::key());

        return redirect($this->exitRoute());
    }

    public function submit(): RedirectResponse
    {
        $canSubmit = $this->model->canSubmit();
        if ($canSubmit !== true) {
            return back()->withErrors([
                'content' => $canSubmit,
            ]);
        }

        $this->submitModel();
        Session::flash(static::key(), $this->model);

        $nextRoute = $this->finishScreen() !== null
            ? $this->finishRoute()
            : $this->exitRoute();

        return redirect($nextRoute);
    }
}

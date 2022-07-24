<?php

namespace YellowThree\VoyagerForms;

use YellowThree\VoyagerForms\Form;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class Forms
{
    protected $models = [
        'Form' => Form::class,
    ];

    protected function model($name)
    {
        return app($this->models[Str::studly($name)]);
    }

    public function forms($key, $default = null)
    {
        $form = self::model('Form')->where('id', $key)->first();

        try {
            if (!View::exists('voyager-forms::layouts.' . $form->layout)) {
                $form->layout = 'default';
            }

            return view('voyager-forms::layouts.' . $form->layout, [
                'form' => $form,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getTraceAsString());
        }
    }
}

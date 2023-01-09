<?php

namespace App\Admin\Models;

use App\Admin\Extensions\LocalizeRowsDisplay;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Model\SectionModelConfiguration;

class Main extends SectionModelConfiguration {
    protected $navigationPosition = 100;
    protected $transPrefix = 'admin';

    public function fireEdit($id, $payload = [])
    {
        $form = parent::fireEdit($id);
        $form->getModel()->setDefaultLocale(
            $this->getLocale()
        );

        return $form;
    }

    public function initialize()
    {
        $this->addToNavigation($this->navigationPosition);
        $this->saving(function ($model) {
            $model->getModel()->setDefaultLocale(
                $this->getLocale()
            );
        });
    }

    public function getLocale(): string
    {
        return request('lang', $this->app->getLocale());
    }

    protected function trans(string $key)
    {
        return trans($this->transPrefix.'.'.$key, ['locale' => $this->getLocale()]);
    }

    public function getAvailableLocales(): array
    {
        return \LaravelLocalization::getSupportedLanguagesKeys();
    }

    protected function extendDisplay(DisplayInterface $display, $latestColumn = 'created_at'): DisplayInterface
    {
        $display->setNewEntryButtonText($this->trans('table.button.create'));
        $display->extend('localize.rows', new LocalizeRowsDisplay());
        // $display->extend('localized_buttons', new LocalizedButtons($this->getAvailableLocales()));
        $display->setApply([
            function ($query) use ($latestColumn) {
                $query->latest($latestColumn);
            },
        ]);

        return $display;
    }
}

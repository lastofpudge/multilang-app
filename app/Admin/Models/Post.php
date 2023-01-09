<?php

namespace App\Admin\Models;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Admin\Columns\Langs as LangsColumn;

class Post extends Main
{

//    protected $checkAccess = false;

    public function getIcon()
    {
        return 'fa fa-group';
    }

    public function getTitle()
    {
        return 'Posts';
    }

    public function initialize()
    {
        $this->addToNavigation(100);
    }

    public function onDisplay()
    {
        $display = AdminDisplay::table()
            ->setColumns(
                new LangsColumn($this->getAvailableLocales(), 'Langs'),
                AdminColumn::link('slug')->setLabel('slug')
            )
            ->paginate(15);
        return $display;
    }

    public function onEdit($id)
    {
        $form = AdminForm::panel();
        $tabs = AdminDisplay::tabbed([
            'Globals' => new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::text('title', 'Title')->required()->addValidationRule('max:255'),
                AdminFormElement::text('slug', 'Slug')->required()->addValidationRule('max:255'),
            ])
        ]);
        $form->addElement($tabs)->setHtmlAttribute('id', 'posts-tiny-form');
        return $form;
    }

    public function onCreate()
    {
        return $this->onEdit(null);
    }

    public function onDelete($id)
    {
        // remove if unused
    }

    public function onRestore($id)
    {
        // remove if unused
    }

    public function getUpdateUrl($id, array $parameters = [])
    {
        return route('admin.model.update', [
            $this->getAlias(), $id, 'lang' => $this->getLocale(),
        ]);
    }
}

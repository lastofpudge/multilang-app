<?php

//namespace App\Admin\Extensions;
//
//use SleepingOwl\Admin\Display\Extension\Extension;
//
//class LocalizeRowsDisplay extends Extension
//{
//    /**
//     * Get the instance as an array.
//     *
//     * @return array
//     */
//    public function toArray()
//    {
//        $this->getDisplay()->getCollection()->getCollection()
//            ->each(function ($item) {
//                if (!$item->hasTranslation('ru') && $item->hasTranslation('uk')) {
//                    $item->setDefaultLocale('uk');
//                }
//            });
//    }
//}

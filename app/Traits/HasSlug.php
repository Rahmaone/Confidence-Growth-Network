<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function ($model) {
            $slug = Str::slug($model->{$model->slugSource()});

            $model->slug = $slug . '-' . substr(sha1($model->{$model->slugSource()}), 0, 8);
        });

        static::updating(function ($model) {
            if ($model->isDirty($model->slugSource())) {
                $slug = Str::slug($model->{$model->slugSource()});

                $model->slug = $slug . '-' . substr(sha1($model->{$model->slugSource()}), 0, 8);
            }
        });
    }

    protected function slugSource()
    {
        return 'title';
    }
}

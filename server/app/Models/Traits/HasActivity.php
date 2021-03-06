<?php

namespace App\Models\Traits;

use App\Models\Activity;
use App\Models\Enums\CudActionEnum;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait HasActivity.
 *
 * @mixin Model
 */
trait HasActivity
{
    protected $activity = true;

    public static function bootHasActivity()
    {
        static::created(function (Model $model) {
            /* @var HasActivity $model */
            $model->saveActivity(CudActionEnum::create()->getValue());
        });

        static::updated(function (Model $model) {
            /* @var HasActivity $model */
            $model->saveActivity(CudActionEnum::update()->getValue());
        });

        static::deleted(function (Model $model) {
            /* @var HasActivity $model */
            $model->saveActivity(CudActionEnum::delete()->getValue());
        });
    }

    public function withoutActivity()
    {
        $this->activity = false;

        return $this;
    }

    protected function saveActivity(string $action)
    {
        if (! $this->activity) {
            return;
        }

        $activity = new Activity();

        $activity->action = $action;
        $activity->model()->associate($this);

        if ('update' === $action) {
            $activity->old_data = $this->fresh()->toJson();
        }
        if ('delete' === $action) {
            $activity->old_data = $this->toJson();
        }
        $activity->save();
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'model');
    }
}

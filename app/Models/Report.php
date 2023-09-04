<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Report extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity;

    protected $fillable = [
        'reporter_id',
        'category_id',
        'ticket_id',
        'title',
        'description',
        'status'
    ];

    function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['reporter_id', 'ticket_id', 'title', 'status'])
            ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}")
            ->useLogName('Report');
    }

    public function reporter()
    {
        return $this->belongsTo(Reporter::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault([
            "name" => "null"
        ]);
    }

    public function reportTracker()
    {
        return $this->hasMany(ReportTracker::class);
    }
}

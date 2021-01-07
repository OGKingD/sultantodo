<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    protected $guarded = ['id'];

    public function task(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
    protected $casts = [
        'completed_at' => 'datetime',

    ];
    public function toggleCompletion($status): bool
    {
        if ($status === "true") {

            return $this->update([
                'completed_at' => now(),
            ]);
        }

        return $this->update([
            'completed_at' => null,
        ]);
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = ['id'];


    public function subtasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Subtask::class);

    }

    public function addSubtasks($subtask)
    {
        $this->subtasks()->create([
            'name'=> $subtask,
        ]);
    }

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

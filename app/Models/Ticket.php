<?php

namespace App\Models;

use App\Enums\ticket\Status;
use App\Enums\user\Roles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority_id',
        'status',
        'user_id',
        'assigned_user_agent'
    ];

    public static function fromNotRegularUsers()
    {
        return Ticket::query()
            ->where('user_id', auth()->id())
            ->orWhere('assigned_user_agent', auth()->id())
            ->get();
    }

    public static function getAmount(Collection $tickets)
    {
        $data = [];

        $data['total'] = $tickets->count();
        $data['open'] = $tickets->where('status', Status::Open->value)->count();
        $data['closed'] = $tickets->where('status', Status::Closed->value)->count();

        return $data;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class);
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}

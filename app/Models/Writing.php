<?php

namespace App\Models;

use App\Actions\Ipfs\GetFromIpfs;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Writing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'hash',
        'word_count',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    protected $appends = [
        'content', 'ipfs_link', 'reached_goal',
    ];

    public function content(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->hash ? GetFromIpfs::run($this->hash) : null,
        );
    }

    public function ipfsLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->hash ? 'https://gateway.ipfs.io/ipfs/' . $this->hash : null,
        );
    }

    public function reachedGoal(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->word_count >= config('dailywriter.goal'),
        );
    }
}

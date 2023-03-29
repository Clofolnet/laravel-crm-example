<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Region;
use App\Models\Major;
use App\Models\Comment;

class Student extends Model
{
    use HasFactory;

    /* Genders */
    const MAN = 1;
    const FEMALE = 2;

    /* Contract Types */
    const TYPE_B = 1;
    const TYPE_BG = 2;
    const TYPE_M = 3;
    const TYPE_MG = 4;

    /* Statues */
    const RECENTLY_ADDED = 1;
    const MARKETING_CONSIDERATION = 2;
    const RECTOR_CONSIDERATION = 3;
    const ACCEPTED = 4;
    const NOT_ACCEPTED = 5;
    const DELETED = 6;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => self::RECENTLY_ADDED,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'contract_type',
        'name',
        'surname',
        'middle_name',
        'birth_of_date',
        'email',
        'address',
        'phone',
        'passport_series',
        'passport_number',
        'PIN',
        'authority',
        'gender',
        'discount',
        'percent',
        'discount_from',
        'discount_to',
        'super_contract',
        'super_contract_sum',
        'passport_document',
        'IELTS_document',
        'contract_document',
        'status',

        'region_id',
        'major_id',
        'comment_id'
    ];

    /**
     * Obtaining a student region
     **/
    public function region(): BelongsTo
    {
        return $this->BelongsTo(Region::class);
    }

    /**
     * Obtaining a student major
     **/
    public function major(): BelongsTo
    {
        return $this->BelongsTo(Major::class);
    }

    /**
     * Obtaining a student comment
     **/
    public function comment(): BelongsTo
    {
        return $this->BelongsTo(Comment::class);
    }
}
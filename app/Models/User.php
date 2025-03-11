<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   protected $guarded = [];

    protected static function booted(): void
    {
//        static::creating(static function ($model) {
//            $model->created_by = auth()->id();
//        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    //Relations

    public function created_user(): BelongsTo
    {
        return $this->belongsTo(__CLASS__,'created_by');
    }

    public function updated_user(): BelongsTo
    {
        return $this->belongsTo(__CLASS__,'updated_by');
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function plans(): HasMany
    {
        return $this->hasMany(User_Plan::class,'user_id');
    }

    public function active_plan()
    {
        if ($this->plans()->count()) {
            return $this->plans()->where('status',User_Plan::STATUS_ACTIVE);
        }
        return null;
    }

    public function questions() : HasMany
    {
        return $this->hasMany(User_Question::class,'user_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class,'user_id');
    }

    public static function searchable()
    {
        $fields = [
            [
                'label' => 'نام و نام خانوادگی',
                'field' => 'name',
                'type' => 'text'
            ],
            [
                'label' => 'شماره موبایل',
                'field' => 'phone',
                'type' => 'text'
            ],
            [
                'label' => 'وضعیت',
                'field' => 'is_active',
                'type' => 'select',
                'items' => [
                    [
                        'label' => 'فعال',
                        'value' => 1
                    ],
                    [
                        'label' => 'غیر فعال',
                        'value' => 0
                    ]
                ]
            ],

        ];
        return $fields;
    }
}

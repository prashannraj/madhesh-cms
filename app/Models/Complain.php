<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Year;

class Complain extends Model
{
   protected $fillable = [
        'name_type', 'name', 'gender', 'age_group', 'contact_number',
        'email', 'complaint_type', 'subject_of_complaint',
        'corruption_domain', 'against_person_or_institution',
        'additional_info', 'year_id', 'uploaded_file', 'terms_accepted',
        'submission_number', 'status'
    ];
    // protected $casts = [
    //     'terms_accepted' => 'boolean',
    //     'subject_of_complaint' => 'array',
    //     'submission_number' => 'integer',
    // ];

    // protected static function booted()
    //     {
    //         static::creating(function ($complain) {
    //             if (!$complain->submission_number) {
    //                 $complain->submission_number = Complain::max('submission_number') + 1;
    //             }
    //         });
    //     }
    public function year()
    {
        return $this->belongsTo(Year::class);
    }

}

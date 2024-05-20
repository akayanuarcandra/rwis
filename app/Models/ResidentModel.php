<?php

namespace App\Models;

use App\enum\GenderResident;
use App\enum\IsArchived;
use App\enum\MarriageStatusResident;
use App\enum\NationalityResident;
use App\enum\ReligionResident;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentModel extends Model
{
    use HasFactory;

    protected $table = 'resident';
    protected $primaryKey = 'resident_id';

    protected $fillable = [
        'household_id',
        'nik',
        'full_name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'blood_type',
        'religion',
        'marriage_status',
        'nationality',
        'range_income',
        'job',
        'whatsapp_number',
        'is_archived',
    ];

    protected function casts(): array {
        return [
            'gender' => GenderResident::class,
            'religion' => ReligionResident::class,
            'marriage_status' => MarriageStatusResident::class,
            'nationality' => NationalityResident::class,
        ];
    }

    public function household() {
        return $this->belongsTo(HouseholdModel::class, 'household_id', 'household_id');
    }
}

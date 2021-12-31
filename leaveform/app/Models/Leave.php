<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

class Leave extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'days', // leave days
        'type', // enum?
        'start',
        'sent',
        'end',// compute days from start - end
        'phone',
        'reason',
        'address', // contact address
        'holidays', // holidays in leave period

        'decl', // <-- THIS
        'decl_sig','decl_date','decl_name','decl_email',
        // Supervisor
        'super_sig','super_date','super_name','super_email',
        // Head of Department
        'hod_sig','hod_date','hod_name','hod_email',
        // Group Head, Human Resources
        'hr_sig','hr_date','hr_name','hr_email',
        // ? approved | pending | cancelled
        'status' // <- determines days available
    ];

    protected $appends = [];

    public function getReturnAttribute() {
        return $this->start->copy()->addDays($this->days + 1);
    }

    public function getValidAttribute() { // True if enough days for leave
        $available = $this->available;
        return ($this->status == 'approved') || ($this->days <= $available);
    }

    public function getAvailableAttribute() { // Days left
        return self::available($this->user_id, $this->start->year);
    }

    public static function available($user_id, $year) { // Days left
        $used = Leave::used($user_id, $year);
        $user = User::findOrFail($user_id);
        $entitled = $user->entitled;
        Log::info("Entitled days: {$entitled} for User ID {$user_id}.");
        $available = $entitled - $used;
        return $available;
    }

    public static function used($user_id, $year) {
        $days = Leave::where('user_id', $user_id)
        ->whereYear('start', (string)$year)
        ->where('status', 'approved')
        ->sum('days');
        Log::info("Used days: {$days} for User ID {$user_id}.");
        return $days;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'end' => 'date',
        'sent' => 'boolean',
        'start' => 'date',
    ];
}

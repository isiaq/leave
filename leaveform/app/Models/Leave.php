<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leave
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
        'start', // compute end from start + days
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
        // Approved?
        'status'
    ];

    protected $appends = [
        'end', 
        'return',
    ];

    public function getEndAttribute() {
        return $this->start->copy()->addDays($this->days);
    }

    public function getReturnAttribute() {
        return $this->start->copy()->addDays($this->days + 1);
    }

    public function getValidAttribute() { // True if enough days for leave
        $available = $this->available();
        return ($this->status == 'approved') || ($this->days <= $available);
    }

    public function getAvailableAttribute() {
        $year = $this->start->year;
        $days = Leave::where('user_id', $this->user_id)
        ->whereYear('start', $year)
        ->where('status', 'approved')
        ->sum('days');
        Log::info("Available days: {$days}.");
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
        'start' => 'date',
        'status' => 'boolean',
    ];
}

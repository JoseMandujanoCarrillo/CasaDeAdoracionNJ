<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'date', 'time', 'place', 'description', 'show_register_button'];
    /**
     * Obtener los registros de personas inscritas a este evento.
     */
    public function registrations()
    {
        return $this->hasMany(\App\Models\EventRegistration::class, 'event_id');
    }
}
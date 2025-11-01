<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $table = 'departements'; //  opsional jika plural default sudah sesuai
   protected $fillable = ['nama_departement','user','jabatan', 'perusahaan'];


    public function helpdeskMonitorings()
    {
        return $this->hasMany(HelpdeskMonitoring::class, 'departement_id');
    }

    public function ppiRequests()
{
    return $this->hasMany(PpiRequest::class);
}

}


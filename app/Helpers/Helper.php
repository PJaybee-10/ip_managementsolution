<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\Patients;
use App\Models\Doctors;

class Helper
{
    /**
     * Get all patients
     *
     * @return \Illuminate\Database\Eloquent\Collection|Patients[]
     */
    public static function getAllPatients()
    {
        return Patients::all();
    }

    /**
     * Get all doctors
     *
     * @return \Illuminate\Database\Eloquent\Collection|Doctors[]
     */
    public static function getAllDoctors()
    {
        return Doctors::all();
    }

    /**
     * Get doctors by specialization
     *
     * @param string $specialization
     * @return \Illuminate\Database\Eloquent\Collection|Doctors[]
     */
    public static function getDoctorsBySpecialization($specialization)
    {
        return Doctors::where('specialization', $specialization)->get();
    }
}

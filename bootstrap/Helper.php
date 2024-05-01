<?php

namespace App\Helpers;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Helper
{
    // Retrieve patient details by ID
    public static function getPatientDetail($id)
    {
        try {
            return Patient::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Handle the case when the patient is not found
            return null;
        }
    }

    // Retrieve doctor details by ID
    public static function getDoctorDetail($id)
    {
        try {
            return Doctor::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Handle the case when the doctor is not found
            return null;
        }
    }

    // Retrieve user details by ID
    public static function getUserDetail($id)
    {
        try {
            return User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Handle the case when the user is not found
            return null;
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class Stagiaire extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use HasFactory;

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id');
    }
    public function entretiens()
{
    return $this->hasMany(Entretien::class, 'stagiaire_id');
}


    // public function viewCv(Request $request)
    // {
    //     if (Storage::disk('local')->exists($fileName)) {
    //         $file = storage_path("app/" . $fileName);
    //         $headers = [
    //             'Content-Type' => 'application/pdf',
    //             'Content-Disposition' => 'inline; filename="' . $fileName . '"',
    //         ];
    //         return response()->file($file, $headers);
    //     } else
    //         return redirect()->back()->with('error', 'CV file not found.');
    // }
}

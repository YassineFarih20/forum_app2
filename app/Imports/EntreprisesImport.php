<?php

namespace App\Imports;

use App\Models\Entreprise;
use Maatwebsite\Excel\Concerns\ToModel;

class EntreprisesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        $ent = new Entreprise();
        $ent->email = $row[0];
        $ent->web = $row[1];
        $ent->raisonsociale = $row[2];
        $ent->raisonabregee = $row[3];
        $ent->representant = $row[4];
        $ent->logo = $row[5];
        $ent->stand = $row[6];
        return $ent;
    }
}

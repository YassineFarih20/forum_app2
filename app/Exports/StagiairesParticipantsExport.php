<?php

namespace App\Exports;

use App\Models\Stagiaire;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StagiairesParticipantsExport implements FromCollection,  WithHeadings
{
    public function collection()
    {

        $stgNotConfirmed = Stagiaire::join('etablissements', 'etablissements.id', '=', 'stagiaires.etablissement_id')
            ->select(
                'stagiaires.matricule',
                'stagiaires.cin',
                DB::raw('CONCAT(stagiaires.nom , " " ,stagiaires.prenom )'),
                'stagiaires.sexe',
                'stagiaires.telephone',
                'etablissements.nom as efp',
                'stagiaires.filiere',
            )
            ->where('status', '>', 0)
            ->get();

        return $stgNotConfirmed;
    }

    public function headings(): array
    {
        return [
            'MATRICULE',
            'CIN',
            'NOM COMPLET',
            'SEXE',
            'TELEPHONE',
            'EFP',
            'FILIERE',
        ];
    }
}

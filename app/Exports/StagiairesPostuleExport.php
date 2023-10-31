<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class StagiairesPostuleExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $interviewData = DB::table('entretiens as ent')
            ->join('entreprises as e', 'ent.entreprise_id', '=', 'e.id')
            ->join('stagiaires as s', 'ent.stagiaire_id', '=', 's.id')
            ->join('etablissements as efp', 'efp.id', '=', 's.etablissement_id')
            ->select(
                's.matricule',
                DB::raw('CONCAT(s.nom , " " ,s.prenom )'),
                'e.raisonabregee as entreprise',
                'efp.nom as etablissement',
                'ent.status',
            )->get();
        return $interviewData;
    }

    public function headings(): array
    {
        return [
            'MATRICULE',
            'NOM COMPLET',
            'ENTREPRISE',
            'ETABLISSEMENT',
            'STATUS',
        ];
    }
}

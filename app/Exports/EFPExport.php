<?php



namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class EFPExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $dataByEFP  = DB::table('stagiaires as s')
            ->join('etablissements as e', 's.etablissement_id', '=', 'e.id')
            ->select(
                'e.nom',
                DB::raw('SUM(CASE WHEN s.status = 0 THEN 1 ELSE 0 END) AS status_0_count'),
                DB::raw('SUM(CASE WHEN s.status in (1,2) THEN 1 ELSE 0 END) AS status_1_count'),
                DB::raw('SUM(CASE WHEN s.status = 2 THEN 1 ELSE 0 END) AS status_2_count'),
                DB::raw('count(*) AS total'),
            )
            ->groupBy('e.id', 'e.nom')
            ->get();

        foreach ($dataByEFP as $data) {
            $data->status_1_percentage = number_format(($data->status_1_count / $data->total) * 100, 2);
            $data->status_2_percentage = number_format(($data->status_2_count / $data->total) * 100, 2);
        }


        return $dataByEFP;
    }

    public function headings(): array
    {
        return [
            'EFP',
            'non confirmé',
            'confirmé',
            'attended',
            'total',
            'Taux de confirmation %',
            'Taux de participation %',
        ];
    }
}

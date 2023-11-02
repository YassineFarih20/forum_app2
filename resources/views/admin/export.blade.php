<!-- admin/export.blade.php -->
<table>
    <thead>
        <tr>
            <th>EFP</th>
            <th>non confirmé</th>
            <th>confirmé</th>
            <th>attended</th>
            <th>total</th>
            <th>Taux de confirmation %</th>
            <th>Taux de participation %</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataByEFP as $data)
        <tr>
            <td>{{ $data->nom }}</td>
            <td>{{ $data->status_0_count }}</td>
            <td>{{ $data->status_1_count }}</td>
            <td>{{ $data->status_2_count }}</td>
            <td>{{ $data->total }}</td>
            <td>{{ number_format(($data->status_1_count / $data->total) * 100, 2) }}%</td>
            <td>{{ number_format(($data->status_2_count / $data->total) * 100, 2) }}%</td>
        </tr>
        @endforeach
    </tbody>
</table>

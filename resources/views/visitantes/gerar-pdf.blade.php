<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Visitante</title>
</head>
<body style="font-size: 12px;">
    <h2 style="text-align: center">Visitante</h2>

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #adb5bd">
                <th style="border: 1px solid #ccc">Nome</th>
                <th style="border: 1px solid #ccc">Contacto</th>
                <th style="border: 1px solid #ccc">Tipo de Visita</th>
                <th style="border: 1px solid #ccc">Departamento</th>
                <th style="border: 1px solid #ccc">Pessoa Relacionada</th>
                <th style="border: 1px solid #ccc">Data</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse ($visits as $visitpdf)
                <tr>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $visitpdf->name }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $visitpdf->contact }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $visitpdf->visit_type }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $visitpdf->department ? $visitpdf->department->name : 'N/S' }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $visitpdf->related_person }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $visitpdf->created_at->format('d/m/Y') }}</td>
           
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nenhuma visita encontrada!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
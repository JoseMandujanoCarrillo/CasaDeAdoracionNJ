@extends('admin.dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Mensajes de Contacto</h3>
    </div>
    <div class="card-body">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#232323;">
                    <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Fecha</th>
                    <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Nombre</th>
                    <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Email</th>
                    <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Teléfono</th>
                    <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Mensaje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $msg)
                <tr>
                    <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                    <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $msg->name }}</td>
                    <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $msg->email }}</td>
                    <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $msg->phone }}</td>
                    <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $msg->message }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

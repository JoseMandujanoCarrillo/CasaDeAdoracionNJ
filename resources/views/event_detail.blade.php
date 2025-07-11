@extends('layouts.app')
@section('content')
<div class="container" style="max-width:700px; margin:2.5rem auto; background:#181818; border-radius:18px; box-shadow:0 4px 24px #FF3B3F33; padding:2.5rem 2rem 2rem 2rem; color:#fff;">
    <h1 style="color:#FF3B3F; font-size:2.3rem; font-weight:700; margin-bottom:0.7rem; letter-spacing:0.5px;">{{ $event->name }}</h1>
    <div style="margin-bottom:1.2rem; color:#FF3B3F; font-weight:600; font-size:1.1rem; display:flex; flex-wrap:wrap; gap:1.2rem; align-items:center;">
        <span><span style="color:#fff;">📅</span> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</span>
        <span><span style="color:#fff;">🕒</span> {{ $event->time }}</span>
        <span><span style="color:#fff;">📍</span> {{ $event->place }}</span>
    </div>
    <div style="margin-bottom:1.5rem; color:#bbb; font-size:1.08rem;">
        <strong style="color:#FF3B3F;">Dirección:</strong> {{ $event->place }}
    </div>
    <div style="margin-bottom:2.2rem; color:#fff; font-size:1.13rem; line-height:1.7; background:#232323; border-radius:12px; padding:1.2rem 1rem; box-shadow:0 1px 8px #FF3B3F11;">
        {{ $event->description }}
    </div>
    @if(session('success'))
        <div class="alert alert-success" style="background:#232323; color:#4ade80; border:1.5px solid #4ade80; border-radius:8px; padding:1rem; margin-bottom:1rem;">{{ session('success') }}</div>
    @endif
    @if($event->show_register_button == 1 || $event->show_register_button === true || $event->show_register_button === '1')
        <button id="toggle-form" class="btn" style="background:#FF3B3F; color:#fff; border-radius:25px; padding:0.8rem 2rem; font-weight:600; border:none; margin-bottom:1.2rem; font-size:1.1rem; box-shadow:0 2px 8px #FF3B3F33; transition:background 0.2s;">Inscribirse al evento</button>
        <form id="register-form" action="{{ route('event.register', $event->id) }}" method="POST" style="display:none; background:#232323; border-radius:14px; padding:2rem 1.5rem; box-shadow:0 1px 8px #FF3B3F22; margin-bottom:1.2rem;">
            @csrf
            <div class="form-group" style="margin-bottom:1.2rem;">
                <label for="name" style="color:#FF3B3F; font-weight:600;">Nombre</label>
                <input type="text" name="name" id="name" class="form-input" required style="width:100%; padding:0.7rem; border-radius:8px; border:none; background:#181818; color:#fff; margin-top:0.3rem;">
            </div>
            <div class="form-group" style="margin-bottom:1.2rem;">
                <label for="email" style="color:#FF3B3F; font-weight:600;">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-input" required style="width:100%; padding:0.7rem; border-radius:8px; border:none; background:#181818; color:#fff; margin-top:0.3rem;">
            </div>
            <div class="form-group" style="margin-bottom:1.2rem;">
                <label for="phone" style="color:#FF3B3F; font-weight:600;">Teléfono (opcional)</label>
                <input type="text" name="phone" id="phone" class="form-input" style="width:100%; padding:0.7rem; border-radius:8px; border:none; background:#181818; color:#fff; margin-top:0.3rem;">
            </div>
            <button type="submit" class="btn" style="background:#FF3B3F; color:#fff; border-radius:25px; padding:0.7rem 1.5rem; font-weight:600; font-size:1.08rem; border:none; box-shadow:0 2px 8px #FF3B3F33;">Enviar inscripción</button>
        </form>
    @endif
    <a href="/church/public" class="btn btn-outline" style="margin-top:1.5rem; border:2px solid #FF3B3F; color:#FF3B3F; background:transparent; border-radius:25px; padding:0.7rem 1.5rem; font-weight:600;">Volver al inicio</a>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('toggle-form');
    const form = document.getElementById('register-form');
    btn.addEventListener('click', function() {
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });
});
</script>
@endsection

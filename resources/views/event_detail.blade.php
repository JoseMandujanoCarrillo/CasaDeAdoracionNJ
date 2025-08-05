@extends('layouts.app')
@section('content')
<div class="container" style="max-width:700px; margin:2.5rem auto; background:var(--glass-bg); border-radius:18px; box-shadow:var(--shadow-lg); border:1.5px solid var(--glass-border); padding:2.5rem 2rem 2rem 2rem; color:var(--text-primary);">
    <h1 style="color:var(--primary-color); font-size:2.3rem; font-weight:700; margin-bottom:0.7rem; letter-spacing:0.5px; font-family:'Lora',serif; background:rgba(35,35,35,0.7); border-radius:12px; padding:0.7rem 1rem; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);">{{ $event->name }}</h1>
    <div style="margin-bottom:1.2rem; color:var(--primary-color); font-weight:600; font-size:1.1rem; display:flex; flex-wrap:wrap; gap:1.2rem; align-items:center;">
        <span style="background:rgba(35,35,35,0.7); border-radius:8px; padding:0.3rem 0.7rem; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);"><span style="color:var(--text-primary);">📅</span> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</span>
        <span style="background:rgba(35,35,35,0.7); border-radius:8px; padding:0.3rem 0.7rem; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);"><span style="color:var(--text-primary);">🕒</span> {{ $event->time }}</span>
        <span style="background:rgba(35,35,35,0.7); border-radius:8px; padding:0.3rem 0.7rem; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);"><span style="color:var(--text-primary);">📍</span> {{ $event->place }}</span>
    </div>
    <div style="margin-bottom:1.5rem; color:#bbb; font-size:1.08rem;">
        <span style="background:rgba(35,35,35,0.7); border-radius:8px; padding:0.3rem 0.7rem; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);"><strong style="color:var(--primary-color);">Dirección:</strong> {{ $event->place }}</span>
    </div>
    <div style="margin-bottom:2.2rem; color:var(--text-primary); font-size:1.13rem; line-height:1.7; background:#232323; border-radius:12px; padding:1.2rem 1rem; box-shadow:var(--shadow-sm); border:1.5px solid var(--border-color);">
        <span style="background:rgba(35,35,35,0.5); display:block; border-radius:12px; padding:1.2rem 1rem;">{{ $event->description }}</span>
    </div>
    @if(session('success'))
        <div class="alert alert-success" style="background:rgba(35,35,35,0.5); color:#4ade80; border:1.5px solid #4ade80; border-radius:8px; padding:1rem; margin-bottom:1rem;">{{ session('success') }}</div>
    @endif
    @if($event->show_register_button == 1 || $event->show_register_button === true || $event->show_register_button === '1')
        <button id="toggle-form" class="btn" style="background:var(--primary-color); color:var(--text-primary); border-radius:25px; padding:0.8rem 2rem; font-weight:600; border:none; margin-bottom:1.2rem; font-size:1.1rem; box-shadow:var(--shadow-sm); transition:background 0.2s;">Inscribirse al evento</button>
        <form id="register-form" action="{{ route('event.register', $event->id) }}" method="POST" style="display:none; background:rgba(35,35,35,0.5); border-radius:14px; padding:2rem 1.5rem; box-shadow:var(--shadow-sm); border:1.5px solid var(--border-color); margin-bottom:1.2rem;">
        <style>
        #register-form .form-input {
            border: 2px solid #f33350 !important; /* rojo claro */
            box-shadow: 0 2px 8px rgba(255, 107, 129, 0.796);
        }
        #register-form .form-input:focus {
            border-color: #ff3b3f !important;
            outline: none;
        }
        </style>
            @csrf
            <div class="form-group" style="margin-bottom:1.2rem;">
                <label for="name" style="color:var(--primary-color); font-weight:600;">Nombre</label>
                <input type="text" name="name" id="name" class="form-input" required style="width:100%; padding:0.7rem; border-radius:8px; border:1.5px solid var(--border-color); background:#232323; color:var(--text-primary); margin-top:0.3rem;">
            </div>
            <div class="form-group" style="margin-bottom:1.2rem;">
                <label for="email" style="color:var(--primary-color); font-weight:600;">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-input" required style="width:100%; padding:0.7rem; border-radius:8px; border:1.5px solid var(--border-color); background:#232323; color:var(--text-primary); margin-top:0.3rem;">
            </div>
            <div class="form-group" style="margin-bottom:1.2rem;">
                <label for="phone" style="color:var(--primary-color); font-weight:600;">Teléfono (opcional)</label>
                <input type="text" name="phone" id="phone" class="form-input" style="width:100%; padding:0.7rem; border-radius:8px; border:1.5px solid var(--border-color); background:#232323; color:var(--text-primary); margin-top:0.3rem;">
            </div>
            <button type="submit" class="btn" style="background:var(--primary-color); color:var(--text-primary); border-radius:25px; padding:0.7rem 1.5rem; font-weight:600; font-size:1.08rem; border:none; box-shadow:var(--shadow-sm);">Enviar inscripción</button>
        </form>
    @endif
    <a href="/church/public" class="btn btn-outline" style="margin-top:1.5rem; border:2px solid var(--primary-color); color:var(--primary-color); background:transparent; border-radius:25px; padding:0.7rem 1.5rem; font-weight:600;">Volver al inicio</a>
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

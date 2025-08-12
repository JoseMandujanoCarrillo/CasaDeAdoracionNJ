@extends('layouts.app')
@section('content')
<div class="container about-page" style="max-width:900px; margin:2.5rem auto; background:var(--glass-bg); border-radius:18px; box-shadow:var(--shadow-lg); border:1.5px solid var(--glass-border); padding:2.5rem 2rem 2rem 2rem;">
    <h1 class="about-title-main">Sobre Nosotros</h1>
    <div class="about-flex">
        <div class="about-img-wrapper">
            <img src="../resources/Images/Image1.png" alt="Nuestra Iglesia" class="about-img">
        </div>
        <div class="about-text-block">
            <h2 class="about-title">Casa de Adoración NJ</h2>
            <p class="about-description">Casa de Adoración NJ es una comunidad cristiana dedicada a compartir el amor de Dios a través de la adoración, la enseñanza bíblica y el servicio a nuestra comunidad. Creemos en crear un ambiente donde todos puedan encontrar esperanza, sanidad y un sentido de pertenencia.</p>
            <p class="about-description">Desde nuestra fundación, nos hemos comprometido a ser una luz en New Jersey, ofreciendo programas y ministerios que impactan positivamente a familias, jóvenes y a toda la comunidad.</p>
            <p class="about-description">Nuestra visión es ser un lugar donde cada persona pueda crecer en su fe, descubrir su propósito y experimentar el poder transformador de Dios. Nos esforzamos por ser una iglesia relevante, acogedora y apasionada por servir a los demás.</p>
            <p class="about-description">Te invitamos a ser parte de nuestra familia y a vivir una experiencia de fe auténtica, comunidad y esperanza.</p>
        </div>
    </div>
    <div class="about-section" style="margin-top:2.5rem;">
        <h3 class="about-subtitle">Nuestros Valores</h3>
        <ul class="about-list">
            <li><b>Adoración:</b> Honramos a Dios con pasión y excelencia.</li>
            <li><b>Comunidad:</b> Fomentamos relaciones auténticas y apoyo mutuo.</li>
            <li><b>Servicio:</b> Amamos y servimos a nuestra ciudad y al mundo.</li>
            <li><b>Enseñanza:</b> Creemos en la Palabra de Dios como fundamento para la vida.</li>
            <li><b>Esperanza:</b> Proclamamos el mensaje de fe y restauración en Cristo.</li>
        </ul>
    </div>
    <div class="about-section" style="margin-top:2.5rem;">
        <h3 class="about-subtitle">Jesús es para todos</h3>
        <p class="about-description">
            Creemos que Jesús es para todas las personas. Eso significa que Él es para ti.<br>
            Tu pasado no te descalifica. Las circunstancias actuales no limitan el deseo de Dios de obrar en y a través de tu vida.<br>
            Y su futuro no está dictado por su registro, su reputación, o sus reservas. Dondequiera que estés hoy, importas a Dios y hay un lugar para ti en su familia.<br>
            Nuestra visión es ser un lugar donde personas de todos los ámbitos de la vida se reúnen para encontrar esperanza, experimentar comunidad y vivir con propósito.<br>
            Entonces, si creciste en la iglesia o nunca lo has estado, te invitamos a venir tal como estás a experimentar la “iglesia” de una manera nueva.<br>
            Si eso te suena bien, entonces ¡Nos encantaría conocerte pronto!
        </p>
    </div>
    <div class="about-section" style="margin-top:2.5rem;">
        <h3 class="about-subtitle">¿Quién es el Espíritu Santo?</h3>
        <p class="about-description">
            Descendió en forma de paloma, pero no es un ave; Apareció en forma de llama ardiente sobre la cabeza de los discípulos, pero no es fuego. Se siente como un fuerte soplo, pero no es viento. Embriaga como el licor, pero no es una bebida. Nos sacia y refresca, pero no es agua. Él sana, liberta y hace milagros, pero no es un simple poder. Él ríe, él llora, él te abraza, te guía y te transforma. Espíritu Santo no es "algo“, es Alguien.<br><br>
            Espíritu es DIOS. Es su mismo espíritu relacionándose con nosotros.<br>
            <b>Juan 16:13</b>
        </p>
        <p class="about-description">
            ¡Siga leyendo para obtener información útil y algunos consejos para planificar su primera visita a FCC, y háganos saber cómo podemos ayudarlo!<br><br>
            Porque el Espíritu de Dios no nos hace cobardes. Al contrario, nos da poder para amar a los demás, y nos fortalece para que podamos vivir una buena vida cristiana.<br><br>
            Sabemos que Dios obra en toda situación para el bien de los que lo aman, los que han sido llamados por Dios de acuerdo a su propósito.<br>
            <b>Romanos 8:28</b>
        </p>
        <p class="about-description">
            En Casa de Adoración NJ tenemos la visión de ser un lugar donde las personas de todos los ámbitos de la vida se reúnan para encontrar esperanza, experimenten el amor de una comunidad y vivan con propósito.<br><br>
            Así que, si creciste en la iglesia o nunca has estado en ella, te invitamos a venir con nosotros para que experimentes la "Iglesia“ de una manera nueva y diferente.<br><br>
            Si esto suena bien para ti, entonces ¡Nos encantaría conocerte!
        </p>
    </div>
    <div class="about-section" style="text-align:center; margin-top:2.5rem;">
        <a href="/church/public#nosotros" class="btn about-back">Volver al inicio</a>
    </div>
</div>
@endsection

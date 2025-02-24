@component('mail::message')
# ¡Bienvenido a Mesa YA, {{ $user->name }}! 🎉

Gracias por registrarte en **Mesa YA**, la mejor plataforma para encontrar y reservar restaurantes.

Para completar tu registro, necesitamos que confirmes tu dirección de correo electrónico. Haz clic en el botón de abajo:

@component('mail::button', ['url' => $verificationUrl, 'color' => 'success'])
Confirmar mi cuenta
@endcomponent

Si no solicitaste esta cuenta, ignora este mensaje. 

---

Si el botón no funciona, copia y pega este enlace en tu navegador:
[{{ $verificationUrl }}]({{ $verificationUrl }})

Gracias por confiar en nosotros,  
**El equipo de Mesa YA** 🍽️
@endcomponent

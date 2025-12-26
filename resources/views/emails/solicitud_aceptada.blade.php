<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud aceptada</title>
</head>
<body>
    @php
        $logoPath = public_path('img/157973.png');
        $logoSrc = file_exists($logoPath)
            ? ('data:image/png;base64,' . base64_encode(file_get_contents($logoPath)))
            : asset('img/157973.png');
    @endphp
    <div style="background:#f5f7fa; padding:24px;">
        <div style="max-width:640px; margin:0 auto;">
            <div style="text-align:center; padding:18px 12px;">
                <img src="{{ $logoSrc }}" alt="Roceval" style="max-width:160px; height:auto; display:inline-block;">
            </div>

            <div style="background:#ffffff; border:1px solid #e6e9ef; border-radius:12px; overflow:hidden;">
                <div style="padding:18px 20px; background:#0d47a1; color:#ffffff; font-family:Arial, Helvetica, sans-serif;">
                    <div style="font-size:16px; font-weight:700;">Solicitud aceptada con éxito</div>
                    <div style="font-size:12px; opacity:0.9; margin-top:2px;">Transporte y Comercializadora Roceval S.A.S</div>
                </div>

                <div style="padding:20px; font-family:Arial, Helvetica, sans-serif; color:#111827;">
                    <p style="margin:0 0 12px 0; font-size:14px;">Hola <strong>{{ $solicitud->nombre_completo }}</strong>,</p>

                    <p style="margin:0 0 12px 0; font-size:14px;">
                        Te informamos que tu solicitud ha sido <strong>aceptada</strong>.
                    </p>

                    <div style="background:#f8fafc; border:1px solid #e5e7eb; border-radius:10px; padding:12px 14px; margin:14px 0;">
                        <div style="font-size:13px; font-weight:700; margin-bottom:6px;">Resumen</div>
                        <div style="font-size:13px; color:#374151;">
                            <div><strong>Origen:</strong> {{ $solicitud->ciudad_origen }} ({{ $solicitud->pais_origen }})</div>
                            <div><strong>Destino:</strong> {{ $solicitud->ciudad_destino }} ({{ $solicitud->pais_destino }})</div>
                        </div>
                    </div>

                    <p style="margin:0 0 6px 0; font-size:14px;">
                        En breve te enviaremos la cotización correspondiente.
                    </p>
                    <p style="margin:0; font-size:14px;">
                        Si tienes alguna duda, puedes responder a este correo.
                    </p>
                </div>

                <div style="padding:14px 20px; background:#f3f4f6; font-family:Arial, Helvetica, sans-serif; color:#6b7280; font-size:12px;">
                    <div>Este es un mensaje automático. Por favor no compartas información sensible.</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

# NDD_send_connect

**NDD_send_connect** es una librería PHP para la comunicación con la API de Send de NDDInfosystems. Permite enviar correos electrónicos utilizando una API key o un token a cierta url.

## Requisitos

- PHP 5.6 o superior
- cURL

## Instalación

Puedes instalar esta librería utilizando Composer. Primero, asegúrate de tener Composer instalado y luego ejecuta el siguiente comando:

```bash
composer require angelpm9506/sendgridapiinterface
```

## Inicialización

Para utilizar la librería, primero debes inicializar la clase `NDD_send_connect` con tu API key en caso de tener php 8.0 en adelante:

```PHP
require 'vendor/autoload.php';

use NDD_send_connect\NDD_send_connect;

$apikey = 'tu-api-key || Token';
$urlBase = "https://baseurle.test"; // url a que se comunicara
$isToken = false; // si es un token en lugar deuna apikey lo que se esta implementando
$sendConnect = new NDD_send_connect($apikey, $urlBase, isToken);
```

Si tienes una versión de php inferior a la 8.0 tienes que usar la clase `NDD_send_connect_php56` ya que esta implementa los métodos necesarios para versiones de php inferiores a la 8.0:

```PHP
require 'vendor/autoload.php';

use NDD_send_connect_php56\NDD_send_connect_php56;

$apikey = 'tu-api-key || Token';
$urlBase = "https://baseurle.test"; // url a la que se comunicara
$isToken = false; // si es un token se coloca en true 
$sendConnect = new NDD_send_connect_php56($apikey, $urlBase, isToken);
```

## Enviar un correo electrónico

Puedes enviar un correo electrónico utilizando el método ``send_email`` o ``send_email_token``:

```PHP
$from = 'correoOrigen@example.com';
$to = 'destinatario@example.com';
$cc = 'concopiaa@example.com'; // opcional y pueder ser null
$bcc = 'concopiaoculta@example.com'; // opcional y pueder ser null
$subject = 'Asunto del correo';
$html = '<p>Contenido del correo en HTML</p>';
$text = 'Contenido del correo en texto plano';

$responseByApikey = $sendgrid->send_email($from, $to, $subject, $cc, $bcc, $html, $text);
$responseByToken = $sendgrid->send_email_token($from, $to, $subject, $cc, $bcc, $html, $text);

print_r($responseByApikey);
print_r($responseByToken);
```
Dependiendo del caso se debe de especificar si se usa una apikey o un token ya que hay sutiles diferencias.

## Métodos disponibles

``set_url($url)``: Establece una nueva URL base.

``set_defaultUrl()``: Restablece la URL base por defecto.

``get_url()``: Obtiene la URL base actual.

``set_apikey($apikey, $isToken = false)``: Establece una nueva API key.

``send_email($from, $to, $subject, $cc = null, $bcc = null, $html = null, $text = null)``: Envía un correo electrónico utilizando una API key.

``send_email_token($from, $to, $subject, $cc = null, $bcc = null, $html = null, $text = null)``: Envía un correo electrónico utilizando un token.

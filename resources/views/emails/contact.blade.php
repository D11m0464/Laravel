<x-mail::message>

{{$content}}

The body of your message.

<x-mail::button :url="''">
Nos visite
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>

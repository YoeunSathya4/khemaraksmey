@component('mail::message')
# Thank You {{ $data['name'] }} For Your Message
We will contact to you as soon as posible.





Thanks,<br>
{{ config('app.name') }}
@endcomponent

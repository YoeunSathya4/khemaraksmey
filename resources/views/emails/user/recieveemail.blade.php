@component('mail::message')
# Email From Client Name {{ $data['name'] }}



@component('mail::table')
| Topic         | Description   |
| ------------- |:-------------:|
| Name       	| {{ $data['name'] }} 	 | 
| Phone       	| {{ $data['phone'] }} |
| Email         | {{ $data['email'] }} 	 |
@endcomponent
# Content:
{{$data['message']}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

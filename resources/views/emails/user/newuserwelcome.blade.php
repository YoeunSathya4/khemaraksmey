@component('mail::message')
# Email From Client Name 



@component('mail::table')
| Topic         | Description   |
| ------------- |:-------------:|
| Name       	|  	 | 
| Phone       	| 	 |
| Email         |  	 |
@endcomponent
# Content:


Thanks,<br>
{{ config('app.name') }}
@endcomponent

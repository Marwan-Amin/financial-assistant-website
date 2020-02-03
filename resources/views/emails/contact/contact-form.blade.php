@component('mail::message')
# Thank You For Your message
<strong>Name</strong>{{$request->name}}
<strong>Email</strong>{{$request->email}}
<strong>Subject</strong>{{$request->subject}}
<strong>Message</strong>

{{$request->message}}
@endcomponent

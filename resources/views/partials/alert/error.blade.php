@if($errors->has())
    @foreach ($errors->all('<p>:message</p>') as $message)
        <div  class=" row alert alert-danger notificaciones" role="alert" >
        <button type="button" class="close pull-right" data-dismiss="alert">&times;</button>
            {!! $message !!}
        </div>
    @endforeach
@endif

@if (Session::has('message'))
    <div class="row alert alert-success notificaciones" role="alert">{{ Session::get('message') }}
		<button type="button" class="close pull-right" data-dismiss="alert" >&times;</button>
    </div>
@endif
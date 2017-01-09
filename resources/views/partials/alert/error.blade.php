@if($errors->has())
    <div  class="alert alert-danger" role="alert">
        <button type="button" class="close pull-right" data-dismiss="alert">&times;</button>
        @foreach ($errors->all('<p>:message</p>') as $message)
            {!! $message !!}
        @endforeach
    </div>
@endif

@if (Session::has('message'))
    <div class="alert alert-success" role="alert">{{ Session::get('message') }}
		<button type="button" class="close pull-right" data-dismiss="alert" >&times;</button>
    </div>
@endif
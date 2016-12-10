@if($errors->has())
    <div class='alert alert-danger'>
        @foreach ($errors->all('<p>:message</p>') as $message)
            {!! $message !!}
        @endforeach
        <button type="button" class="close" data-dismiss="alert" style="top: -20px; font-size: 20px; position: relative;color: white;">&times;</button>
    </div>
@endif

@if (Session::has('message'))
    <div class="alert alert-success">{{ Session::get('message') }}
		<button type="button" class="close" data-dismiss="alert" style="top: -20px  position: relative; color: white;">&times;</button>
    </div>
@endif
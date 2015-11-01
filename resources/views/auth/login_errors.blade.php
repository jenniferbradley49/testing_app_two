

<!-- resources/views/auth/login.blade.php -->

<!-- ><form method="POST" action="/auth/login">
-->
	{!! Form::open(); !!}
    {!! csrf_field() !!}
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div>
        {!! Form::label('email', 'Email'); !!}
        {!! // Form::email('email', Input::old('Email')); !!}
<!--          <input type="email" name="email" value="old email">
-->    </div>

    <div>
        {!! Form::label('password', 'Password'); !!}
        {!! Form::password('password'); !!}
<!--             <input type="password" name="password" id="password">
-->    </div>

    <div>
        {!! Form::label('remember', 'Remember me'); !!}
        {!! Form::checkbox('remember', Inpur::old('remember'); !!}
<!--     <input type="checkbox" name="remember"> Remember Me
-->    </div>

    <div>
        {!! Form::submit('Login'); !!}
<!--     <button type="submit">Login</button>
-->    </div>
    
<!-- </form> -->
	{!! Form::close() !!}
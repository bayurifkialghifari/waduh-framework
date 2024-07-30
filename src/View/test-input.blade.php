<form action="{{ url('/test-input') }}" method="post">
    {{-- {{ csrf_field() }} --}}
    <input type="text" name="email" value="{{ old('email') }}"> <br>
    @if(hasError('email'))
        {{ error('email') }} <br>
    @endif
    <input type="password" name="password"> <br>
    @if(hasError('password'))
        {{ error('password') }} <br>
    @endif
    <input type="submit">
</form>
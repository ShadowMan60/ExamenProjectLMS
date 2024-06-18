<a href="{{ url('/games')}}">back</a><br><br>
<form action="{{ url('/games')}}" method="post">
    @csrf
    <label for="GameName">Name of the Game</label><br>
    @error('name'); TEST @enderror
    <input type="text" name="name" id="GameName" value="{{ old('name') }}"><br><br>
    <input type="submit" value="Submit A New Game">
</form>
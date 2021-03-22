@extends('layouts.app')

@section('battlefield')
<div class="page">
<h1>Бойни Кораби</h1>

<table>
    <tr>
        <td></td>
        <td>A</td>
        <td>B</td>
        <td>C</td>
        <td>D</td>
        <td>E</td>
        <td>F</td>
        <td>G</td>
        <td>H</td>
        <td>I</td>
        <td>J</td>
        
    </tr>
    
    @foreach($data as $key => $chunk)
    <tr>
        <td>{{ $key+1 }}</td>
    
    @foreach($chunk as $cordinates => $value)
            <td class="field" cordinates="{{ $cordinates }}">{{ $value=='O'?'.':$value }}</td>
    @endforeach
    
    </tr>
    @endforeach
  
</table>
<div class="message">Битката Започва!!!</div>
<button class="newgame">Нова Игра</button>
</div>
@endsection
@foreach ($cost as $item)
    <h1>{{$item['code']}}</h1>
    <h1>{{$item['name']}}</h1>
    @foreach ($item['costs'] as $co)
        <h2>{{ $co['service'] }}</h2>
        <h2>{{ $co['description'] }}</h2>
        @foreach ($co['cost'] as $item)
            <h3>{{$item['value']}}</h3>
        @endforeach
    @endforeach
@endforeach
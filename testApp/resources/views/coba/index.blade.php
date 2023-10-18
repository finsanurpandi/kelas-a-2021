<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Document</h1>
    {{ $nama }} - {!! $alamat !!}
    <?=$nama?>
    <?php
        echo $alamat;
    ?>

    @if($nama == null)
        Nama tidak tersedia
    @else
        {{ $nama }}
    @endif

    @foreach ($fruits as $fruit)
        <br/>
        {{$fruit}} 
    @endforeach

    @for ($i = 0; $i < count($fruits); $i++)
        
    @endfor
    
    <form method="post" action="#">
        @csrf
        @method('patch')
    </form>

    @php
        $no=1;
    @endphp
    <x-alert type="info" message="Lorem ipsum dolor sit amet consectetur, adipisicing elit."/>

    <x-alertx type="danger" message="Lorem ipsum dolor sit amet consectetur, adipisicing elit."/>
    
    <x-badge color="yellow">
        <x-slot:header> BADGE </x-slot:header>
        Ini adalah Badgex
    </x-badge>
</body>
</html>
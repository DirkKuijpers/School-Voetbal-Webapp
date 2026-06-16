<x-base-layout>

<div class="page">

    <div class="hero">

        <!-- LEFT -->
        <div class="hero-left">

            <img src="{{ asset('img/logo-hero.png') }}" class="hero-logo" alt="">

            <h1>
                Speel, volg en win het toernooi
            </h1>

            <p>
                Bekijk wedstrijden, standen en schrijf je team in voor het grootste schoolvoetbal event.
            </p>

            <a href="{{ route('register') }}" class="btn">
                Inschrijven
            </a>

        </div>

        <!-- RIGHT -->
        <div class="hero-right">
            <img src="{{ asset('img/football.jpg') }}" alt="football">
        </div>

    </div>

</div>

</x-base-layout>

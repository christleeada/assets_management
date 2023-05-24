<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            About Us
        </h2>
    </x-slot>

    <div class="about-section" style="text-align: center;">
        <h1>About Us</h1>
        <p style="text-align: justify;">
            We understand the challenges that our department face in maintaining their supplies and resources, and we're here to help. Our mission is to provide our department with the tools and support they need to optimize their asset management processes, reduce costs, and ensure they have everything they need to deliver the best education possible.
        </p>
    </div>

    <div class="team-section" style="text-align: center;">
    <h2>Our Team</h2>
    <div class="row col-md-12 justify-content-center">
        <div class="column col-md-4">
            <div class="card">
                <img src="{{ asset('images/about_us/christlee.jpg')}}" alt="Christ Lee Ada" class="rounded d-block mx-auto" style="width: 200px; height: 200px;">
                <div class="container col-md-3" style="text-align: center;">
                    <h3>Christ Lee Ada</h3>
                    <p class="title">Frontend/Backend Developer</p>
                    <p class="email"><a href="mailto:christlee.ada@foundationu.com">christlee.ada@foundationu.com</a></p>
                </div>
            </div>
        </div>
        
        <div class="column col-md-4">
            <div class="card">
                <img src="{{ asset('images/about_us/khristine.jpg')}}" alt="Khristine Dulaca" class="rounded d-block mx-auto" style="width: 200px; height: 200px;">
                <div class="container col-md-3" style="text-align: center;">
                    <h3>Khristine Dulaca</h3>
                    <p class="title">Design/Documentation</p>
                    <p class="email"><a href="mailto:khristine.dulaca@foundationu.com">khristine.dulaca@foundationu.com</a></p>
                </div>
            </div>
        </div>
        <div class="column col-md-4">
            <div class="card">
                <img src="{{ asset('images/about_us/mily.jpg')}}" alt="Mily Jean Catador" class="rounded d-block mx-auto" style="width: 200px; height: 200px;">
                <div class="container col-md-3" style="text-align: center;">
                    <h3>Mily Jean Catador</h3>
                    <p class="title">Documentation</p>
                    <p class="email"><a href="mailto:milyjean.catador@foundationu.com">milyjean.catador@foundationu.com</a></p>
                </div>
            </div>
        </div>
    </div>
</div>




    <style>
        .row .column {
            margin-bottom: 20px;
        }
    </style>
</x-app-layout>
@include('layouts.scripts.messages-script')

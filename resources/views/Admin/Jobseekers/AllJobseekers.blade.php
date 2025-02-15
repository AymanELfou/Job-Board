<x-app-layout>
    <x-slot name="header">
        <h2 class="h1 text-3xl text-gray-800 leading-tight" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <!-- Button to add a new job -->
    <div class="text-center">
        <a href="{{ route('jobseeker.index') }}" class="button-77 mt-2">
            <h5>Job seeker</h5> 
        </a>

        <a href="{{ route('employers.index') }}" class="button-78">
            <h5>Employers</h5> 
        </a>
    </div>

    {{-- <div class="mx-5 col-2 mt-1">
        <a href="{{ route('jobseeker.create') }}" class="btn  d-flex align-items-center text-dark font-semibold  px-3 p-3 " style="background-color: #FFD700; border-radius: 20px; ">
            <img src="{{ asset('imgs/plus.png') }}" alt="Add" class="me-2" style="width: 30px; height: 30px;">
            <h5>Add Jobseeker</h5>
        </a>
    </div> --}}

    <!-- Search Bar and Button aligned in the same row -->
    <div class="container col-12 col-md-6 col-lg-4 mt-5">
        <form action="{{ route('jobseeker.search') }}" method="GET" class="d-flex align-items-center mt-4">
            <input class="form-control me-2 search-input flex-grow-1" name="fullName" type="search" placeholder="Name" aria-label="Search">
            <button class="btn search-btn flex-shrink-0" type="submit" style="background-color: rgba(245, 16, 0, 0.705); border-radius: 10px; color: white">Search</button>
        </form>
    </div>

    <!-- JobSeeker List Component -->
    <section class="our-webcoderskull">
        <div class="container">
            <div class="row mt-5"></div>
            <ul class="row">
                @include('incs.alert') 
                @foreach($Jobseekers as $jobseeker)
                <li class="col-12 col-md-6 col-lg-4">
                    <div class="cnt-block">
                        <figure><img src="http://www.webcoderskull.com/img/team4.png" class="img-responsive" alt=""></figure>
                        <h3>{{ $jobseeker['fullName'] }}</h3>
                        <p>Freelance Web Developer</p>
                        <p class="pd"><b>Contact information:</b> {{ $jobseeker['contact_information'] }}</p>
                        <p class="pd"><b>Skills:</b> {{ $jobseeker['competences'] }}</p>
                        <p class="pd"><b>Education:</b> {{ $jobseeker['education'] }}</p>
                        <p class="pd"><b> Experience:</b> {{ $jobseeker['experience'] }}</p>
                        <p class="pd">Resume: {{ $jobseeker['resume'] }}</p>

                        <div class="d-flex justify-content-center mt-2">
                           {{--  <a href="{{ route('jobseeker.edit', $jobseeker->id) }}" class="btn col-3">
                                <img src="{{ asset('imgs/penc.png') }}" alt="modify" style="width: 40px; height: 40px;" />
                            </a> --}}

                            <form action="{{ route('jobseeker.destroy', $jobseeker->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete?')">
                                    <img src="{{ asset('imgs/square_14034319.png') }}" alt="delete" style="width: 40px; height: 40px;" />
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="mt-4 d-flex justify-content-center">
                {{ $Jobseekers->links() }}
            </div>
        </div>
    </section>
</x-app-layout>

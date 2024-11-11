<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    

<!-- Button to add a new job -->
<div class="text-center">
    <a href="{{ route('jobseeker.index') }}" class=" button-77 mt-5">
       <h5>Job seeker</h5> 
    </a>

    <a href="{{ route('employers.index') }}" class=" button-78">
        <h5>Employers</h5> 
    </a>
</div>









<div class="d-flex justify-content-start  mt-2">
    <a href="{{ route('jobseeker.create') }}" class="btn btn-primary add-job-btn d-flex align-items-center text-white font-semibold py-2 px-3 rounded">
        <img src="{{ asset('imgs/plus.png') }}" alt="Add" class="me-2" style="width: 30px; height: 30px;">
       <h5>Add Jobseeker</h5>
    </a>
</div>



    

    <!-- JobSeeker List Component -->
    
    <section class="our-webcoderskull">
        <div class="container">
            @foreach($Jobseekers as $jobseeker)
          <div class="row mt-5"></div>
          <ul class="row">
            <li class="col-12 col-md-6 col-lg-4">
                <div class="cnt-block " >
                  <figure><img src="http://www.webcoderskull.com/img/team4.png" class="img-responsive" alt=""></figure>
                  <h3><a href="http://www.webcoderskull.com/">{{ $jobseeker['fullName'] }}</a></h3>
                  <p>Freelance Web Developer</p>
                  
                    <p class="pd">Personel information:  {{ $jobseeker['contact_information'] }}</p>
                    <p class="pd">Skills:  {{ $jobseeker['competences'] }} </p>
                    <p class="pd">Education:  {{ $jobseeker['education'] }}</p>
                    <p class="pd">Experience:  {{ $jobseeker['experience'] }}</p>
                    <p class="pd">Resume:  {{ $jobseeker['resume'] }}</p>


                    <div class="d-flex justify-content-center mt-2">
                        <a href="jobseeker/{{ $jobseeker->id }}/edit" class="btn">
                            <img src="{{ asset('imgs/penc.png') }}" alt="modify" style="width: 40px; height: 40px;"  />
                        </a>

                        <form action="{{ route('jobseeker.destroy', $jobseeker->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete?')">
                                <img src="{{ asset('imgs/square_14034319.png') }}" alt="delete" style="width: 40px; height: 40px;"  />
                            </button>
                        </form
                    </div>
                        
                    
                  
                </div>
            </li>
          </ul>
          @endforeach
        </div>
        
    </section>


    

</x-app-layout>

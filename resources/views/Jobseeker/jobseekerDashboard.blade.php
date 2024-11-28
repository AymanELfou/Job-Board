<x-apps.app-jobseeker>
    <x-slot name="header">
        <h2 class="h2 text-dark" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body text-dark">
                    {{ __("You're logged in As Job Seeker!") }}
                </div>
            </div>
        </div>
    </div>



<style>
    body {
  background-color: #f8f9fa;
}

.card {
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.card-title {
  font-weight: 700;
  margin-bottom: 1rem;
}

.list-group-item {
  border: none;
  padding: 1rem;
  font-size: 1rem;
  color: #343a40;
}

.list-group-item:hover {
  background-color: #f1f3f5;
}

</style>

















    <div class="container my-5">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h1 class="card-title">Jobs</h1>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Chef de projet en centre d'appels — myopla al hoceima - " supervis...</li>
                  <li class="list-group-item">CS & Production Planning Analyst</li>
                  <li class="list-group-item">Responsable Administratif et Financier (RAF) - Al Hoceima</li>
                  <li class="list-group-item">Restaurant Manager</li>
                  <li class="list-group-item">SC Operational Excellence Responsible</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      







</x-apps.app-jobseeker>

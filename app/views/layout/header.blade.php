<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('/customers/list_customers')}}">Home</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button class="btn btn-dark" data-bs-toggle="dropdown" aria-expanded="false">
                  <a href="{{route('customers/add_customers')}}" class="text-light link-offset-2 link-underline link-underline-opacity-0">Add customer</a>
                </button>
              </li>
            </ul>
          </div>
        </div>
      </nav>
</header>
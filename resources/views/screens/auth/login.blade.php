@include('layouts.partials.header', ['title' => 'Modul', 'page_heading' => 'Data Article'])
  <body class="overflow-hidden">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-5">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('loginError')) 
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="d-flex justify-content-center" >
                  <img height="100" src="{{ asset('img/logo.png') }}" alt="logo">
                </div>
                <main class="form-signin f-flex mt-3">
                  <h1 class="h3 mb-3 fw-bold text-center">Login Planetku</h1>
                    <form action="/login" method="POST">
                    @csrf
                    <div class="form-floating mb-2">
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" autofocus required id="email" value="{{ old('email') }}" placeholder="name@example.com">
                        <label for="email">Email address/Phone number</label>
                        @error('email')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required id="password" placeholder="Password">
                        <label for="password">Password</label>
                        @error('password')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button class="w-100 btn btn-lg" style="background: #8B9E70; color: #FFFFFF;" type="submit">Login</button>
                    </form>
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
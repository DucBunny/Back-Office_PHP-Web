@vite('resources/js/app.js')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</head>

<body>
    <section class="vh-100" style="background-color: #f2f3f5;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-4">
                    <div class="fs-2 text-center mb-3">Login</div>
                    <form action="{{ route('postLogin') }}" method="POST">
                        @csrf
                        <div style="background-color: #ffffff" class="px-3 pt-3 border rounded-3 shadow-sm">
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-2 gap-4">
                                    <label for="login_id" class="form-label m-0">Login ID</label>
                                    <span class="badge rounded-pill fw-medium"
                                        style="background-color: #11c48a">必須</span>
                                </div>

                                <input type="text" name="login_id" class="form-control" id="login_id"
                                    value="{{ old('login_id') }}">
                                @error('login_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div style="padding-bottom: 2.5rem">
                                <div class="d-flex align-items-center mb-2 gap-4">
                                    <label for="password" class="form-label m-0">Password</label>
                                    <span class="badge rounded-pill fw-medium"
                                        style="background-color: #11c48a">必須</span>
                                </div>

                                <input type="password" name="password" class="form-control" id="password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-end mt-3 w-100">
                            <button type="submit" style="background-color: #11c48a; width: 5rem"
                                class="btn text-white btn-custom-11c48a">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://chinese-fonts-cdn.deno.dev/packages/zhbtt/dist/字魂扁桃体/result.css' />

    <link rel="stylesheet" href="{{ asset('css/homePage.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-sm p-0 sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand m-0 p-0" href="">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 50px;">
                <h1>LearnLink</h1>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active d-block d-sm-none" href="">登入/註冊</a>
                    </li>
                    <li class="nav-item order-3 order-sm-1">
                        <a class="nav-link active" href="">找老師</a>
                    </li>
                    <li class="nav-item order-2 order-sm-2">
                        <a class="nav-link active" href="">成為老師</a>
                    </li>
                    <li class="nav-item order-1 order-sm-3">
                        <a class="nav-link active d-none d-sm-block" href="">登入/註冊</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <div class="row btn-container p-4 rounded-3" style="background-color: whitesmoke;">
            <div class="col-md-6 mb-3 text-center text-md-start">
                <a href="" class="btn btn-large d-block mx-auto ms-md-auto m-md-0">
                    我是學生
                </a>
            </div>
            <div class="col-md-6 mb-3 text-center text-md-end">
                <a href="" class="btn btn-large d-block mx-auto me-md-auto m-md-0">
                    我是老師
                </a>
            </div>
        </div>
    </main>

    <footer class="text-center text-lg-start text-muted pt-2">
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-chart-line me-3"></i>Lorem Ipsum
                        </h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.
                            Sed cursus ante dapibus diam.
                        </p>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Lorem ipsum dolor sit amet
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">AAAAAAAAAA</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">BBBBBBBBBBBBBB</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">CCCCCCCCCC</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">DDDDDDDDDDD</a>
                        </p>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Lorem ipsum dolor sit amet
                        </h6>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Lorem ipsum dolor
                        </h6>
                        <p><i class="me-3"></i> 1234 Lorem Ipsum St, Dolor Sit Amet, CA 94103</p>
                        <p><i class="me-3"></i> lorem@ipsum.com</p>
                        <p><i class="me-3"></i> (415) 123-4567</p>
                        <p><i class="me-3"></i> +1 (800) 987-6543</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center p-4 bg-dark text-white">
            Lorem Ipsum. All Rights Reserved.
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
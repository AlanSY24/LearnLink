<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://chinese-fonts-cdn.deno.dev/packages/zhbtt/dist/字魂扁桃体/result.css' />
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwyNzY3NzR8MHwxfGFsbHwxfHx8fHx8fHwxNjE3OTQ2NzY2&ixlib=rb-1.2.1&q=80&w=1080') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: rgba(248, 249, 250, 0.8) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand h1 {
            font-family: 'zihunbiantaoti';
            font-weight: 400;
            color: #333;
            margin: 0;
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
        }

        main {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px 0;
        }

        .content-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            margin: 0 auto;
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn-large {
            width: 100%;
            padding: 20px;
            font-size: 1.5em;
            height: 35vh;
            max-width: 400px;
            min-height: 150px;
            border: none;
            border-radius: 6px;
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            color: white;
            transition: background 0.3s ease;
        }

        .btn-large:hover {
            background: linear-gradient(135deg, #feb47b, #ff7e5f);
        }

        .btn-container {
            margin: 30px 0;
        }

        footer {
            background-color: rgba(248, 249, 250, 0.8);
            padding-top: 20px;
        }

        @media (max-width: 310px) {
            .site-logo {
                display: none;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm p-0 sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand m-0 p-0" href="">
                <img src="/images/logo.png" alt="圖片敗">
                <h1>LearnLink</h1>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
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

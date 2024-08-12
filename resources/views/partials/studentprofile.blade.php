<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>學生自我介紹</title>
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="file"] {
            padding: 0.5rem;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="file"]:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .alert-success {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border-radius: 4px;
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .profile-info {
            margin-bottom: 1rem;
        }

        .profile-info img {
            max-width: 200px;
            border-radius: 4px;
            display: block;
            margin-bottom: 1rem;
        }

        .profile-info a {
            display: inline-block;
            margin-top: 0.5rem;
            color: #007bff;
            text-decoration: none;
        }

        .profile-info a:hover {
            text-decoration: underline;
        }
        #ifr {
            display: none; /* 初始隱藏 iframe */
        }
    </style> -->
</head>
<body>
    <div class="container-SP">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- <h1>學生自我介紹與學歷</h1> -->
        <button id="btnAddResume">新增/編輯 學歷與自我介紹</button>


        @if($profile)
            <div>
                <div>
                    <h3>學歷 : <br></h3>
                    <p>{{ $profile->education }}</p>
                    <h3>自我介紹: <br></h3>
                    <p>{{ $profile->introduction }}</p>
                </div>
            </div>
        @endif
        
        <!-- 學歷自我介紹表單 -->
        <div id="formResume" class="container-resume hidden">
            <div class="container-form">
                <form action="{{ route('studentprofile.store') }}" method="POST">
                    @csrf

                    <div class="form-group-SP">
                        <label for="education">學歷</label><br>
                        <textarea id="education" name="education" rows="4" required>{{ old('education', $profile->education ?? '') }}</textarea>
                    </div>

                    <div class="form-group-SP">
                        <label for="introduction">自我介紹</label><br>
                        <textarea id="introduction" name="introduction" rows="4" required>{{ old('introduction', $profile->introduction ?? '') }}</textarea>
                    </div>

                    <button type="submit" class="btn-SP">儲存</button>
                    <button type="button" id="btnCloseResume" class="close-button">&times;</button>
                </form>
            </div>
        </div>



    </div>
</body>
<script>
    // <!-- script(履歷表)==================================================================================================== -->
        //按鈕:新增/編輯 學歷與自我介紹
        document.getElementById('btnAddResume').addEventListener('click', function () {
            document.getElementById('formResume').classList.remove('hidden');
        });
        //按鈕:右上角關閉X
        document.getElementById('btnCloseResume').addEventListener('click', function () {
            document.getElementById('formResume').classList.add('hidden');
        });

        //表單:新增(送出sumbit)
        document.getElementById('resumeFormData').addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            var file = formData.get('resumeFile');
            var reader = new FileReader();

            reader.onload = function (e) {
                var pdfBlob = new Blob([e.target.result], { type: 'application/pdf' });
                var url = URL.createObjectURL(pdfBlob);

                var resumeTitle = formData.get('resumeTitle');
                var photoFile = formData.get('resumePhoto');
                var photoReader = new FileReader();

                photoReader.onload = function (e) {
                    var photoURL = e.target.result;
                    var photoImg = document.createElement('img');
                    photoImg.src = photoURL;
                    photoImg.width = 100;

                    var dataContainer = document.createElement('div');
                    dataContainer.innerHTML = `
                        <div style="display: flex">
                            <button class="btn-delete">刪除</button>
                            <div>
                                <div>
                                    <h3>${resumeTitle}</h3>
                                    <div>${photoImg.outerHTML}</div>
                                    <embed src="${url}" type="application/pdf" width="250" height="200">   
                                </div>
                            </div>
                        </div>
                    `;
                    document.getElementById('areaResume').appendChild(dataContainer);
                    document.getElementById('formResume').classList.add('hidden');
                    this.reset();
                }.bind(this);
                photoReader.readAsDataURL(photoFile);
            }.bind(this);

            reader.readAsArrayBuffer(file);
        });

        //刪除功能
        document.getElementById('areaResume').addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-delete')) {
                if (confirm('請問是否確定刪除?')) {
                    e.target.parentElement.remove();
                }
            }
        });
        






</script>





</html>

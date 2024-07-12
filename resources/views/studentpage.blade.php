<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://chinese-fonts-cdn.deno.dev/packages/zhbtt/dist/字魂扁桃体/result.css' />
    <style>
        /* boos的CSS */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .btn-large {
            width: 100%;
            padding: 20px;
            font-size: 1.5em;
            height: 35vh;
            /* 設定按鈕高度為視窗高度的35% */
            max-width: 400px;
            min-height: 150px;
            border: 1px solid;
        }

        .btn-container {
            margin: 30px 0;
        }

        @media (max-width: 310px) {
            .site-logo {
                display: none;
            }
        }

        /* 自己寫的 */
        #jobForm {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        select[multiple] {
            height: 100px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        #districts-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .district-checkbox {
            display: flex;
            align-items: center;
        }

        .district-checkbox input {
            margin-right: 5px;
        }

        .form-group input[type="radio"] {
            margin-right: 5px;
        }

        .form-group input[type="radio"]+label {
            display: inline;
            margin-right: 15px;
        }

        .form-group input[type="tel"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .w-33 {
            width: 33%;
        }

        .w-45 {
            width: 45%;
        }

        .w-100 {
            width: 100%;
        }

        .fl {
            float: left;
        }

        .mr-5 {
            margin-right: 5%;
        }

        .hourly-rate-inputs {
            display: flex;
            align-items: center;
        }

        .hourly-rate-inputs input {
            width: 45%;
        }

        .hourly-rate-inputs span {
            margin: 0 5px;
        }

        .card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: 160px;
            /* height: 100px; */
        }

        .student-info {
            font-weight: bold;
        }

        .form-container {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="row">
            會員中心
        </div>
        <div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <div class="row">
            <div class="col-3 container border">
                <a class="row" href="">基本資料</a>
                <a class="row" href="">老師</a>
                <a class="row" href="">學生</a>
            </div>
            <div class="col-9 container border">
                <button id="addCardBtn">新增學生卡片</button>
                <div id="formContainer" class="form-container">
                    <form id="studentForm" action="{{ route('studentpage.store') }}" method="POST">
                    @csrf
                        <label for="name">姓名：</label>
                        <input type="text" id="name" name="name" required><br><br>
                        <label for="age">年齡：</label>
                        <input type="number" id="age" name="age" required><br><br>
                        <label for="gender">性別：</label>
                        <select id="gender" name="gender" required>
                            <option value="Male">男</option>
                            <option value="Female">女</option>
                        </select><br><br>
                        <button type="submit">確定新增</button>
                        <button id="CardBtn">取消</button>
                    </form>
                </div>

                <div id="cardContainer">
                    <!-- 卡片將會動態加入到這裡 -->
                    @foreach($students as $student)
        <div class="card d-inline-block">
            <div class="card-body">
                <h5 class="card-title">{{ $student->name }}</h5>
                <p class="card-text">年齡：{{ $student->age }}</p>
                <p class="card-text">性別：{{ $student->gender }}</p>
                
            </div>
        </div>
        @endforeach
                </div>



            </div>
        </div>

    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 按鈕點擊事件處理函數
            addCardBtn.addEventListener('click', function () {
                formContainer.style.display = 'block'; // 顯示表單
            });
            CardBtn.addEventListener('click', function () {
                formContainer.style.display = 'none';
            });




            // const addCardBtn = document.getElementById('addCardBtn');
            // const formContainer = document.getElementById('formContainer');
            // const studentForm = document.getElementById('studentForm');
            // const cardContainer = document.getElementById('cardContainer');


            // // 取得所有學生卡片資料並初始化顯示
            // fetch('c.php')
            //     .then(response => response.json())
            //     .then(cards => {
            //         cards.forEach(card => {
            //             const cardDiv = createCardElement(card);
            //             cardContainer.appendChild(cardDiv);
            //         });
            //     })
            //     .catch(error => console.error('Error fetching cards:', error));


            // // 表單提交事件處理函數
            // studentForm.addEventListener('submit', async function (event) {
            //     event.preventDefault();

            //     const name = document.getElementById('name').value;
            //     const age = document.getElementById('age').value;
            //     const gender = document.getElementById('gender').value;

            //     // 發送 POST 請求新增學生卡片
            //     const response = await fetch('api.php', {
            //         method: 'POST',
            //         headers: {
            //             'Content-Type': 'application/json'
            //         },
            //         body: JSON.stringify({ name, age, gender })
            //     });

            //     const newCard = await response.json();

            //     // 創建新的卡片元素並顯示
            //     const cardDiv = createCardElement(newCard);
            //     cardContainer.appendChild(cardDiv);

            //     // 清空表單並隱藏
            //     studentForm.reset();
            //     formContainer.style.display = 'none';
            // });

            // // 創建卡片元素
            // function createCardElement(cardData) {
            //     const cardDiv = document.createElement('div');
            //     cardDiv.className = 'card';

            //     const infoDiv = document.createElement('div');
            //     infoDiv.className = 'student-info';
            //     infoDiv.textContent = `姓名: ${cardData.name}, 年齡: ${cardData.age}, 性別: ${cardData.gender}`;

            //     cardDiv.appendChild(infoDiv);
            //     return cardDiv;
            // }
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link rel='stylesheet' href='https://chinese-fonts-cdn.deno.dev/packages/zhbtt/dist/字魂扁桃体/result.css' /> -->
    <style>
        /* boos的CSS */


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

        /* button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        } */

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
            width: 100px;
            height: 100px;
            position: relative;
            /* background-color: red; */
        }
        .card button{
            position: absolute;
            top: -10%;
            right: -10%;
        }
        .card h5, p{
            margin: 5px 0px;
        }

        .student-info {
            font-weight: bold;
        }

        .form-container {
            display: none;
            margin-top: 10px;
        }
        .d-inline-block{
            display:inline-block;
        }

    </style>
</head>
<body>
<div class="">
       
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
       
        <div class="">
            <button id="addCardBtn">新增學生卡片</button>
            <div id="formContainer" class="form-container">
                    <form id="studentForm" action="{{ route('studentpage.store') }}" method="POST">
                    @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <label for="children_name">姓名：</label>
                        <input type="text" id="children_name" name="children_name" required><br><br>
                        <label for="children_birthdate">生日：</label>
                        <input type="date" id="children_birthdate" name="children_birthdate" required><br><br>
                        <label for="children_gender">性別：</label>
                        <select id="children_gender" name="children_gender" required>
                            <option value="男">男</option>
                            <option value="女">女</option>
                        </select><br><br>
                        <button type="submit">確定新增</button>
                        <button id="CardBtn">取消</button>
                    </form>
            </div>
            <div id="cardContainer">
                <!-- 卡片將會動態加入到這裡 -->
                @foreach($children_card as $children_card)
                <div class="card d-inline-block">
                    <form action="{{ route('studentpage.destroy', $children_card->children_id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="deleteBtn">x</button>
                    </form>
                    <div>
                        <h5>{{ $children_card->children_name }}</h5>
                        <p>年齡：{{ $children_card->age }}</p>
                        <p>性別：{{ $children_card->children_gender }}</p>
                    </div>
                </div>
                @endforeach
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
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.deleteBtn').forEach(button => {
                button.addEventListener('click', function(event) {
                    if (!confirm('確定要刪除這張卡片嗎？')) {
                        event.preventDefault(); // 阻止表單提交
                    }
                });
            });
        });

    </script>
</body>
</html>
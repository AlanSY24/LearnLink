<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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
<div>
       
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
       
        <div>
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
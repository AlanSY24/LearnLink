<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">



    <title>找老師履歷</title>
    <style>
        
        .teacher_lists_container{
            display: flex;
        }

        .t_search{
            width: 35%;
            background-color: antiquewhite;
        }

        .t_lists{
            width: 60%;
            margin-left: 20px;
        }

        #t_lists_title{
            display: flex;
        }

        #t_lists_title h2{
            width: 70%;
        }

        #t_lists_title i{
            width: 30%;
            margin-top: 25px;
        }
        

    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var heartIcon = document.getElementById('heart');
            var isFavorite = false; // 初始收藏狀態為 false

            if (heartIcon) {
                heartIcon.addEventListener('click', function() {
                    if (!isFavorite) {
                        // 切換為實心愛心，紅色填充
                        heartIcon.classList.remove('far');
                        heartIcon.classList.add('fas');
                        heartIcon.style.color = '#ed1212';
                        isFavorite = true;
                        addToFavorites();
                    } else {
                        // 切換為空心愛心，紅色框框
                        heartIcon.classList.remove('fas');
                        heartIcon.classList.add('far');
                        heartIcon.style.color = 'red';
                        isFavorite = false;
                        removeFromFavorites();
                    }
                });
            }


            // 獲取縣市列表
            $.ajax({
                url: '/LearnLink/public/cities',
                type: 'GET',
                success: function(data) {
                    $('#city').empty();
                    $('#city').append('<option value="">請選擇縣市</option>');
                    $.each(data, function(index, city) {
                        $('#city').append('<option value="' + city.id + '">' + city.city + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

            // 當選擇縣市後，獲取對應的區域列表
            $('#city').change(function() {
                var selectedCityId = $(this).val();
                if (selectedCityId) {
                    $.ajax({
                        url: '/LearnLink/public/districts/' + selectedCityId,
                        type: 'GET',
                        success: function(data) {
                            $('#district').empty();
                            $('#district').append('<option value="">請選擇區域</option>');
                            $.each(data, function(index, district) {
                                $('#district').append('<option value="' + district.district_name + '">' + district.district_name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $('#district').empty();
                }
            });


            $('button').click(function() {
                // 获取用户输入的条件
                var subject = $('#subject').val();
                var minBudget = $('.min-input').val();
                var maxBudget = $('.max-input').val();
                var city = $('#city').val();
                var district = $('#district').val();
                var time = $('#time').val();

                // 发送 AJAX 请求到服务器
                $.ajax({
                    url: '/search', // 服务器端的搜索处理路由
                    method: 'GET',
                    data: {
                        subject: subject,
                        minBudget: minBudget,
                        maxBudget: maxBudget,
                        city: city,
                        district: district,
                        time: time
                    },
                    success: function(response) {
                        // 清空之前的结果
                        $('.t_lists').empty();

                        // 动态渲染每一个符合条件的结果
                        response.teachers.forEach(function(teacher) {
                            var teacherBlock = `
                                <div class="t_lists_block">
                                    <div id="t_lists_title">
                                        <h2>${teacher.title}</h2>
                                        <i id="heart" class="far fa-heart" style="color: red;"></i>
                                    </div>
                                    <div id="t_lists_subject">教學的科目：${teacher.subject}</div>
                                    <div id="t_lists_name">姓名：${teacher.name}</div>
                                    <div id="t_lists_gender">性別：${teacher.gender}</div>
                                    <div id="t_lists_place">上課預期地點：${teacher.place}</div>
                                    <div id="t_lists_time">上課預期時間：${teacher.time}</div>
                                    <div id="t_lists_price">上課預期時薪：${teacher.minPrice} - ${teacher.maxPrice}</div>
                                    <div id="t_lists_picture">大頭貼<img src="${teacher.picture}" alt="${teacher.name}"></div>
                                    <div id="t_lists_score">評分：${teacher.score}</div>
                                    <div id="t_lists_describe">關於老師的詳細描述：${teacher.description}</div>
                                    <div class="t_lists_buttons">
                                        <button class="button">老師履歷</button>
                                        <button class="button">聯絡老師</button>
                                    </div>
                                </div>
                            `;
                            $('.t_lists').append(teacherBlock);
                        });
                    }
                });
            });




        });

        function addToFavorites() {
            console.log('已將愛心添加到收藏夾');
            // 在這裡可以添加將愛心圖示加入到收藏夾的相應邏輯
        }

        function removeFromFavorites() {
            console.log('已將愛心從收藏夾移除');
            // 在這裡可以添加將愛心圖示從收藏夾移除的相應邏輯
        }


        
    </script>
</head>
<body>
    <h1>老師履歷列表</h1>

    <div class="teacher_lists_container">

        <div class="t_search">
        <h2>尋找老師</h2>
            <div class="t_search_subject">
                <p>請選擇想學的科目：</p>
                <select name="subject" id="subject">
                    <option value="0">請選擇</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="t_search_money"> 
            <p>請選擇上課預算(小時)：</p>
                <div class="price-input"> 

                    <div class="price-field"> 
                        <span>最低預算</span> 
                        <input type="number" class="min-input" value="100"> 
                    </div> 

                    <div class="price-field"> 
                        <span>最高預算</span> 
                        <input type="number" class="max-input" value="100000"> 
                    </div>
                    <!-- 要在加判斷，不可以低於 100 不可以高於 100000，min 不可以大於等於 max  -->
                </div>
            </div>

            <div class="t_search_place">
                <p>請選擇上課地點：</p>
                <label for="city">選擇縣市：</label>
                <select name="city" id="city">
                    <option value="">請選擇縣市</option>
                </select>

                <label for="district">選擇區域：</label>
                <select name="district" id="district">
                    <!-- 這裡會動態填充選項 -->
                </select>
            </div>

            <div class="t_search_time">
                <p>請選擇預期上課時間：</p>
                <select name="time" id="time">
                    <option value="0">請選擇上課時間</option>
                    <option value="1">上午</option>
                    <option value="2">下午</option>
                    <option value="3">晚上</option>
                    </select>
                </select>
            </div>

            <button>搜尋</button>

        </div>
        
        <div class="t_lists">

            <div class="t_lists_block">
                
                <div id="t_lists_title">
                    <h2>標題</h2>
                    <i id="heart" class="far fa-heart" style="color: red;"></i>
                </div>
                <div id="t_lists_subject">教學的科目：數學</div>
                <div id="t_lists_name">姓名：王XX</div>
                <div id="t_lists_gender">性別：女</div>
                <div id="t_lists_place">上課預期地點：台中北屯區</div>
                <div id="t_lists_time">上課預期時間：上午</div>
                <div id="t_lists_price">上課預期時薪：300 - 400</div><!-- 抓資料庫 min - max -->
                <div id="t_lists_picture">大頭貼</div>
                <div id="t_lists_score">評分</div><!-- 可以點選互動 -->
                <div id="t_lists_describe">關於老師的詳細描述：1. 有耐心 2. 有5年以上家教經驗</div>
                <div class="t_lists_buttons">
                    <button class="button">老師履歷</button><!-- 點選後跳出另一分頁 顯示老師詳細履歷 -->
                    <button class="button">聯絡老師</button><!-- 點選後跳出聊天室暫定 -->
                </div>
            </div>


        </div>




    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>找老師履歷</title>
    <style>
        .teacher_lists_container {
            display: flex;
        }

        .t_search {
            width: 35%;
            background-color: antiquewhite;
        }

        .t_lists {
            width: 60%;
            margin-left: 20px;
        }

        #t_lists_title {
            display: flex;
        }

        #t_lists_title h2 {
            width: 70%;
        }

        #t_lists_title i {
            width: 30%;
            margin-top: 25px;
            cursor: pointer;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var hearts = document.querySelectorAll('.heart-icon');

            hearts.forEach(function(heartIcon) {
                var isFavorite = false; // 初始收藏狀態為 false

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

        $(document).ready(function() {
            // 獲取城市列表
            $.ajax({
                url: '/LearnLink/public/cities',
                type: 'GET',
                success: function(data) {
                    $('#city').empty();
                    $('#city').append('<option value="">請選擇縣市</option>');
                    $.each(data, function(index, city) {
                        $('#city').append('<option value="' + city.id + '">' + city.city + '</option>');
                    });
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
                                $('#district').append('<option value="' + district.id + '">' + district.district_name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Districts AJAX Error:', error);
                        }
                    });
                }
            });
        });
        


    </script>
</head>
<body>
    <h1>老師履歷列表</h1>

    <div class="teacher_lists_container">

        <div class="t_search">
            <h2>尋找老師</h2>
            <div class="t_search_subject">
                <p>請選擇教學的科目：</p>
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
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>

                <label for="district">選擇區域：</label>
                <select name="district" id="district">
                    <option value="">請選擇區域</option>
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
            </div>
        </div>
        
        <div class="t_lists">
        @foreach ($teachers as $teacher)
                <div class="t_lists_block">
                    <div id="t_lists_title">
                        <h2>{{ $teacher->title }}</h2>
                        <i class="heart-icon far fa-heart" style="color: red;"></i>
                    </div>
                    <div id="t_lists_subject">
                        教學的科目：{{ $teacher->subject ? $teacher->subject->name : '未提供' }}
                    </div>
                    <div id="t_lists_name">
                        姓名：{{ $teacher->user ? $teacher->user->name : '未提供' }}
                    </div>
                    <div id="t_lists_gender">性別：未提供</div>

                    <div id="t_lists_place">
                        上課預期地點：{{ $teacher->city ? $teacher->city->city : '無城市資料' }}
                        @if($teacher->districts()->isNotEmpty())
                            @foreach ($teacher->districts() as $district)
                                {{ $district->district_name }}
                            @endforeach
                        @else
                            無區域資料
                        @endif
                    </div>

                    <div id="t_lists_time">
                        上課預期時間：{{ $teacher->available_time }}
                    </div>
                    <div id="t_lists_price">
                        上課預期時薪：{{ $teacher->hourly_rate }}
                    </div>
                    <div id="t_lists_picture">大頭貼</div>
                    <div id="t_lists_score">評分</div>
                    <div id="t_lists_describe">
                        關於老師的詳細描述：{{ $teacher->details }}
                    </div>
                    <div class="t_lists_buttons">
                        <button class="button">老師履歷</button>
                        <button class="button">聯絡老師</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>

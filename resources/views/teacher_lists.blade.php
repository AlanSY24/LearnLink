<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- 導入CSS-->
    <link rel="stylesheet" href="./css/teacher_lists.css">

    <script src="{{ asset('js/teacher_lists.js') }}"></script>
    <title>找老師履歷</title>

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
                        <input type="number" class="min-input" placeholder="最低預算：100"> 
                    </div> 
                    <div class="price-field"> 
                        <span>最高預算</span> 
                        <input type="number" class="max-input" placeholder="最高預算：100000"> 
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
                    <option value="1">早上</option>
                    <option value="2">下午</option>
                    <option value="3">晚上</option>
                </select>
            </div>

            <button id="searchButtont">搜尋</button>

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

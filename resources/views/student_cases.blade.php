<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>找學生案件</title>


    <!-- 導入CSS-->
    <link rel="stylesheet" href="./css/student_cases.css">

    <script src="{{ asset('js/student_cases.js') }}"></script>

</head>
<body>
    <h1>學生案件列表</h1>

    <div class="student_cases_container">
        <div class="s_search">
            <h2>尋找學生</h2>
            <div class="s_search_subject">
                <p>請選擇教學的科目：</p>
                <select name="subject" id="subject">
                    <option value="0">請選擇</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="s_search_money"> 
                <p>請選擇上課預期薪資(時薪)：</p>
                <div class="price-input"> 
                    <div class="price-field"> 
                        <span>最低預期</span> 
                        <input type="number" class="min-input" placeholder="最低預期：100"> 
                    </div> 
                    <div class="price-field"> 
                        <span>最高預期</span> 
                        <input type="number" class="max-input" placeholder="最高預期：100000"> 
                    </div>
                    <!-- 要在加判斷，不可以低於 100 不可以高於 100000，min 不可以大於等於 max  -->
                </div>
            </div>

            <div class="s_search_place">
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

            <div class="s_search_time">
                <p>請選擇預期上課時間：</p>
                <select name="time" id="time">
                    <option value="0">請選擇上課時間</option>
                    <option value="1">早上</option>
                    <option value="2">下午</option>
                    <option value="3">晚上</option>
                </select>
            </div>

            <div class="s_search_time">
                <label>請選擇預期上課時間(可複選):</label>
                <div>
                    <input type="checkbox" id="time_morning" value="早上">
                    <label for="time_morning">早上</label>
                </div>
                <div>
                    <input type="checkbox" id="time_afternoon" value="下午">
                    <label for="time_afternoon">下午</label>
                </div>
                <div>
                    <input type="checkbox" id="time_evening" value="晚上">
                    <label for="time_evening">晚上</label>
                </div>
            </div>


            <button id="searchButtons">搜尋</button>
        </div>
        
        <div class="s_cases">
            @foreach ($students as $student)
                <div class="s_cases_block">
                    <div id="s_lists_title">
                        <h2>{{ $student->title }}</h2>
                        <i class="heart-icon far fa-heart" style="color: red;"></i>
                    </div>
                    <div id="s_lists_subject">教學的科目：{{ $student->subject ? $student->subject->name : '未提供' }}</div>
                    <div id="s_lists_name">姓名：{{ $student->user->name }}</div>
                    <div id="s_lists_gender">性別：未提供</div>
                    <div id="t_lists_place">
                        上課預期地點：{{ $student->city ? $student->city->city : '無城市資料' }}
                        @if($student->districts()->isNotEmpty())
                            @foreach ($student->districts() as $district)
                                {{ $district->district_name }}
                            @endforeach
                        @else
                            無區域資料
                        @endif
                    </div>
                    <div id="s_lists_time">上課預期時間：{{ $student->available_time }}</div>
                    <div id="s_lists_price">上課預期時薪：{{ $student->hourly_rate_min }} - {{ $student->hourly_rate_max }}</div>
                    <div id="s_lists_picture">大頭貼</div>
                    <div id="s_lists_score">評分</div>
                    <div id="s_lists_describe">關於學生的詳細描述：{{ $student->details }}</div>
                    <div class="s_lists_buttons">
                        <button class="button">聯絡我</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>

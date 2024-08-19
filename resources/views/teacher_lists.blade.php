<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./css/teacher_lists.css">
    <link rel="stylesheet" href="./css/header_footer.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::id() }}">
    <script src="{{ asset('js/teacher_lists.js') }}"></script>
    <title>找老師履歷</title>
</head>

<body>
    <script src="{{asset('js/nav.js')}}"></script>
    <x-nav />
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

                <label for="districts">選擇區域：</label>
                <br>
                <div id="districts" class="districts_container">
                    <!-- 區域的 checkbox 會動態加到這裡 -->
                </div>
            </div>



            <div class="t_search_time">
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

            <button id="searchButtont">搜尋</button>

        </div>
        
        <div class="t_lists">
            @foreach ($teachers as $teacher)
                @if($teacher->status == 'published')
                    <div class="t_lists_block">
                        <div id="t_lists_title">
                            <h2>{{ $teacher->title }}</h2>
                            <i class="heart-icon far fa-heart" data-teacher-id="{{ $teacher->id }}" style="color: red;"></i>
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
                            <br>
                            <div class="districts-container">
                                @if($teacher->districts()->isNotEmpty())
                                    @foreach ($teacher->districts() as $district)
                                        {{ $district->district_name }}
                                        <br>
                                    @endforeach
                                @else
                                    無區域資料
                                @endif
                            </div>
                        </div>

                        <div id="t_lists_time">
                            上課預期時間：{{ $teacher->available_time }}
                        </div>
                        <div id="t_lists_price">
                            上課預期時薪：{{ $teacher->hourly_rate }}
                        </div>
                        <div id="t_lists_picture">
                            @if($teacher->profile && $teacher->profile->photo)
                                <img src="{{ route('teacher.photo', ['teacherId' => $teacher->user_id]) }}" alt="Profile Picture" style="width: 100px; height: auto;">
                            @else
                                <img src="{{ asset('storage/teacher_photos/default.png') }}" alt="Default Picture" style="width: 100px; height: auto;">
                            @endif
                        </div>
                        <div id="t_lists_score">
                            評分：
                            <span id="rating-{{ $teacher->id }}" data-teacher-id="{{ $teacher->id }}">計算中...</span>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    const teacherId = $('#rating-{{ $teacher->id }}').data('teacher-id');
                                    const ratingUrl = '{{ url("teacher/rating/") }}/' + teacherId;

                                    console.log('Teacher ID:', teacherId);
                                    console.log('Rating URL:', ratingUrl);

                                    $.ajax({
                                        url: ratingUrl,
                                        method: 'GET',
                                        success: function(data) {
                                            $('#rating-{{ $teacher->id }}').text(
                                                data.average_rating + ' (' + data.rating_count + ' 評分)'
                                            );
                                        },
                                        error: function(xhr, status, error) {
                                            console.error('Error fetching rating:', error);
                                            $('#rating-{{ $teacher->id }}').text('無法獲取評分');
                                        }
                                    });
                                });
                            </script>
                        </div>

                        <div id="t_lists_describe">
                            關於老師的詳細描述：{{ $teacher->details }}
                        </div>
                        <div class="t_lists_buttons">
                            <button class="teacher-resume-button" data-teacher-id="{{ $teacher->user_id }}">老師履歷</button>
                            <button class="button" id="contact" data-name="{{ $teacher->user ? $teacher->user->name : '未提供' }}" data-teacher-id="{{ $teacher->id }}">聯絡老師</button>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>
    <x-footer_alpha/>
</body>
</html>

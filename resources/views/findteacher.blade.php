<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('findteacher.css')}}">
</head>
<body>
<div>
        <form id="jobForm" method="POST" action="{{ route('findteacher') }}">
            @csrf
            <h2>找老師</h2>

            <div class="form-group">
                <label for="title">標題:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group w-45 fl mr-5 ">
                <label for="subject">科目:</label>
                <select id="subject" name="subject" required>
                    <option value="">請選擇科目</option>
                    <option value="math">數學</option>
                    <option value="english">英文</option>
                    <option value="science">科學</option>
                </select>
            </div>
            <div class="form-group fl w-45 mr-5">
                <label>教學次數:</label>
                <div>
                    <input type="radio" id="single" name="frequency" value="single" required>
                    <label for="single">單次</label>
                </div>
                <div>
                    <input type="radio" id="multiple" name="frequency" value="multiple" required>
                    <label for="multiple">多次</label>
                </div>
            </div>
        <div class="form-group w-100">
            <label>可上課時段(可複選):</label>
            <div class="fl mr-5">
                <input type="checkbox" id="time_morning" name="available_time[]" value="morning">
                <label for="time_morning">早上</label>
            </div>
            <div class="fl mr-5">
                <input type="checkbox" id="time_afternoon" name="available_time[]" value="afternoon">
                <label for="time_afternoon">下午</label>
            </div>
            <div class="fl ">
                <input type="checkbox" id="time_evening" name="available_time[]" value="evening">
                <label for="time_evening">晚上</label>
            </div>
        </div>
            
        <div class="w-100 fl mr-5">
            <div class="form-group fl w-45 mr-5">
                <label for="hourly_rate_min">時薪範圍:</label>
                <div class="hourly-rate-inputs">
                    <input type="number" id="hourly_rate_min" name="hourly_rate_min" min="0" step="1" required
                        placeholder="最低">
                    <span>-</span>
                    <input type="number" id="hourly_rate_max" name="hourly_rate_max" min="0" step="1" required
                        placeholder="最高">
                </div>
            </div>
            <div class="form-group fl w-45 mr-5 ">
                <label for="city">縣市:</label>
                <select id="city" name="city" required>
                    <option value="">請選擇縣市</option>
                    <option value="taipei">台北市</option>
                    <option value="taichung">台中市</option>
                    <option value="kaohsiung">高雄市</option>
                </select>
            </div>
        </div>   
            <div class="form-group fl w-100">
                <label>地區 (可複選):</label>
                <div id="districts-container">
                    <!-- JS處理地區 -->
                </div>
            </div>



            <div class="form-group w-100 fl">
                <label for="details">詳細內容:</label>
                <textarea id="details" name="details" rows="4" required></textarea>
            </div>
            
            <div class="form-group fl w-100 ">
                <label>聯絡方式</label>
                <div>
                    <input type="radio" id="phone_option" name="connection" value="phone" required>
                    <label for="phone_option">手機</label>
                </div>
                <div>
                    <input type="radio" id="email_option" name="connection" value="email" required>
                    <label for="email_option">email</label>
                </div>
                <div id="contact_info" style="display: none; margin-top: 10px;">
                    <input type="text" id="contact_value" name="contact_value" readonly>
                </div>
            </div>

            <button type="submit">提交</button>
        </form>
    </div>
    <script src="{{ asset('findteacher.js') }}"></script>
</body>
</html>

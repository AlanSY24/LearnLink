<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('luyen/findteacher.css') }}">
</head>
<body>
<div >
    <form id="jobForm" method="POST" action="{{ route('findteacher') }}">
        @csrf
        <div class="clearfix">
        <h2>找老師</h2>

        <div class="form-group fl w-100">
            <label for="title">標題:</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div class="form-group w-45 fl mr-5">
            <label for="subject">科目:</label>
            <select id="subject" name="subject" required>
                <option value="">請選擇科目</option>
                <option value="math">數學</option>
                <option value="english">英文</option>
                <option value="science">科學</option>
            </select>
        </div>

        <div class="form-group w-45 mr-5 fl">
            <label>可上課時段(可複選):</label>
            <div class="fl mr-5">
                <input type="checkbox" id="time_morning" name="available_time[]" value="morning">
                <label for="time_morning">早上</label>
            </div>
            <div class="fl mr-5">
                <input type="checkbox" id="time_afternoon" name="available_time[]" value="afternoon">
                <label for="time_afternoon">下午</label>
            </div>
            <div class="fl">
                <input type="checkbox" id="time_evening" name="available_time[]" value="evening">
                <label for="time_evening">晚上</label>
            </div>
        </div>

        <div class="form-group w-45 fl mr-5">
            <label for="expected_date">預計上課日期:</label>
            <input type="date" id="expected_date" name="expected_date" required>
        </div>
        <div class="form-group fl w-45 mr-5">
                <label for="hourly_rate_min">時薪範圍:</label>
                <div class="hourly-rate-inputs">
                    <input type="number" id="hourly_rate_min" name="hourly_rate_min" min="0" step="1" required placeholder="最低">
                    <span>-</span>
                    <input type="number" id="hourly_rate_max" name="hourly_rate_max" min="0" step="1" required placeholder="最高">
                </div>
            </div>
       
        <div class="w-100 fl mr-5">
            
            <div class="form-group fl w-45 mr-5">
                <label for="city">縣市:</label>
                <select id="city" name="city" required>
                    <option value="">請選擇縣市</option>
                    
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
        <div class="button-container">
        <button type="submit" class="">提交</button>
        </div>
        </div>
    </form>
</div>
<script src="{{ asset('luyen/findteacher.js') }}"></script>
</body>
</html>
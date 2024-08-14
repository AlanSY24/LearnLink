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
                    $('#districts').empty();
                    $.each(data, function(index, district) {
                        $('#districts').append(
                            '<label><input type="checkbox" name="districts[]" value="' + district.id + '"> ' + district.district_name + '</label><br>'
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Districts AJAX Error:', error);
                }
            });
        } else {
            $('#districts').empty(); // 如果未選擇縣市，清空區域選擇
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchButtont').addEventListener('click', function() {
        const subject = document.getElementById('subject').value;
        const city = document.getElementById('city').value;
        // 取得选中的多个区域
        const selectedDistricts = Array.from(document.querySelectorAll('#districts input[type="checkbox"]:checked'))
            .map(checkbox => checkbox.value);
        const minBudget = document.querySelector('.min-input').value;
        const maxBudget = document.querySelector('.max-input').value;
        const selectedTimes = Array.from(document.querySelectorAll('.t_search_time input[type="checkbox"]:checked'))
            .map(checkbox => checkbox.value);


        if ((minBudget && minBudget < 100) || (maxBudget && maxBudget > 100000) || (minBudget && maxBudget && minBudget >= maxBudget)) {
            alert('请检查预算输入是否正确');
            return;
        }

        const queryParams = new URLSearchParams();

        if (subject && subject !== '0') {
            queryParams.append('subject', subject);
        }
        if (city) {
            queryParams.append('city', city);
        }
        if (selectedDistricts.length > 0) {
            queryParams.append('districts', selectedDistricts.join(',')); // 将所有选中的区用逗号分隔
            console.log('districts', selectedDistricts.join(','));
            
        }
        if (minBudget) {
            queryParams.append('minBudget', minBudget);
        }
        if (maxBudget) {
            queryParams.append('maxBudget', maxBudget);
        }
        if (selectedTimes.length > 0) {
            queryParams.append('time', selectedTimes.join(',')); // 将所有选中的时间用逗号分隔
        }
        // 導向帶有查詢參數的 URL
        window.location.href = `http://localhost/LearnLink/public/teacher_lists?${queryParams.toString()}`;
    });
});


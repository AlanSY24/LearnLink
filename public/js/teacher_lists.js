document.addEventListener('DOMContentLoaded', function() {
    var hearts = document.querySelectorAll('.heart-icon');

    hearts.forEach(function(heartIcon) {
        var isFavorite = heartIcon.classList.contains('fas');
        var teacherId = heartIcon.getAttribute('data-teacher-id');

        console.log('Initial isFavorite:', isFavorite);
        console.log('Teacher ID:', teacherId);

        heartIcon.addEventListener('click', function() {
            console.log('Click detected on teacher ID:', teacherId);
            
            if (!isFavorite) {
                // Switch to filled heart, red color
                heartIcon.classList.remove('far');
                heartIcon.classList.add('fas');
                heartIcon.style.color = '#ed1212';
                isFavorite = true;

                console.log('Added to favorites');
                toggleFavorite(teacherId, 'add');
            } else {
                // Switch to empty heart, red color
                heartIcon.classList.remove('fas');
                heartIcon.classList.add('far');
                heartIcon.style.color = 'red';
                isFavorite = false;

                console.log('Removed from favorites');
                toggleFavorite(teacherId, 'remove');
            }
        });
    });
});

function toggleFavorite(teacherId, action) {
    var url = action === 'add'
        ? '/LearnLink/public/teacher_lists/favorites/' + teacherId
        : '/LearnLink/public/teacher_lists/favorites/' + teacherId;
    
    var method = action === 'add' ? 'POST' : 'DELETE';

    console.log('URL:', url);
    console.log('Method:', method);
    console.log('User ID:', getUserId());

    $.ajax({
        url: url,
        method: method,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            user_id: getUserId()  // Optional: Send user ID if needed
        },
        success: function(response) {
            console.log('Success:', action === 'add' ? 'Added to favorites' : 'Removed from favorites');
            console.log('Response:', response);
        },
        error: function(xhr) {
            console.log('Error:', action === 'add' ? 'Failed to add favorite' : 'Failed to remove favorite');
            console.log('XHR:', xhr);
        }
    });
}

function getUserId() {
    return document.querySelector('meta[name="user-id"]').getAttribute('content');
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
            alert('請檢查預算輸入是否正確');
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

    
    // 选择所有的“联系”按钮
    document.querySelectorAll('[id="contact"]').forEach(function(button) {
        button.addEventListener('click', function() {
            // 从按钮的 data 属性中获取老师的名字和邮件
            const name = this.getAttribute('data-name');
            const email = this.getAttribute('data-email');
            
            // 显示提示框
            alert(`老師名字：${name}\n老師郵件：${email}`);
        });
    });

});


document.addEventListener('DOMContentLoaded', function() {
    var hearts = document.querySelectorAll('.heart-icon');

    hearts.forEach(function(heartIcon) {
        var teacherId = heartIcon.getAttribute('data-teacher-id');

        // 加载收藏状态
        checkFavoriteStatus(teacherId, function(isFavorited) {
            if (isFavorited) {
                heartIcon.classList.remove('far');
                heartIcon.classList.add('fas');
            } else {
                heartIcon.classList.remove('fas');
                heartIcon.classList.add('far');
            }
            heartIcon.style.color = '#ed1212'; // 红色
        });

        heartIcon.addEventListener('click', function() {
            var isFavorite = heartIcon.classList.contains('fas');
            console.log('Click detected on teacher ID:', teacherId);
            
            if (!isFavorite) {
                heartIcon.classList.remove('far');
                heartIcon.classList.add('fas');
                toggleFavorite(teacherId, 'add');
            } else {
                heartIcon.classList.remove('fas');
                heartIcon.classList.add('far');
                toggleFavorite(teacherId, 'remove');
            }
            heartIcon.style.color = '#ed1212'; // 红色
        });
    });
});

function checkFavoriteStatus(teacherId, callback) {
    $.ajax({
        url: '/LearnLink/public/teacher_lists/favorites/status/' + teacherId,
        method: 'GET',
        success: function(response) {
            callback(response.isFavorited);
        },
        error: function(xhr) {
            console.log('Error:', 'Failed to fetch favorite status');
            console.log('XHR:', xhr);
        }
    });
}

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
    document.getElementById('searchButtont').addEventListener('click', async function() {
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

        try {
            const response = await fetch(`http://localhost/LearnLink/public/teacher_lists?${queryParams.toString()}`);
            
            if (response.status === 404) {
                const result = await response.json();
                alert(result.message); // Display the specific message from the server
            } else {
                // Redirect to the results page if data is found
                window.location.href = `http://localhost/LearnLink/public/teacher_lists?${queryParams.toString()}`;
            }
        } catch (error) {
            console.error('Error during fetch:', error);
            alert('發生錯誤，請稍後再試');
        }
    });

    
    // 选择所有的“联系”按钮
    document.querySelectorAll('[id="contact"]').forEach(function(button) {
        button.addEventListener('click', function() {
            // Get the teacher ID from the button's data attribute
            var teacherId = this.getAttribute('data-teacher-id');
            var userId = document.querySelector('meta[name="user-id"]').getAttribute('content');

            // 检查 ID 是否有效
            if (!teacherId || !userId) {
                console.error('Teacher ID is not defined.');
                alert('無法獲取老師ID或用戶ID，請確認是否已登入，或是重新嘗試謝謝。');
                return;
            }

            $.ajax({
                url: '/LearnLink/public/contact_teacher', // Update URL to match the URL structure
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    teacher_id: teacherId,
                    user_id: userId,
                },
                success: function(response) {
                    if (response.success) {
                        alert(`已聯絡 ${button.getAttribute('data-name')} 老師，請耐心等候老師回復謝謝`);
                    } else {
                        alert('聯絡老師時發生錯誤，請稍後再試');
                    }
                },
                error: function(xhr) {
                    // 获取并显示服务器返回的错误消息
                    var errorMessage = '聯絡時發生錯誤，請稍後再試';
                    try {
                        var response = JSON.parse(xhr.responseText);
                        if (response.message) {
                            errorMessage = response.message;
                        }
                    } catch (e) {
                        console.error('Error parsing JSON response:', e);
                    }
                    console.log('Error:', xhr);
                    alert(errorMessage);
                }
            });
        });
    });

    document.querySelectorAll('.teacher-resume-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var teacherId = this.getAttribute('data-teacher-id');
            window.open('/LearnLink/public/teacher_profiles/' + teacherId, '_blank');
        });
    });

    


});

$(document).ready(function() {
    $('.t_lists_score').each(function() {
        const $span = $(this).find('span');
        const teacherId = $span.data('teacher-id');
        const ratingUrl = $span.data('rating-url');

        console.log('Teacher ID:', teacherId);
        console.log('Rating URL:', ratingUrl);

        $.ajax({
            url: ratingUrl,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // 添加 CSRF 头部
            },
            success: function(data) {
                const averageRating = data.average_rating || '0.0';
                const ratingCount = data.rating_count || '0';
                $(`#rating-${teacherId}`).text(
                    `${averageRating} (${ratingCount} 人評分)`
                );
            },
            error: function(xhr, status, error) {
                console.error('Error fetching rating:', error);
                $(`#rating-${teacherId}`).text('無法獲取評分');
            }
        });
    });
});

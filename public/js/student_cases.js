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
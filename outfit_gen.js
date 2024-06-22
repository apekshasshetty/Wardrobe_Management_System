// Listen for changes in the clothing category dropdown
$('#clothing-category').change(function () {
    var selectedCategories = $('#clothing-category').val();
    fetchClothingItems(selectedCategories);
});

// Handle click events on buttons for clothing items in the left container
$(document).on('click', '.clothing-btn', function () {
    var selectedItem = $(this).clone(); // Clone the selected item
    selectedItem.removeClass('clothing-btn'); // Remove the 'clothing-btn' class to avoid styling conflicts
    selectedItem.addClass('selected-item'); // Add a new class for styling in the right container

    // Log the selected item details to the console
    console.log('Selected Item Details:', {
        cloth_name: selectedItem.find('.btn-name').text(),
        image_path: selectedItem.find('.btn-img').attr('src')
    });

    // Update the right container with the selected item
    var rightContainer = $('.container.right #selected-clothes-container');
    rightContainer.append(selectedItem);
});

// Handle click event on the "Wear Outfit" button
$('#wear-outfit-btn').click(function () {
    // Collect outfit details
    var outfitDetails = {
        clothes: [],
    };

    // Iterate through selected clothes and add details to outfit
    $('.container.right #selected-clothes-container .selected-item').each(function () {
        var cloth_name = $(this).find('.btn-name').text();
        var image_path = $(this).find('.btn-img').attr('src');

        outfitDetails.clothes.push({
            cloth_name: cloth_name,
            image_path: image_path,
        });
    });

    // Send AJAX request to store outfit details
    $.ajax({
        url: 'wear_outfit.php', // Replace with the actual server-side script
        method: 'POST',
        data: { outfitDetails: JSON.stringify(outfitDetails) },
        success: function (response) {
            alert('Outfit worn and saved!');
        },
        error: function (error) {
            console.log('Error wearing outfit:', error);
        }
    });
});

function fetchClothingItems(selectedCategories) {
    // Add AJAX request to fetch clothing items based on the selected categories
    $.ajax({
        url: 'fetch_clothes.php',
        method: 'POST',
        data: { category: selectedCategories },
        success: function (response) {
            // Parse the JSON response
            var clothingItems = JSON.parse(response);

            // Populate the left container with the fetched items as buttons
            var leftContainer = $('.container.left .clothing-container');
            leftContainer.empty(); // Clear previous content

            // Iterate through the items and append them to the left container
            for (var i = 0; i < clothingItems.length; i++) {
                var item = clothingItems[i];
                var btn = $('<button class="btn btn-outline-primary clothing-btn">');
                btn.append('<img src="' + item.image_path + '" alt="' + item.cloth_name + '" class="btn-img">');
                btn.append('<div class="btn-content">');
                btn.append('<h5 class="btn-name">' + item.cloth_name + '</h5>');
                btn.append('</div>');
                btn.append('</button>');
                leftContainer.append(btn);
            }
        },
        error: function (error) {
            console.log('Error fetching clothing items:', error);
        }
    });
}

// Format number with comma
let numberWithCommas = (number) => number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

// Fetch data
$.get('https://covid19stats.ph/api/stats/quick', {}, (data) => {
    let cases = data.cases;
    let world = data.world;

    $('#philippines-confirmed').html(numberWithCommas(cases.total));
    $('#philippines-recovered').html(numberWithCommas(cases.recovered));
    $('#philippines-deaths').html(numberWithCommas(cases.deaths));


    $('#world-wide-confirmed').html(numberWithCommas(world.total));
    $('#world-wide-recovered').html(numberWithCommas(world.recovered));
    $('#world-wide-deaths').html(numberWithCommas(world.deaths));
});


$('.update-category').click(function (e) {

    // Get the selected category button
    let selectedCategory = $(this);
    let category = $(selectedCategory).attr('data-target');
    let categoryElement = $(`#${category}`);

    // Hide the remaining elements.
    $('.update-category').each(function (e) {

        // Category buttons
        let id = $(this).attr('data-target');

        if (id !== category) {
            $(`#${id}`).addClass('hidden');
            $(this).removeClass('bg-theme-1')
                .addClass('bg-gray-200')
                .addClass('text-gray-600');
        } else {

            // Apply active color for button
            $(this).removeClass('text-gray-600')
                .addClass('bg-theme-1')
                .addClass('text-white');

            // Change the base title depending on the selected category
            let title = category.replace(/-/g, ' ')
                                .toUpperCase();
                                
            $('#base-title').text('')
                .text(`COVID-19 Quick Stat for ${title}`)
        }

    });

    // Display the selected category stats.
    categoryElement.removeClass('hidden');
});

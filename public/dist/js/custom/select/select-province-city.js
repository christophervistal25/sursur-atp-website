const BASE_URL = document.head.querySelector('meta[name="base_api_url"]').content;
    // User Select Province then populate all data for province.
    $('#province').change((e) => {

        let provinceCode = e.target.value;
        let elementCities = $('#cities');
        // Make an AJAX request to get all city filtered by selected province.
        if(!$('#residence').is(':checked')) {
            $.ajax({
                url: `${BASE_URL}/province/municipal/${provinceCode}`,
                success: (response) => {
                    // Clear all option of cities select element
                    elementCities.find('option').remove();

                    // Iterate to all city by province code and display to select
                    response.municipals.forEach((municipal) => {
                        elementCities.append(
                            `<option value="${municipal.code}">${municipal.name}</option>`
                        );
                    });

                }
            });
        }
    });


    // User Select City then populate all data for barangays
    $('#cities').change((e) => {
        let selectedCityCode = e.target.value;
        let barangayElement = $('#barangay');

        // Make an AJAX request to get all barangay filtered by selected city.
        $.ajax({
            url: `${BASE_URL}/province/barangay/${selectedCityCode}`,
            success: (response) => {
                // Clear all option of barangay select element
                barangayElement.find('option').remove();

                // Iterate to all barangay by city code and display to select
                response.barangays.forEach((barangay) => {
                    $('#barangay').append(
                        `<option value="${barangay.code}">${barangay.name}</option>`
                    );
                });

            }
        });

    });

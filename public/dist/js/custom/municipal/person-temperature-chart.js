let CHART_COLOR = ['#2ecc71', '#f1c40f', '#e74c3c']

let URL = document.head
                    .querySelector('meta[name="base_api_url"]')
                    .content

// Located in templates header
let authCityCode = document.querySelector('#auth-city-code')
                            .getAttribute('data-source')

fetch(`${URL}/person/temperature`)
    .then(response => response.json())
    .then(data => {
        let CHART_LABELS = Object.keys(data);
        let CHART_DATA = Object.values(data);

        let config = {
            type: 'pie',
            data: {
                labels: CHART_LABELS,
                datasets: [{
                    data: CHART_DATA,
                    backgroundColor: CHART_COLOR,
                    hoverBackgroundColor: CHART_COLOR,
                    borderWidth: 5,
                    borderColor: "#fff",
                }],
            },
            options: {
                responsive: true,
                legend: {
                    display: false,
                }
            }
        };

        let context = document.querySelector('#temperatureChart').getContext('2d');
        new Chart(context, config);


        let labelContainer = document.querySelector('#person__temperature__chart__container');

        CHART_DATA.map((data, index) => {
            if(typeof data === 'number') {
                $(labelContainer).append(`
                    <div class="flex items-center mt-4">
                        <div class="w-2 h-2 rounded-full mr-3" style="background :${CHART_COLOR[index]}"></div>
                        <span class="truncate">${CHART_LABELS[index]}</span>
                        <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">${data}</span>
                    </div>
                `);
            }
        });



        let GENDER_COLOR = ['rgb(57 ,73, 171)', 'rgba(229, 57, 53)'];

        let options = {
            type: 'pie',
            data: {
                labels: Object.keys(data.gender),
                datasets: [{
                    data: Object.values(data.gender),
                    backgroundColor: GENDER_COLOR,
                    hoverBackgroundColor: GENDER_COLOR,
                    borderWidth: 5,
                    borderColor: "#fff",
                }],
            },
            options: {
                responsive: true,
                legend: {
                    display: false,
                }
            }
        };

        let BY_GENDER_VALUE = Object.values(data.gender);
        BY_GENDER_VALUE.forEach((value, index) => {
            $('#person__temperature__chart__by__sex__container').append(`
                <div class="flex items-center mt-4">
                    <div class="w-2 h-2 rounded-full mr-3" style="background :${GENDER_COLOR[index]}"></div>
                    <span class="truncate">${Object.keys(data.gender)[index]}</span>
                    <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                    <span class="font-medium xl:ml-auto">${value}</span>
                </div>
            `);
            index++;
        });

        let sexTemperatureChart = document.querySelector('#sexTemperatureChart').getContext('2d');
        new Chart(sexTemperatureChart, options);


        Object.values(data.user_bracket_by_age).forEach((age, index) => {
            let bracket = Object.keys(data.user_bracket_by_age)[index];
            let widthForProgress = Math.ceil(age / 32);
            $('#person__by__age__container').append(`
                <div class='mt-4'>
                    <div class="flex">
                        <div class="text-gray-700 mr-auto">${bracket.replace('_', ' - ')} years old</div>
                        <div class="font-medium">${age}</div>
                    </div>
                    <div class="w-full h-1 mt-2 bg-gray-400 rounded-full">
                        <div class="h-full bg-theme-1 rounded-full" style="width:${widthForProgress}vw"></div>
                    </div>
                </div>
            `);
        });
    });



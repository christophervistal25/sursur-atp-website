   let URL       = 'https://covid19stats.ph/api/stats/location';
   let BASE_SLUG = 'surigao-del-sur';

    fetch(URL)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let cities = [];
            let cityConfirmedCase = [];
            let cityRecovered = [];
            let cityDeaths = [];

            surigaoDelSurCities = data.cities.filter((city) => city.slug.includes(BASE_SLUG));
            surigaoDelSurCities.map((city) => {
                cities.push(city.name.replace(', Surigao del Sur', ''));
                cityConfirmedCase.push(city.total);
                cityRecovered.push(city.recovered)
                cityDeaths.push(city.deaths)
            })

            initChart(cities, cityConfirmedCase, cityRecovered, cityDeaths)
        });

    let initChart = (labels, confirmed, recovered, deaths) => {
        let ctx = document.getElementById('horizontal-bar').getContext('2d');

        let barChartData = {
            labels: labels,
            datasets: [{
                    label: 'Confirmed Cases',
                    backgroundColor: "#f1c40f",
                    data: confirmed
                }, {
                    label: 'Recovered',
                    backgroundColor: "#2ecc71",
                    data: recovered,
                },
                {
                    label: 'Deaths',
                    backgroundColor: "#e74c3c",
                    data: deaths,
                },
            ],
        };


        new Chart(ctx, {
            type: 'bar',
            data: barChartData,
        });
    };

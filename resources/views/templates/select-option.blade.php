<script async>
            (() => {
            const RETRIEVE_URL        = document.head.querySelector('meta[name="base_api_url"]').content + '/province';
            let   oldProvinceCode = "{{ old('province') }}";
            let   oldCity         = "{{ old('city') }}";
            let   oldBarangay     = "{{ old('barangay') }}";


            let fetchData = (URL, callback) => {
                fetch(URL)
                    .then(response => response.json())
                    .then(data => callback(data));
            };

            if(oldCity) {
                fetchData(`${RETRIEVE_URL}/municipal/${oldProvinceCode}`, (data) => {
                    data.municipals.forEach((municipal) => {
                        let option  = document.createElement('option');
                        option.value       = municipal.code;
                        option.textContent = municipal.name;
                        option.selected = (municipal.code == oldCity) ? true : false;
                        document.querySelector('#cities').append(option);
                    });
                });
            }

            if(oldBarangay) {
                fetchData(`${RETRIEVE_URL}/barangay/${oldCity}`, (data) => {
                    data.barangays.forEach((barangay) => {
                        let option  = document.createElement('option');
                        option.value       = barangay.code;
                        option.textContent = barangay.name;
                        option.selected = (barangay.code == oldBarangay) ? true : false;
                        document.querySelector('#barangay').append(option);
                    });
                });
            }

        })();

</script>

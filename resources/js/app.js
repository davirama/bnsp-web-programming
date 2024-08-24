import './bootstrap';
import 'flowbite';


    document.addEventListener("DOMContentLoaded", function() {
        // Function to initialize and handle province and city dropdowns
        function initializeProvinceCity(provinceSelectId, citySelectId) {
            var provinceSelect = document.getElementById(provinceSelectId);
            var citySelect = document.getElementById(citySelectId);
            var originalCities = citySelect.innerHTML;

            // Urutkan opsi provinsi berdasarkan nama provinsi
            var provinceOptions = provinceSelect.querySelectorAll('option');
            var sortedProvinces = Array.from(provinceOptions).slice(1).sort((a, b) => a.textContent.localeCompare(b.textContent));
            provinceSelect.innerHTML = "";
            provinceSelect.appendChild(provinceOptions[0]); // Tambahkan opsi default pertama
            sortedProvinces.forEach(function(option) {
                provinceSelect.appendChild(option);
            });

            // Sembunyikan opsi kota saat halaman dimuat
            function hideCityOptions() {
                var cityOptions = citySelect.querySelectorAll('option');
                cityOptions.forEach(function(option) {
                    option.style.display = 'none';
                });
                citySelect.disabled = false;
            }
            hideCityOptions();

            provinceSelect.addEventListener('change', function() {
                var selectedProvinceId = this.value;
                var cityOptions = citySelect.querySelectorAll('option');

                citySelect.selectedIndex = 0;

                // Jika provinsi telah dipilih
                if (selectedProvinceId) {
                    cityOptions.forEach(function(option) {
                        // Jika province_id dari opsi kota sama dengan yang dipilih pada provinsi
                        if (option.dataset.provinceId === selectedProvinceId || option.value === '') {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                        }
                    });
                    // Aktifkan kembali select kota
                    citySelect.disabled = false;
                } else {
                    // Jika provinsi belum dipilih, sembunyikan semua opsi kota dan nonaktifkan select kota
                    hideCityOptions();
                }
            });

            // Otomatis pilih kota berdasarkan provinsi saat halaman dimuat
            var selectedProvinceId = provinceSelect.value;
            var cityOptions = citySelect.querySelectorAll('option');
            cityOptions.forEach(function(option) {
                if (option.dataset.provinceId === selectedProvinceId) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }

        // Inisialisasi untuk provinsi dan kota
        initializeProvinceCity('province_id', 'city_id');
        initializeProvinceCity('province_id_lahir', 'city_id_lahir');
    });


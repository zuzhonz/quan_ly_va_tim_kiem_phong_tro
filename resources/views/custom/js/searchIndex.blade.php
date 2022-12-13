<script>

    const selectCityMotel = document.getElementById('city_id');
    const selectDistrictMotel = document.getElementById('district_id');
    const selectWardMotel = document.getElementById('ward_id');
    $(function () {
        $.ajax({
            url: "https://provinces.open-api.vn/api/p",
            type: 'GET',
            success: function (result) {
                const ul = selectCityMotel.querySelector('ul');
                ul.innerHTML +=
                    `${
                        result.map(item => `<li data-value="${item.code}" class="option">${item.name}</li>`).join('')
                    }`;
                ul.style.height = '350px';
                ul.style.overflowY = 'auto';
                ul.classList.add('city');
                const li = ul.querySelectorAll('li');
                li.forEach(item => {
                    item.addEventListener('click', (e) => {
                        const {value} = e.target.dataset;
                        if (+value !== 0) {
                            $.ajax({
                                url: `https://provinces.open-api.vn/api/p/${value}/?depth=2`,
                                type: 'GET',
                                success: function (result) {
                                    const ul = selectDistrictMotel.querySelector('ul');
                                    ul.innerHTML =
                                        `
                                        <li data-value="0" class="option">Lựa chọn quận/huyện</li>
                                        ${
                                            result.districts.map(item => `<li data-value="${item.code}" class="option">${item.name}</li>`).join('')
                                        }`;
                                    ul.style.height = '350px';
                                    ul.style.overflowY = 'auto';
                                    ul.classList.add('district');
                                    const li = ul.querySelectorAll('li');
                                    const ulWard = selectWardMotel.querySelector('ul');
                                    ulWard.style.height = '350px';
                                    ulWard.style.overflowY = 'auto';
                                    ulWard.classList.add('ward');
                                    li.forEach(item => {
                                        item.addEventListener('click', (e) => {
                                            const valueLi = e.target.dataset.value;
                                            if (+valueLi !== 0) {
                                                $.ajax({
                                                    url: `https://provinces.open-api.vn/api/d/${valueLi}?depth=2`,
                                                    type: 'GET',
                                                    success: function (result) {

                                                        ulWard.innerHTML =
                                                            `
                                        <li data-value="0" class="option">Lựa chọn quận/huyện</li>
                                        ${
                                                                result.wards.map(item => `<li data-value="${item.code}" class="option">${item.name}</li>`).join('')
                                                            }`;
                                                        ulWard.style.height = '350px';
                                                        ulWard.style.overflowY = 'auto';
                                                    }
                                                });
                                            } else {
                                                ulWard.innerHTML = `
                                                     <li data-value="0" class="option">Bạn chọn quận/huyện</li>`;
                                            }
                                        })
                                    })


                                }
                            });
                        } else {
                            const ul = selectDistrictMotel.querySelector('ul');
                            ul.innerHTML =
                                `
                                        <li data-value="0" class="option">Bạn chưa chọn tỉnh</li>`;
                        }

                    })
                })


            }
        });
    });
</script>
<script>
    let resultSearch = [];
    document.getElementById('btnSearch').addEventListener('click', () => {

        const selectCity = document.querySelector('.city');

        selectCity.querySelectorAll('li').forEach(element => {
            const {value} = element.dataset;
            if (+value > 0) {
                if (element.classList.contains('selected')) {
                    document.getElementsByName('city_id')[0].value = JSON.stringify({
                        id: value,
                        label: element.innerHTML
                    });
                }
            }

        })

        const selectDistrict = document.querySelector('.district');
        if (selectDistrict) {
            selectDistrict.querySelectorAll('li').forEach(element => {
                const {value} = element.dataset;
                if (+value > 0) {
                    if (element.classList.contains('selected')) {
                        document.getElementsByName('district_id')[0].value = JSON.stringify({
                            id: value,
                            label: element.innerHTML
                        });
                    }
                }
            })
        }

        const selectWard = document.querySelector('.ward');
        if (selectWard) {
            selectWard.querySelectorAll('li').forEach(element => {
                const {value} = element.dataset;
                if (+value > 0) {
                    if (element.classList.contains('selected')) {
                        document.getElementsByName('ward_id')[0].value = JSON.stringify({
                            id: value,
                            label: element.innerHTML
                        });
                    }
                }
            })
        }

        const selectBedroom = document.getElementById('bedroom');

        selectBedroom.querySelectorAll('li').forEach(element => {
            const {value} = element.dataset;
            if (element.classList.contains('selected')) {
                console.log(value);
                document.getElementsByName('bedroom')[0].value = value;
            }

        })
        const selectToilet = document.getElementById('toilet');

        selectToilet.querySelectorAll('li').forEach(element => {
            const {value} = element.dataset;
            if (element.classList.contains('selected')) {
                document.getElementsByName('toilet')[0].value = value;
            }

        })

        const areaMin = document.querySelector('.first-slider-value');
        const areaMax = document.querySelector('.second-slider-value');
        const priceRange = document.getElementById('price-range');

        const priceMax = priceRange.querySelector('.second-slider-value');
        const priceMin = priceRange.querySelector('.first-slider-value');
        console.log(areaMin.value.split(' ')[0]);
        document.getElementsByName('area_min')[0].value = areaMin.value.split(' ')[0];
        document.getElementsByName('area_max')[0].value = areaMax.value.split(' ')[0];

        document.getElementsByName('price_min')[0].value = priceMin.value.split(" ")[1].replaceAll(",", "");
        document.getElementsByName('price_max')[0].value = priceMax.value.split(" ")[1].replaceAll(",", "");
    });
</script>

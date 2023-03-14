jQuery(function ($) {
    $(".tel-mask").mask("+7(999) 999-99-99");
});

jQuery(document).ready(function ($) {

    //Формы
    function formsInit() {
        //Формы
        $('.input_wrapper input, .input_wrapper textarea').each(function () {
            if ($(this).val() !== '' && $(this).val() !== '+7(___) ___-__-__') $(this).closest('.input_wrapper').addClass('active');
        });

    }

    $(document).on('focus', '.input_wrapper input, .input_wrapper textarea, .input_wrapper select', function (e) {
        $(this).closest('.input_wrapper').addClass('active');
    });

    $(document).on('blur', '.input_wrapper input, .input_wrapper textarea, .input_wrapper select', function (e) {
        if ($(this).val() === '' || $(this).val() === '+7(___) ___-__-__') $(this).closest('.input_wrapper').removeClass('active');
    });

    formsInit();


    // Действие на checkbox

    $("#checkbox_kg_emp").on("change", function () {
        $('.add_check_block').slideToggle();
    });

    // Переключатели в регистрации

    $('.reg_par0').addClass('active_link');

    $(".reg_par1").on("click", function () {
        $('.reg_par0').removeClass('active_link');
        $('.reg_par1').addClass('active_link');
        $('.as_user').addClass('hidden');
        $('.as_kg').removeClass('hidden');
    });

    $(".reg_par0").on("click", function () {
        $('.reg_par1').removeClass('active_link');
        $('.reg_par0').addClass('active_link');
        $('.as_kg').addClass('hidden');
        $('.as_user').removeClass('hidden');
    });


    /*$('#ham_button').on('click', () => {
        $('#main_menu').toggle("slide");
    });

    $('#close_button').on('click', () => {
        $('#main_menu').toggle('slide');
    });*/

    // $(document).mouseup(function (e) { // событие клика по веб-документу
    //     var div = $("#main_menu"); // тут указываем ID элемента
    //     if (!div.is(e.target) // если клик был не по нашему блоку
    //         && div.has(e.target).length === 0) { // и не по его дочерним элементам
    //         div.toggle('slide'); // скрываем его
    //     }
    // });



    /*$(window).resize(function () {
        if ($(window).width() > '770') {
            $('#main_menu').css('display', 'block');
        } else {
            $('#main_menu').css('display', 'none');
        }
    });*/


    let element = document.getElementsByClassName('user_slider_expert_block');
    if (element.length) {
        element[0].addEventListener('itemshown', (e) => {
                let index = e.detail[0].index;

                $('.expert_block').removeClass('visible');


                $('.expert_block:eq(' + index + ')').addClass('visible');

                $('.user_slider_expert li img').css('opacity', '0.8');

                $('.user_slider_expert li:eq(' + index + ') img').css('opacity', '1');

            }
        );
    }


    $('.slider_ul').on('click', 'li', function () {
        var ind = $(this).index();
        $('.expert_block').removeClass('visible');
        $('.expert_block:eq(' + ind + ')').addClass('visible');

        $('.user_slider_expert li img').css('opacity', '0.8');

        $('.user_slider_expert li:eq(' + ind + ') img').css('opacity', '1');
    });
});


/*Слайдер*/


var slides = document.querySelectorAll('#slides .slide');

if (slides.length > 0) {


    var controls = document.querySelectorAll('.controls');
    for (var i = 0; i < controls.length; i++) {
        controls[i].style.display = 'inline-block';
    }


    var currentSlide = 0;
    var slideInterval = setInterval(nextSlide, 5000);

    function nextSlide() {
        goToSlide(currentSlide + 1);
    }

    function previousSlide() {
        goToSlide(currentSlide - 1);
    }

    function goToSlide(n) {
        slides[currentSlide].className = 'slide';
        currentSlide = (n + slides.length) % slides.length;
        slides[currentSlide].className = 'slide showing';
    }

    var next = document.getElementById('next_edu');
    var previous = document.getElementById('previous_edu');

    next.onclick = function () {
        clearInterval(slideInterval);
        nextSlide();
        slideInterval = setInterval(nextSlide, 5000);
    };
    previous.onclick = function () {
        clearInterval(slideInterval);
        previousSlide();
        slideInterval = setInterval(nextSlide, 5000);
    };

}

// Настройка диаграммы

var oilCanvas = document.getElementById("oilChart");

if (oilCanvas) {

    Chart.defaults.global.defaultFontFamily = "Geometria";
    Chart.defaults.global.defaultFontSize = 14;

    var oilData = {
        labels: [
            "Параметр 1",
            "Параметр 2",
            "Параметр 3",
            "Параметр 4",
            "Параметр 5"
        ],
        datasets: [
            {
                data: [10, 9, 5, 11, 8],
                backgroundColor: [
                    "#f2cc35",
                    "#e06942",
                    "#63aa52",
                    "#36a9e1",
                    "#6761bd"
                ],
                borderColor: "#ffffff",
                borderWidth: 2
            }]
    };


    document.getElementById('first_param').textContent = oilData.labels[0];
    document.getElementById('sec_param').textContent = oilData.labels[1];
    document.getElementById('th_param').textContent = oilData.labels[2];
    document.getElementById('four_param').textContent = oilData.labels[3];
    document.getElementById('five_param').textContent = oilData.labels[4];


    document.getElementById('first_mark').textContent = oilData.datasets[0].data[0];
    document.getElementById('sec_mark').textContent = oilData.datasets[0].data[1];
    document.getElementById('th_mark').textContent = oilData.datasets[0].data[2];
    document.getElementById('four_mark').textContent = oilData.datasets[0].data[3];
    document.getElementById('five_mark').textContent = oilData.datasets[0].data[4];

    var styleElem1 = document.head.appendChild(document.createElement("style"));
    var styleElem2 = document.head.appendChild(document.createElement("style"));
    var styleElem3 = document.head.appendChild(document.createElement("style"));
    var styleElem4 = document.head.appendChild(document.createElement("style"));
    var styleElem5 = document.head.appendChild(document.createElement("style"));

    var style1 = ".yellow_square:before{background-color:" + oilData.datasets[0].backgroundColor[0] + "};";
    var style2 = ".orange_square:before{background-color:" + oilData.datasets[0].backgroundColor[1] + "};";
    var style3 = ".green_square:before{background-color:" + oilData.datasets[0].backgroundColor[2] + "};";
    var style4 = ".blue_square:before{background-color:" + oilData.datasets[0].backgroundColor[3] + "};";
    var style5 = ".violet_square:before{background-color:" + oilData.datasets[0].backgroundColor[4] + "};";

    styleElem1.innerHTML = style1;
    styleElem2.innerHTML = style2;
    styleElem3.innerHTML = style3;
    styleElem4.innerHTML = style4;
    styleElem5.innerHTML = style5;


    var pieChart = new Chart(oilCanvas, {
        type: 'pie',
        options: {
            responsive: true,
            legend: {
                display: false
            },
        },
        data: oilData
    });

}
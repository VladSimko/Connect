$(document).ready(function () {


    $city = document.querySelector('.city');
    $car = document.querySelector('.car');
    $carImg = document.querySelector('.carImg');
    $wheelR = document.querySelector('.wheelR');
    $wheelL = document.querySelector('.wheelL');
    $img = $('.light img');
    $carRect = $car.getBoundingClientRect();
    $light = document.querySelector('.light');
    let light = false;
    let selectedCar = 0;
    let selectedWheel = 0;



    window.addEventListener('keypress',(e) => {
        if(e.key === 'Enter')
        {
            $city.classList.toggle('moveRight')
            $car.classList.toggle('jumping')
            $wheelR.classList.toggle('spin')
            $wheelL.classList.toggle('spin')

        }
    })

    window.addEventListener('keypress',(e) => {
        if (e.key === 'q') {
            if(light)
            {
                light = false;
                $light.src = "";
            }
            else {
                light = true;
                $light.src = "assets/svetlo.png";
            }
            e.preventDefault();
        }
    })

    window.addEventListener('keypress',(e) => {
        if (e.key === 'e') {
            if (selectedCar < 2)
            {
                selectedCar++;
            }
            if (selectedCar == 2) {
                selectedCar = 0;
            }
            switch(selectedCar) {
                case 0:
                    $carImg.src = "./assets/auto.png";
                    break;
                case 1:
                    $carImg.src = "./assets/mustang.png";
                    break;
                default:
                    $carImg.src = "./assets/auto.png";
            }
            e.preventDefault();
        }
    })
    window.addEventListener('keypress',(e) => {
        if (e.key === 'w') {
            if (selectedWheel < 2)
            {
                selectedWheel++;
            }
            if (selectedWheel == 2) {
                selectedWheel = 0;
            }
            switch(selectedWheel) {
                case 0:
                    $wheelR.src = "./assets/koleso.png";
                    $wheelL.src = "./assets/koleso.png";
                    break;
                case 1:
                    $wheelR.src = "./assets/koleso2.png";
                    $wheelL.src = "./assets/koleso2.png";
                    break;
                default:
                    $wheelR.src = "./assets/koleso.png";
                    $wheelL.src = "./assets/koleso.png";
            }
            e.preventDefault();
        }
    })


})
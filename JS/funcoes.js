//Variáveis
var nav_links = document.getElementById('nav-links');
var nav_links_two = document.getElementById('nav-links-two');
var li_one = document.querySelector('#li-one');
var li_two = document.querySelector('#li-two');
var main_login = document.querySelector('#main-login');
var main_login_height = $('#main-login').css('height');

//Detectar mudança de tamanho da DIV main-login
$(window).resize(function() {
    main_login_height = $('#main-login').css('height');
    nav_links_two.style.display = 'none';
});

//Funções
function apareceMenu() {
    if (nav_links_two.style.display == 'block') {
        nav_links_two.style.display = 'none';
    } else {
        nav_links_two.style.display = 'block';
        nav_links_two.style.height = main_login_height;
        nav_links_two.style.background = '#201b2c';
        nav_links_two.style.opacity = 0.9;
    }
};

function pagConsulta() {
    var li_one = document.querySelector('#li-one');
    var li_two = document.querySelector('#li-two');
    var li_one_two = document.querySelector('#li-one-two');
    var li_two_two = document.querySelector('#li-two-two');

    li_one.classList.remove('active');
    li_two.classList.add('active');

    li_one_two.classList.remove('active');
    li_two_two.classList.add('active');
};

function pagEntradas() {
    var li_one = document.querySelector('#li-one');
    var li_three = document.querySelector('#li-three');
    var li_one_two = document.querySelector('#li-one-two');
    var li_three_two = document.querySelector('#li-three-two');

    li_one.classList.remove('active');
    li_three.classList.add('active');

    li_one_two.classList.remove('active');
    li_three_two.classList.add('active');
};

function pagSaidas() {
    var li_one = document.querySelector('#li-one');
    var li_four = document.querySelector('#li-four');
    var li_one_two = document.querySelector('#li-one-two');
    var li_four_two = document.querySelector('#li-four-two');

    li_one.classList.remove('active');
    li_four.classList.add('active');

    li_one_two.classList.remove('active');
    li_four_two.classList.add('active');
};

function pagLogin() {
    main_login.style.height = '100vh';
};
;(function() {
    const images = [
        'http://localhost:3000/assets/1.png',
        'http://localhost:3000/assets/2.png',
        'http://localhost:3000/assets/3.png',
        'http://localhost:3000/assets/4.png',
        'http://localhost:3000/assets/5.png',
        'http://localhost:3000/assets/6.png',
        'http://localhost:3000/assets/7.png',
        'http://localhost:3000/assets/8.png',
        'http://localhost:3000/assets/9.png',
    ];
    const randomImage = images[Math.floor(Math.random() * images.length)];
    /* change the bg! */
   document.querySelector('body').style.backgroundImage = 'url("'+randomImage+'")';
})();

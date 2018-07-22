;(function() {
    const images = [
        'http://shitwaifu.moe/blog/assets/1.png',
        'http://shitwaifu.moe/blog/assets/2.png',
        'http://shitwaifu.moe/blog/assets/3.png',
        'http://shitwaifu.moe/blog/assets/4.png',
        'http://shitwaifu.moe/blog/assets/5.png',
        'http://shitwaifu.moe/blog/assets/6.png',
        'http://shitwaifu.moe/blog/assets/7.png',
        'http://shitwaifu.moe/blog/assets/8.png',
        'http://shitwaifu.moe/blog/assets/9.png',
    ];
    const randomImage = images[Math.floor(Math.random() * images.length)];
    /* change the bg! */
   document.querySelector('body').style.backgroundImage = 'url("'+randomImage+'")';
})();

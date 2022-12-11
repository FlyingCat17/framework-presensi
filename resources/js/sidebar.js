// $('.side-nav .side-nav-inner .side-nav-menu .nav-item a').on('click', function(e){
//     e.preventDefault();
//     $('.side-nav .side-nav-inner .side-nav-menu .nav-item').removeClass('active');
//     $(this).addClass('active');
// })

// Berhasil Namun ada yang salah! -->

var navItems = document.querySelectorAll(".side-nav .side-nav-inner .side-nav-menu .nav-item");
var navItemsli = document.querySelectorAll(".side-nav .side-nav-inner .side-nav-menu .nav-item");
for (var i = 0; i < navItems.length; i++) {
    navItems[i].addEventListener("click", function () {
        this.classList.add("active");
        // this.classList.add("active").siblings().remove("active");
    });
}



// function myFunction(e) {
//     // var navItems = document.querySelectorAll(".side-nav .side-nav-inner .side-nav-menu .nav-item.active");
//     if (document.querySelector('#navList li.active') !== null) {
//         document.querySelector('#navList li.active').classList.remove("active");
//     }
//     e.target.className = "active";
// }
